package api

import (
	apptypes "go-mongo-user-api/go-api-backend/internal/app"
	"go-mongo-user-api/go-api-backend/internal/models"
	"go-mongo-user-api/go-api-backend/internal/security"

	"encoding/json"
	"errors"
	"log"
	"net/http"
	"strings"

	"github.com/go-chi/chi/v5"
	"go.mongodb.org/mongo-driver/v2/bson"
	"go.mongodb.org/mongo-driver/v2/mongo"
)

type UserHandler struct {
	App apptypes.App
}

// -----------------------------------------------------------------------------

type GetAllResponse struct {
	Message string `json:"message"`
	Users   any    `json:"users"`
}

func (h *UserHandler) GetAll(w http.ResponseWriter, r *http.Request) {
	// - fetch ---------------------------------------------------------
	users, err := h.App.Repo.User.GetAll(r.Context())

	// - error ---------------------------------------------------------
	if err != nil {
		err = WriteError(w, http.StatusInternalServerError, "failed to get users")
		if err != nil {
			log.Printf("write get all users error response: %v", err)
		}
		return
	}

	// - response ------------------------------------------------------
	err = WriteJSON(w, http.StatusOK, GetAllResponse{
		Message: "users fetched successfully",
		Users:   users,
	})
	if err != nil {
		log.Printf("write get all users success response: %v", err)
	}

}

// -----------------------------------------------------------------------------

type GetByIDResponse struct {
	Message string `json:"message"`
	User    any    `json:"user"`
}

func (h *UserHandler) GetByID(w http.ResponseWriter, r *http.Request) {
	// - params --------------------------------------------------------
	idParam := chi.URLParam(r, "id")

	// - validate ------------------------------------------------------
	if idParam == "" {
		err := WriteError(w, http.StatusBadRequest, "id is required")
		if err != nil {
			log.Printf("write get by id validation error response: %v", err)
		}
		return
	}

	// - convert -------------------------------------------------------
	id, err := bson.ObjectIDFromHex(idParam)
	if err != nil {
		err = WriteError(w, http.StatusBadRequest, "invalid user id")
		if err != nil {
			log.Printf("write get by id invalid id response: %v", err)
		}
		return
	}

	// - fetch ---------------------------------------------------------
	user, err := h.App.Repo.User.FindByID(r.Context(), id)

	// - error ---------------------------------------------------------
	if err != nil {
		statusCode := http.StatusInternalServerError
		errorMessage := "failed to get user"

		if errors.Is(err, mongo.ErrNoDocuments) {
			statusCode = http.StatusNotFound
			errorMessage = "user not found"
		}

		err = WriteError(w, statusCode, errorMessage)
		if err != nil {
			log.Printf("write get by id error response: %v", err)
		}
		return
	}

	// - response ------------------------------------------------------
	err = WriteJSON(w, http.StatusOK, GetByIDResponse{
		Message: "user fetched successfully",
		User:    user,
	})
	if err != nil {
		log.Printf("write get by id success response: %v", err)
	}
}

// -----------------------------------------------------------------------------

type CreateRequest struct {
	Email    string `json:"email"`
	Password string `json:"password"`
}

type CreateResponse struct {
	Message string `json:"message"`
	User    any    `json:"user"`
}

