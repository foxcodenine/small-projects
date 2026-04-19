package api

import (
	"context"
	"encoding/json"
	"net/http"
	"net/http/httptest"
	"strings"
	"testing"

	"github.com/go-chi/chi/v5"
)

// errorBody matches the JSON shape returned by WriteError.
// We use it in tests so we can read the response message easily.
type errorBody struct {
	Error string `json:"error"`
}

// withURLParam adds a chi route param to the request context.
// This lets us test handlers that use chi.URLParam(...) without
// needing to spin up the full router.
func withURLParam(r *http.Request, key string, value string) *http.Request {
	routeCtx := chi.NewRouteContext()
	routeCtx.URLParams.Add(key, value)

	ctx := context.WithValue(r.Context(), chi.RouteCtxKey, routeCtx)
	return r.WithContext(ctx)
}

// decodeErrorBody - is just a small helper function that
// reads the JSON response body and turns it into a Go struct, so your
// test can check the error message easily.
func decodeErrorBody(t *testing.T, recorder *httptest.ResponseRecorder) errorBody {
	t.Helper()

	var body errorBody

	err := json.NewDecoder(recorder.Body).Decode(&body)

	if err != nil {
		t.Fatalf("decode error response: %v", err)
	}

	return body
}

// -----------------------------------------------------------------------------

func TestGetByID_MissingID(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodGet, "/api/user/", nil)
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.GetByID(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "id is required" {
		t.Fatalf("expected error %q, got %q", "id is required", body.Error)
	}
}

func TestGetByID_InvalidID(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodGet, "/api/user/not-a-real-id", nil)
	request = withURLParam(request, "id", "not-a-real-id")
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.GetByID(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "invalid user id" {
		t.Fatalf("expected error %q, got %q", "invalid user id", body.Error)
	}
}

// -----------------------------------------------------------------------------

func TestCreate_InvalidBody(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodPost, "/api/user", strings.NewReader("{"))
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.Create(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "invalid request body" {
		t.Fatalf("expected error %q, got %q", "invalid request body", body.Error)
	}
}

func TestCreate_MissingFields(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodPost, "/api/user", strings.NewReader(`{"email":""}`))
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.Create(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "email and password are required" {
		t.Fatalf("expected error %q, got %q", "email and password are required", body.Error)
	}
}

// -----------------------------------------------------------------------------

func TestUpdate_MissingID(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodPut, "/api/user/", strings.NewReader(`{"first_name":"Chris"}`))
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.Update(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "id is required" {
		t.Fatalf("expected error %q, got %q", "id is required", body.Error)
	}
}

func TestUpdate_InvalidID(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodPut, "/api/user/not-a-real-id", strings.NewReader(`{"first_name":"Chris"}`))
	request = withURLParam(request, "id", "not-a-real-id")
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.Update(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "invalid user id" {
		t.Fatalf("expected error %q, got %q", "invalid user id", body.Error)
	}
}

func TestUpdate_InvalidBody(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodPut, "/api/user/507f1f77bcf86cd799439011", strings.NewReader("{"))
	request = withURLParam(request, "id", "507f1f77bcf86cd799439011")
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.Update(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "invalid request body" {
		t.Fatalf("expected error %q, got %q", "invalid request body", body.Error)
	}
}

func TestUpdate_EmptyBody(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodPut, "/api/user/507f1f77bcf86cd799439011", strings.NewReader(`{}`))
	request = withURLParam(request, "id", "507f1f77bcf86cd799439011")
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.Update(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "at least one field is required" {
		t.Fatalf("expected error %q, got %q", "at least one field is required", body.Error)
	}
}

func TestDeleteByID_MissingID(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodDelete, "/api/user/", nil)
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.DeleteByID(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "id is required" {
		t.Fatalf("expected error %q, got %q", "id is required", body.Error)
	}
}

func TestDeleteByID_InvalidID(t *testing.T) {
	// - setup --------------------------------------------------------
	handler := &UserHandler{}
	request := httptest.NewRequest(http.MethodDelete, "/api/user/not-a-real-id", nil)
	request = withURLParam(request, "id", "not-a-real-id")
	recorder := httptest.NewRecorder()

	// - run ----------------------------------------------------------
	handler.DeleteByID(recorder, request)

	// - assert -------------------------------------------------------
	if recorder.Code != http.StatusBadRequest {
		t.Fatalf("expected status %d, got %d", http.StatusBadRequest, recorder.Code)
	}

	body := decodeErrorBody(t, recorder)
	if body.Error != "invalid user id" {
		t.Fatalf("expected error %q, got %q", "invalid user id", body.Error)
	}
}
