package main

import (
	"context"
	"fmt"
	"go-mongo-user-api/go-api-backend/internal/api"
	apptypes "go-mongo-user-api/go-api-backend/internal/app"
	"go-mongo-user-api/go-api-backend/internal/db"
	"net/http"
	"strconv"
	"time"

	"os"
	"os/signal"
	"syscall"

	"go-mongo-user-api/go-api-backend/internal/repository"
	"log"

	"github.com/joho/godotenv"
)

var envFilePath = "../.env"
var app apptypes.App

func main() {

	// - loading env ---------------------------------------------------
	err := godotenv.Load(envFilePath)
	if err != nil {
		log.Fatal("failed to load .env file")
	}

	// - connect mongodb -----------------------------------------------
	client, err := db.ConnectMongo()
	if err != nil {
		log.Fatalf("failed to connect to MongoDB: %v", err)
	}

	// - init repository -----------------------------------------------
	database := db.GetDatabase(client)

	app.Repo = repository.NewRepository(database)

	ctx, stop := signal.NotifyContext(context.Background(), os.Interrupt, syscall.SIGTERM)
	defer stop()

	// -----------------------------------------------------------------

	httpPort, err := strconv.Atoi(os.Getenv("HTTP_PORT"))
	if err != nil {
		httpPort = 3000
	}

	server := http.Server{
		Handler: api.Router(app),
		Addr:    fmt.Sprintf(":%d", httpPort),
	}

	go func() {
		err = server.ListenAndServe()

		if err != nil && err != http.ErrServerClosed {
			log.Printf("http server failed: %v\n", err)
		}
	}()

	/*
		// - demo: create user ---------------------------------------------
		user := &models.User{
			Email:        "chris@example.com",
			PasswordHash: "$2a$12$examplehashhere",
			IsActive:     true,
		}
		ctx, cancel := context.WithTimeout(context.Background(), 2*time.Second)
		defer cancel()

		// - insert user ---------------------------------------------------
		user, err = app.Repo.User.Create(ctx, user)
		if err != nil {
			log.Fatalf("failed to create user: %v", err)
		}

	*/

	// - done ----------------------------------------------------------
	log.Println("API server is running")

	// - gracefully shutdown -------------------------------------------

	<-ctx.Done()

	log.Println("HTTP server shutdown signal received")

	shutdownCtx, close := context.WithTimeout(context.Background(), 5*time.Second)
	defer close()
	err = server.Shutdown(shutdownCtx)

	if err != nil {
		log.Printf("HTTP server graceful shutdown failed: %v", err)
		os.Exit(1)
	}

	log.Println("HTTP server stopped gracefully")
}
