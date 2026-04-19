# Flatpeak Go Engineer Task

A simple REST API written in Go that returns time slots when forecast carbon intensity is lowest for the next 24 hours.

## What the API does

- Fetches UK carbon intensity forecast data
- Supports slot durations in minutes
- Supports continuous and non-continuous results
- Returns JSON responses

## Endpoint

```bash
GET /slots
```

Example:

```bash
curl "http://localhost:3000/slots?duration=30&continuous=true"
```

## Hosted demo

```bash
curl "https://flatpeak.chrisfarrugia.dev/slots?duration=30&continuous=true"
```

## Query parameters

### `duration`
- Integer in minutes
- Default: `30`
- Maximum: `1440`

### `continuous`
- Boolean
- Default: `false`

## Example response

```json
[
  {
    "valid_from": "2026-04-11T12:00Z",
    "valid_to": "2026-04-11T12:30Z",
    "carbon": {
      "intensity": 52
    }
  }
]
```

## Clone the project

Requirements:
- Git installed

```bash
git clone https://github.com/foxcodenine/flatpeak-go-engineer-task
cd flatpeak-go-engineer-task
```

## Run with Go

Requirements:
- Go installed

Run the API:

```bash
go run ./cmd/app/
```

## Run with Docker

Requirements:
- Docker installed

Build the image:

```bash
docker build -t flatpeak_go_engineer_task .
```

Run the container:

```bash
docker run --rm -p 3000:3000 --name flatpeak_go_engineer_task flatpeak_go_engineer_task
```

## Run with Make

Requirements:
- Docker installed
- Make installed

Build:

```bash
make docker-build
```

Run:

```bash
make docker-run
```

## Third-party library used

- `github.com/go-chi/chi/v5` for HTTP routing

## Notes

- Carbon data is fetched from the public UK Carbon Intensity API
- Forecast data is handled in 30-minute periods
- Partial durations such as `45` minutes are supported
- Continuous mode returns one continuous slot
- Non-continuous mode may return multiple separate slots
