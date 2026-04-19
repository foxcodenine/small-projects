docker-reset:
	sudo rm -rf /srv/docker/bind-mounts/go-mongo-user-api/mongodb/data
	sudo mkdir -p /srv/docker/bind-mounts/go-mongo-user-api/mongodb/data
	sudo chmod -R 777 /srv/docker/bind-mounts/go-mongo-user-api/mongodb/data

docker-up:
	docker compose up -d

docker-down:
	docker compose down
