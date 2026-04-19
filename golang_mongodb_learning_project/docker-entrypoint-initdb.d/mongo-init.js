db = db.getSiblingDB(process.env.MONGO_INITDB_DATABASE || "go_mongo_user_api");

db.createCollection("users", {
    validator: {
        $jsonSchema: {
            bsonType: "object",
            required: ["email", "password_hash", "created_at", "updated_at"],
            properties: {
                email: {
                    bsonType: "string",
                    description: "must be a string and is required"
                },
                password_hash: {
                    bsonType: "string",
                    description: "must be a string and is required"
                },
                created_at: {
                    bsonType: "date",
                    description: "must be a date and is required"
                },
                updated_at: {
                    bsonType: "date",
                    description: "must be a date and is required"
                },
                first_name: {
                    bsonType: "string",
                    description: "must be a string if provided"
                },
                last_name: {
                    bsonType: "string",
                    description: "must be a string if provided"
                },
                role: {
                    bsonType: "string",
                    description: "must be a string if provided"
                },
                is_active: {
                    bsonType: "bool",
                    description: "must be a boolean if provided"
                }
            }
        }
    },
    validationLevel: "strict",
    validationAction: "error"
});

db.users.createIndex(
    { email: 1 },
    { unique: true, name: "unique_email" }
);


// db = db.getSiblingDB('sample_db');

// db.createCollection('sample_collection');

// db.sample_collection.insertMany([
//  {
//     org: 'helpdev',
//     filter: 'EVENT_A',
//     addrs: 'http://rest_client_1:8080/wh'
//   },
//   {
//     org: 'helpdev',
//     filter: 'EVENT_B',
//     addrs: 'http://rest_client_2:8081/wh'
//   },
//   {
//     org: 'github',
//     filter: 'EVENT_C',
//     addrs: 'http://rest_client_3:8082/wh'
//   }  
// ]);
