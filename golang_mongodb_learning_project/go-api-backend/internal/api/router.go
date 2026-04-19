package api

import (
	apptypes "go-mongo-user-api/go-api-backend/internal/app"

	"github.com/go-chi/chi/v5"
)

func Router(app apptypes.App) chi.Router {
	r := chi.NewRouter()

	userHandler := UserHandler{
		App: app,
	}

	r.Route("/api", func(r chi.Router) {
		r.Get("/user", userHandler.GetAll)

		r.Get("/user/{id}", userHandler.GetByID)

		r.Post("/user", userHandler.Create)

		r.Put("/user/{id}", userHandler.Update)

		r.Delete("/user/{id}", userHandler.DeleteByID)
	})

	return r
}
