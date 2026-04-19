package db

import (
	"os"
	"testing"
)

func TestDatabaseName_DefaultWhenEnvMissing(t *testing.T) {
	t.Setenv("MONGO_DB_NAME", "")
	got := DatabaseName()
	if got != "go_mongo_user_api" {
		t.Fatalf("DatabaseName() = %q, want %q", got, "go_mongo_user_api")
	}
}

func TestDatabaseName_UsesEnvWhenSet(t *testing.T) {
	t.Setenv("MONGO_DB_NAME", "test_db_name")
	if got := DatabaseName(); got != "test_db_name" {
		t.Fatalf("DatabaseName() = %q, want %q", got, "test_db_name")
	}
}

func TestDatabaseName_DoesNotRelyOnProcessEnvGlobalState(t *testing.T) {
	// This test is just a sanity check showing the difference between
	// reading env vars directly vs. using t.Setenv (which auto-restores).

	// Registers a cleanup function that runs after the test finishes,
	// restoring the env var back to its old value. This prevents this
	// test from messing up other tests.
	prev := os.Getenv("MONGO_DB_NAME")
	t.Cleanup(func() { _ = os.Setenv("MONGO_DB_NAME", prev) })

	_ = os.Setenv("MONGO_DB_NAME", "another_db")
	got := DatabaseName()
	if got != "another_db" {
		t.Fatalf("DatabaseName() = %q, want %q", got, "another_db")
	}
}
