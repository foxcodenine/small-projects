package repository

import (
	"context"
	"fmt"
	"go-mongo-user-api/go-api-backend/internal/models"
	"time"

	"go.mongodb.org/mongo-driver/v2/bson"
	"go.mongodb.org/mongo-driver/v2/mongo"
)

type UserRepository struct {
	collection *mongo.Collection
}

func NewUserRepository(db *mongo.Database) *UserRepository {
	// - bind collection -----------------------------------------------
	return &UserRepository{
		collection: db.Collection("users"),
	}
}

// -------------------------------------------------------------------------------------------------

func (r *UserRepository) FindByEmail(ctx context.Context, email string) (*models.User, error) {

	// - query ---------------------------------------------------------
	var user models.User

	err := r.collection.FindOne(ctx, bson.D{
		{Key: "email", Value: email},
	}).Decode(&user)

	if err != nil {
		return nil, fmt.Errorf("find user by email: %w", err)
	}

	// - return --------------------------------------------------------

	return &user, nil
}

// -------------------------------------------------------------------------------------------------

func (r *UserRepository) FindByID(ctx context.Context, id bson.ObjectID) (*models.User, error) {

	// - query ---------------------------------------------------------
	var user models.User

	err := r.collection.FindOne(ctx, bson.D{
		{Key: "_id", Value: id},
	}).Decode(&user)

	if err != nil {
		return nil, fmt.Errorf("find user by id: %w", err)
	}

	// - return --------------------------------------------------------
	return &user, nil
}

// -------------------------------------------------------------------------------------------------

func (r *UserRepository) GetAll(ctx context.Context) (*[]models.User, error) {
	var users []models.User

	filter := bson.D{}

	cursor, err := r.collection.Find(ctx, filter)

	if err != nil {
		return nil, fmt.Errorf("find all users: %w", err)
	}

	err = cursor.All(ctx, &users)

	if err != nil {
		return nil, fmt.Errorf("decode users: %w", err)
	}

	return &users, nil
}

// -------------------------------------------------------------------------------------------------

func (r *UserRepository) Create(ctx context.Context, user *models.User) (*models.User, error) {
	// - timestamps ----------------------------------------------------
	user.CreatedAt = time.Now().UTC()
	user.UpdatedAt = time.Now().UTC()

	// - insert --------------------------------------------------------
	result, err := r.collection.InsertOne(ctx, user)
	if err != nil {
		return nil, fmt.Errorf("insert user: %w", err)
	}

	// - map inserted id -----------------------------------------------
	id, ok := result.InsertedID.(bson.ObjectID)
	if !ok {
		return nil, fmt.Errorf("insert user: unexpected inserted id type %T", result.InsertedID)
	}

	// - return --------------------------------------------------------

	user.ID = id

	return user, nil
}

// -------------------------------------------------------------------------------------------------

func (r *UserRepository) UpdateByID(ctx context.Context, id bson.ObjectID, user *models.User) (*models.User, error) {
	// - timestamps ----------------------------------------------------
	user.UpdatedAt = time.Now().UTC()

	// - filter --------------------------------------------------------
	filter := bson.D{
		{Key: "_id", Value: id},
	}

	// - update --------------------------------------------------------
	update := bson.D{
		{Key: "$set", Value: bson.D{
			{Key: "email", Value: user.Email},
			{Key: "password_hash", Value: user.PasswordHash},
			{Key: "first_name", Value: user.FirstName},
			{Key: "last_name", Value: user.LastName},
			{Key: "role", Value: user.Role},
			{Key: "is_active", Value: user.IsActive},
			{Key: "updated_at", Value: user.UpdatedAt},
		}},
	}

	_, err := r.collection.UpdateOne(ctx, filter, update)
	if err != nil {
		return nil, fmt.Errorf("update user: %w", err)
	}

	// - return --------------------------------------------------------
	return user, nil
}

// -------------------------------------------------------------------------------------------------

func (r *UserRepository) DeleteByID(ctx context.Context, id bson.ObjectID) (*mongo.DeleteResult, error) {
	// - filter --------------------------------------------------------
	filter := bson.D{
		{Key: "_id", Value: id},
	}

	// - delete --------------------------------------------------------
	result, err := r.collection.DeleteOne(ctx, filter)

	if err != nil {
		return nil, fmt.Errorf("delete user: %w", err)
	}

	// - return --------------------------------------------------------
	return result, nil
}

// -------------------------------------------------------------------------------------------------
