package models

import (
	"time"

	"go.mongodb.org/mongo-driver/v2/bson"
)

type User struct {
	ID           bson.ObjectID `bson:"_id,omitempty" json:"id"`
	Email        string        `bson:"email" json:"email"`
	PasswordHash string        `bson:"password_hash" json:"-"`
	FirstName    string        `bson:"first_name,omitempty" json:"first_name"`
	LastName     string        `bson:"last_name,omitempty" json:"last_name"`
	Role         string        `bson:"role,omitempty" json:"role"`
	IsActive     bool          `bson:"is_active" json:"is_active"`
	CreatedAt    time.Time     `bson:"created_at" json:"created_at"`
	UpdatedAt    time.Time     `bson:"updated_at" json:"updated_at"`
}