func (h *UserHandler) Create(w http.ResponseWriter, r *http.Request) {
	// - decode --------------------------------------------------------
	var req CreateRequest
	err := json.NewDecoder(r.Body).Decode(&req)

	// - normalize -----------------------------------------------------
	req.Email = strings.TrimSpace(req.Email)

	// - validate ------------------------------------------------------
	if err != nil {
		err := WriteError(w, http.StatusBadRequest, "invalid request body")
		if err != nil {
			log.Printf("write create user invalid body response: %v", err)
		}
		return
	}

	if req.Email == "" || req.Password == "" {
		err := WriteError(w, http.StatusBadRequest, "email and password are required")
		if err != nil {
			log.Printf("write create user validation error response: %v", err)
		}
		return
	}

	// - existing ------------------------------------------------------
	_, err = h.App.Repo.User.FindByEmail(r.Context(), req.Email)
	if err == nil {
		err = WriteError(w, http.StatusConflict, "user with this email already exists")
		if err != nil {
			log.Printf("write create user conflict response: %v", err)
		}
		return
	}
	if !errors.Is(err, mongo.ErrNoDocuments) {
		err = WriteError(w, http.StatusInternalServerError, "failed to check existing user")
		if err != nil {
			log.Printf("write create user lookup error response: %v", err)
		}
		return
	}

	// - hash ----------------------------------------------------------
	hash, err := security.HashPassword(req.Password)

	if err != nil {
		err := WriteError(w, http.StatusInternalServerError, "failed to hash password")
		if err != nil {
			log.Printf("write create user hash error response: %v", err)
		}
		return
	}

	// - map -----------------------------------------------------------
	newUser := &models.User{
		Email:        req.Email,
		PasswordHash: hash,
		IsActive:     true,
	}

	// - create --------------------------------------------------------
	newUser, err = h.App.Repo.User.Create(r.Context(), newUser)

	if err != nil {
		err := WriteError(w, http.StatusInternalServerError, "failed to create user")
		if err != nil {
			log.Printf("write create user repository error response: %v", err)
		}
		return
	}

	// - response ------------------------------------------------------
	err = WriteJSON(w, http.StatusCreated, CreateResponse{
		Message: "user created successfully",
		User:    newUser,
	})
	if err != nil {
		log.Printf("write create user success response: %v", err)
	}

}

// -----------------------------------------------------------------------------

type UpdateRequest struct {
	Email     *string `json:"email"`
	Password  *string `json:"password"`
	FirstName *string `json:"first_name"`
	LastName  *string `json:"last_name"`
	Role      *string `json:"role"`
	IsActive  *bool   `json:"is_active"`
}

type UpdateResponse struct {
	Message string `json:"message"`
	User    any    `json:"user"`
}

