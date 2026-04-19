package carbon

import (
	"encoding/json"
	"fmt"
	"net/http"
	"time"
)

// ---------------------------------------------------------------------

type CarbonDataReadings struct {
	Data []Reading `json:"data"`
}

type Reading struct {
	From      string    `json:"from"`
	To        string    `json:"To"`
	Intensity Intensity `json:"intensity"`
}

type Intensity struct {
	Forecast int    `json:"forecast"`
	Actual   int    `json:"actual"`
	Index    string `json:"Index"`
}

// ---------------------------------------------------------------------

func GetCarbonData() (CarbonDataReadings, error) {

	var carbonDataReadings CarbonDataReadings

	from := time.Now().UTC().Format("2006-01-02T15:04Z")
	url := fmt.Sprintf("https://api.carbonintensity.org.uk/intensity/%s/fw24h", from)

	response, err := http.Get(url)
	if err != nil {
		return carbonDataReadings, err
	}

	defer response.Body.Close()

	err = json.NewDecoder(response.Body).Decode(&carbonDataReadings)

	if err != nil {
		return carbonDataReadings, err
	}

	return carbonDataReadings, nil
}
