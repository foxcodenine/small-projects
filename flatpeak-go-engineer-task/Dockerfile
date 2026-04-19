FROM golang:1.25.4-alpine AS builder

WORKDIR /build

COPY go.mod go.sum ./
RUN go mod download

COPY . .

RUN go build -o /app ./cmd/app

FROM alpine:3.21

COPY --from=builder /app /bin/app

EXPOSE 3000

CMD ["/bin/app"]