func (h *UserHandler) Update(w http.ResponseWriter, r *http.Request) {

	// - params

	idParam := chi.URLParam(r, "id")

	// - validate
	if idParam == "" {
		err := WriteError(w, http.StatusBadRequest, "id is required")
		if err != nil {
			log.Printf("write update user validation error response: %v", err)
		}
		return
	}

	// - convert

	id, err := bson.ObjectIDFromHex(idParam)

	if err != nil {

		err = WriteError(w, http.StatusBadRequest, "invalid user id")

		if err != nil {
			log.Printf("write update user invalid id response: %v", err)
		}

		return
	}

	// - decode
	var req UpdateRequest
	err = json.NewDecoder(r.Body).Decode(&req)

	// - validate
	if err != nil {

		err := WriteError(w, http.StatusBadRequest, "invalid request body")

		if err != nil {
			log.Printf("write update user invalid body response: %v", err)
		}

		return
	}

	if req.Email == nil && req.Password == nil && req.FirstName == nil && req.LastName == nil && req.Role == nil && req.IsActive == nil {

		err := WriteError(w, http.StatusBadRequest, "at least one field is required")

		if err != nil {
			log.Printf("write update user empty body response: %v", err)
		}

		return
	}

	// - fetch
	user, err := h.App.Repo.User.FindByID(r.Context(), id)

	// - error
	if err != nil {

		statusCode := http.StatusInternalServerError
		errorMessage := "failed to get user"

		if errors.Is(err, mongo.ErrNoDocuments) {
			statusCode = http.StatusNotFound
			errorMessage = "user not found"
		}

		err = WriteError(w, statusCode, errorMessage)

		if err != nil {
			log.Printf("write update user fetch error response: %v", err)
		}

		return
	}

	// - normalize

	if req.Email != nil {
		email := strings.TrimSpace(*req.Email)
		req.Email = &email
	}

	if req.FirstName != nil {
		firstName := strings.TrimSpace(*req.FirstName)
		req.FirstName = &firstName
	}

	if req.LastName != nil {
		lastName := strings.TrimSpace(*req.LastName)
		req.LastName = &lastName
	}

	if req.Role != nil {
		role := strings.TrimSpace(*req.Role)
		req.Role = &role
	}

	// - existing
	if req.Email != nil && *req.Email != "" && *req.Email != user.Email {

		existingUser, err := h.App.Repo.User.FindByEmail(r.Context(), *req.Email)

		if err == nil && existingUser.ID != user.ID {

			err = WriteError(w, http.StatusConflict, "user with this email already exists")

			if err != nil {
				log.Printf("write update user conflict response: %v", err)
			}

			return

		}

		if err != nil && !errors.Is(err, mongo.ErrNoDocuments) {

			err = WriteError(w, http.StatusInternalServerError, "failed to check existing user")

			if err != nil {
				log.Printf("write update user lookup error response: %v", err)
			}

			return

		}
	}

	// - map
	if req.Email != nil {

		if *req.Email == "" {

			err := WriteError(w, http.StatusBadRequest, "email cannot be empty")

			if err != nil {
				log.Printf("write update user email validation response: %v", err)
			}

			return
		}
		user.Email = *req.Email
	}

	if req.Password != nil {

		if *req.Password == "" {

			err := WriteError(w, http.StatusBadRequest, "password cannot be empty")

			if err != nil {
				log.Printf("write update user password validation response: %v", err)
			}

			return
		}

		hash, err := security.HashPassword(*req.Password)
		if err != nil {

			err = WriteError(w, http.StatusInternalServerError, "failed to hash password")

			if err != nil {
				log.Printf("write update user hash error response: %v", err)
			}

			return
		}
		user.PasswordHash = hash
	}

	if req.FirstName != nil {
		user.FirstName = *req.FirstName
	}

	if req.LastName != nil {
		user.LastName = *req.LastName
	}

	if req.Role != nil {
		user.Role = *req.Role
	}

	if req.IsActive != nil {
		user.IsActive = *req.IsActive
	}

	// - update
	user, err = h.App.Repo.User.UpdateByID(r.Context(), id, user)

	if err != nil {
		err := WriteError(w, http.StatusInternalServerError, "failed to update user")
		if err != nil {
			log.Printf("write update user repository error response: %v", err)
		}
		return
	}

	// - response
	err = WriteJSON(w, http.StatusOK, UpdateResponse{
		Message: "user updated successfully",
		User:    user,
	})

	if err != nil {
		log.Printf("write update user success response: %v", err)
	}
}

// -----------------------------------------------------------------------------

type DeleteResponse struct {
	Message string `json:"message"`
}

func (h *UserHandler) DeleteByID(w http.ResponseWriter, r *http.Request) {
	// - params --------------------------------------------------------
	idParam := chi.URLParam(r, "id")

	// - validate ------------------------------------------------------
	if idParam == "" {
		err := WriteError(w, http.StatusBadRequest, "id is required")

		if err != nil {
			log.Printf("write delete by id validation error response: %v", err)
		}
		return
	}

	// - convert -------------------------------------------------------
	id, err := bson.ObjectIDFromHex(idParam)
	if err != nil {
		err = WriteError(w, http.StatusBadRequest, "invalid user id")
		if err != nil {
			log.Printf("write delete by id invalid id response: %v", err)
		}
		return
	}

	// - delete --------------------------------------------------------
	_, err = h.App.Repo.User.DeleteByID(r.Context(), id)

	if err != nil {
		err = WriteError(w, http.StatusInternalServerError, "failed to delete user")
		if err != nil {
			log.Printf("write delete by id repository error response: %v", err)
		}
		return
	}

	// - response ------------------------------------------------------
	err = WriteJSON(w, http.StatusOK, DeleteResponse{
		Message: "user deleted successfully",
	})
	if err != nil {
		log.Printf("write delete by id success response: %v", err)
	}
}
