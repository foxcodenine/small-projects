package slots

type Slot struct {
	ValidFrom string `json:"valid_from"`
	ValidTo   string `json:"valid_to"`
	Carbon    Carbon `json:"carbon"`
}

type Carbon struct {
	Intensity float64 `json:"intensity"`
}
