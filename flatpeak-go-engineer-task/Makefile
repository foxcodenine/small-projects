PROJECT_NAME=flatpeak_go_engineer_task
PORT=3000

docker-build:
	docker build -t $(PROJECT_NAME) .

docker-run:
	docker run --rm -p $(PORT):$(PORT) --name $(PROJECT_NAME) $(PROJECT_NAME)

docker-stop:
	docker stop $(PROJECT_NAME)