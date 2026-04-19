package api

import "github.com/go-chi/chi/v5"

func Router() chi.Router {

	r := chi.NewRouter()

	h := &Handler{}

	r.Get("/slots", h.GetSlots)

	return r
}
