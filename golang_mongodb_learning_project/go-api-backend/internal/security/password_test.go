package security

import "testing"

func TestHashPassword_ThenVerifyPassword(t *testing.T) {
	hash, err := HashPassword("supersecret")
	if err != nil {
		t.Fatalf("HashPassword() error = %v", err)
	}

	if hash == "" {
		t.Fatal("HashPassword() returned empty hash")
	}

	if !VerifyPassword("supersecret", hash) {
		t.Fatal("VerifyPassword() = false, want true")
	}
}

func TestVerifyPassword_WrongPassword(t *testing.T) {
	hash, err := HashPassword("correct")
	if err != nil {
		t.Fatalf("HashPassword() error = %v", err)
	}

	if VerifyPassword("wrong", hash) {
		t.Fatal("VerifyPassword() = true, want false")
	}
}
