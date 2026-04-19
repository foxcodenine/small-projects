package slots

import (
	"time"

	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/carbon"
	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/helpers"
)

func Continuous(duration int, readings []carbon.Reading) ([]Slot, error) {
	var result []Slot

	// - calculate requested blocks ------------------------------------

	fullBlocks, partialBlocks, remainingMinutes := helpers.GetDurationBlocks(duration)
	totalBlocks := fullBlocks + partialBlocks

	// - get the best continuous window --------------------------------

	window := GetLowestContinuousWindow(readings, totalBlocks)

	// - build slot ----------------------------------------------------

	var slot Slot
	slot.ValidFrom = window[0].From

	startTime, err := time.Parse("2006-01-02T15:04Z", slot.ValidFrom)
	if err != nil {
		return result, err
	}

	endTime := startTime.Add(time.Duration(duration) * time.Minute)
	slot.ValidTo = endTime.Format("2006-01-02T15:04Z")

	// - calculate weighted average intensity -------------------------

	weightedSum := 0

	for i, item := range window {
		if i+1 == len(window) && partialBlocks > 0 {
			weightedSum += item.Intensity.Forecast * remainingMinutes
		} else {
			weightedSum += item.Intensity.Forecast * 30
		}
	}

	slot.Carbon.Intensity = float64(weightedSum) / float64(duration)

	// - return result -------------------------------------------------

	result = append(result, slot)

	return result, nil
}

// -------------------------------------------------------------------------------------------------

func GetLowestContinuousWindow(readings []carbon.Reading, blocks int) []carbon.Reading {
	// - validate input ------------------------------------------------

	if blocks <= 0 || len(readings) < blocks {
		return nil
	}

	// - calculate first window sum -------------------------------------

	bestStart := 0
	bestSum := 0

	for i := 0; i < blocks; i++ {
		bestSum += readings[i].Intensity.Forecast
	}

	currentSum := bestSum

	// - slide through all possible windows ----------------------------

	for start := 1; start <= len(readings)-blocks; start++ {
		currentSum -= readings[start-1].Intensity.Forecast
		currentSum += readings[start+blocks-1].Intensity.Forecast

		if currentSum < bestSum {
			bestSum = currentSum
			bestStart = start
		}
	}

	// - return the lowest window --------------------------------------

	return readings[bestStart : bestStart+blocks]
}
