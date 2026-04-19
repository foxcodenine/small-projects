package db

import (
	"context"

	"os"
	"time"

	"go.mongodb.org/mongo-driver/v2/mongo"
	"go.mongodb.org/mongo-driver/v2/mongo/options"
	"go.mongodb.org/mongo-driver/v2/mongo/readpref"
)

var client *mongo.Client

func ConnectMongo() (*mongo.Client, error) {
	// - read env -------------------------------------------------------
	mongoDbString := os.Getenv("MONGO_DB_STRING")

	// - connect --------------------------------------------------------
	clt, _ := mongo.Connect(options.Client().ApplyURI(mongoDbString))

	// - ping -----------------------------------------------------------
	ctx, cancel := context.WithTimeout(context.Background(), 2*time.Second)
	defer cancel()

	err := clt.Ping(ctx, readpref.Primary())

	if err != nil {
		return nil, err
	}

	// - store client ---------------------------------------------------
	client = clt

	return clt, nil
}

func DatabaseName() string {
	dbName := os.Getenv("MONGO_DB_NAME")
	if dbName == "" {
		dbName = "go_mongo_user_api"
	}
	return dbName
}

func GetDatabase(client *mongo.Client) *mongo.Database {
	// - pick db name ---------------------------------------------------
	return client.Database(DatabaseName())
}
