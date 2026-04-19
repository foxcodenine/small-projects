package api

import (
	"encoding/json"
	"net/http"
	"strconv"

	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/carbon"
	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/slots"
)

type Handler struct {
}

type ErrorResponse struct {
	Error string `json:"error"`
}

func writeJSON(w http.ResponseWriter, statusCode int, data any) {
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(statusCode)

	_ = json.NewEncoder(w).Encode(data)
}

func (h *Handler) GetSlots(w http.ResponseWriter, r *http.Request) {

	// - defaults ------------------------------------------------------

	duration := 30
	continuous := false
	var err error

	// - get query params ----------------------------------------------

	durationRaw := r.URL.Query().Get("duration")
	continuousRaw := r.URL.Query().Get("continuous")

	// - validate duration ---------------------------------------------

	if durationRaw != "" {
		duration, err = strconv.Atoi(durationRaw)
		if err != nil {
			writeJSON(w, http.StatusBadRequest, ErrorResponse{
				Error: "invalid duration",
			})
			return
		}

		if duration <= 0 || duration > 1440 {
			writeJSON(w, http.StatusBadRequest, ErrorResponse{
				Error: "invalid duration",
			})
			return
		}
	}

	// - validate continuous -------------------------------------------

	if continuousRaw != "" {
		continuous, err = strconv.ParseBool(continuousRaw)
		if err != nil {
			writeJSON(w, http.StatusBadRequest, ErrorResponse{
				Error: "invalid continuous",
			})
			return
		}
	}

	// - fetch carbon forecast data ------------------------------------

	carbonData, err := carbon.GetCarbonData()
	if err != nil {
		writeJSON(w, http.StatusBadRequest, ErrorResponse{
			Error: "failed to fetch carbon data",
		})
		return
	}

	// - calculate result slots ----------------------------------------

	var result []slots.Slot

	if continuous {
		result, err = slots.Continuous(duration, carbonData.Data)
		if err != nil {
			writeJSON(w, http.StatusInternalServerError, ErrorResponse{
				Error: "failed to calculate continuous slots",
			})
			return
		}
	} else {
		result, err = slots.NonContinuous(duration, carbonData.Data)
		if err != nil {
			writeJSON(w, http.StatusInternalServerError, ErrorResponse{
				Error: "failed to calculate non-continuous slots",
			})
			return
		}
	}

	// - return response -----------------------------------------------

	writeJSON(w, http.StatusOK, result)
}
