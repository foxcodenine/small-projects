# Golang MongoDB Learning Project

Small learning project built to practice using MongoDB with Go.

The project is a simple user CRUD API using:

- Go
- MongoDB
- Chi router
- Repository pattern
- Basic handler tests with `httptest`

## What I Built

This project uses a `users` collection and includes:

- create user
- get all users
- get user by id
- update user by id
- delete user by id

It also includes:

- password hashing
- JSON request / response handling
- basic validation in handlers
- simple error responses
- a small set of handler tests in `internal/api`

## Project Structure

- `go-api-backend/internal/api`
  HTTP handlers, router, JSON responses, and handler tests
- `go-api-backend/internal/repository`
  MongoDB queries and data access
- `go-api-backend/internal/models`
  User model
- `go-api-backend/internal/security`
  Password hashing helpers
- `go-api-backend/cmd/api`
  API entry point

## Why I Built It

This was a learning project to practice:

- connecting Go to MongoDB
- structuring a small API
- working with request and response types
- using path params with `chi`
- writing a few beginner-friendly tests

## Current Status

This learning project is complete for now.

I want to stop here, move on to `Learn Go with Tests`, and come back later with stronger testing skills.

## Ideas For Later

- add JWT authentication
- validate protected API calls with middleware
- add user login logs
- add an API key generator
- improve test coverage
- add repository or integration tests

## Notes

This project was intentionally kept small and simple because the goal was learning, not building a full production system.
