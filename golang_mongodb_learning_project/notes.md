# Go API Notes

## Install Packages

```bash
go get github.com/joho/godotenv
go get go.mongodb.org/mongo-driver/v2/mongo
go get go.mongodb.org/mongo-driver/bson/primitive
go mod tidy
```

## Test Commands

Quick test run:

```bash
go test ./...
```

Verbose output:

```bash
go test -v ./...
```

Ignore test cache:

```bash
go test -count=1 ./...
```

Run tests for one package:

```bash
go test ./internal/repository -v
```

Run tests matching a name:

```bash
go test ./... -run TestUser -v
```

## Coverage

Show coverage in terminal:

```bash
go test -cover ./...
```

Create a coverage profile:

```bash
go test -coverprofile=coverage.out ./...
```

Show coverage by function:

```bash
go tool cover -func=coverage.out
```

Generate an HTML coverage report:

```bash
go tool cover -html=coverage.out -o coverage.html
```

## Extra

Run the race detector:

```bash
go test -race ./...
```
