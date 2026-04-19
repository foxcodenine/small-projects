package helpers

func DivideBy30RoundUp(n int) int {
	if n <= 0 {
		return 0
	}

	return (n + 29) / 30
}

func GetDurationBlocks(duration int) (fullBlocks, partialBlocks, remainingMinutes int) {
	blocks := DivideBy30RoundUp(duration)
	remainingMinutes = duration % 30

	fullBlocks = 0
	partialBlocks = 0

	if remainingMinutes == 0 {
		fullBlocks = blocks
	} else {
		fullBlocks = blocks - 1
		partialBlocks = 1
	}

	return
}
