package slots

import (
	"slices"
	"time"

	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/carbon"
	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/helpers"
)

// -------------------------------------------------------------------------------------------------

func NonContinuous(duration int, readings []carbon.Reading) ([]Slot, error) {
	var result []Slot

	// - calculate requested blocks ------------------------------------

	fullBlocks, partialBlocks, remainingMinutes := helpers.GetDurationBlocks(duration)
	totalBlocks := fullBlocks + partialBlocks

	// - get lowest forecast readings ----------------------------------

	lowestReadings := GetLowestReadings(readings, totalBlocks)

	// - build result slots --------------------------------------------

	for index, reading := range lowestReadings {
		validTo := reading.To

		// - trim last slot if duration ends with a partial block ------

		if partialBlocks == 1 && index == len(lowestReadings)-1 {
			startTime, err := time.Parse("2006-01-02T15:04Z", reading.From)
			if err != nil {
				return result, err
			}

			endTime := startTime.Add(time.Duration(remainingMinutes) * time.Minute)
			validTo = endTime.Format("2006-01-02T15:04Z")
		}

		result = append(result, Slot{
			ValidFrom: reading.From,
			ValidTo:   validTo,
			Carbon: Carbon{
				Intensity: float64(reading.Intensity.Forecast),
			},
		})
	}

	return result, nil
}

// -------------------------------------------------------------------------------------------------

func GetLowestReadings(readings []carbon.Reading, count int) []carbon.Reading {
	// - validate input ------------------------------------------------

	if count <= 0 || len(readings) == 0 {
		return nil
	}

	// - clone readings so original slice is not modified ---------------

	cloned := make([]carbon.Reading, len(readings))
	copy(cloned, readings)

	// - sort by lowest forecast first ----------------------------------

	slices.SortFunc(cloned, func(a, b carbon.Reading) int {
		return a.Intensity.Forecast - b.Intensity.Forecast
	})

	// - limit count to available readings -----------------------------

	if count > len(cloned) {
		count = len(cloned)
	}

	return cloned[:count]
}
