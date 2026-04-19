package main

import (
	"context"
	"errors"
	"fmt"
	"log"
	"net/http"
	"os"
	"os/signal"
	"syscall"
	"time"

	"github.com/foxcodenine/flatpeak-go-engineer-task/internal/api"
)

const HTTP_PORT = 3000

func main() {

	// - init http server ----------------------------------------------

	server := &http.Server{
		Addr:    fmt.Sprintf(":%d", HTTP_PORT),
		Handler: api.Router(),
	}

	// - create context ------------------------------------------------

	ctx, stop := signal.NotifyContext(context.Background(), os.Interrupt, syscall.SIGTERM)
	defer stop()

	// - run server in a go routine ------------------------------------

	go func() {
		log.Printf("HTTP server running on port %d", HTTP_PORT)

		err := server.ListenAndServe()
		if err != nil && !errors.Is(err, http.ErrServerClosed) {
			log.Printf("HTTP server error: %v", err)
		}
	}()

	// - gracefully shutdown -------------------------------------------

	<-ctx.Done()
	log.Println("HTTP server shutdown signal received")

	shutdownCtx, cancel := context.WithTimeout(context.Background(), 5*time.Second)
	defer cancel()

	err := server.Shutdown(shutdownCtx)
	if err != nil {
		log.Printf("HTTP server graceful shutdown failed: %v", err)
		os.Exit(1)
	}

	log.Println("HTTP server stopped gracefully")
}
