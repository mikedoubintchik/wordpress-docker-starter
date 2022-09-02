
include .dev/.env

DOCKER_COMPOSE_PATH=.dev/docker-compose.yml
WP_ROOT ?= /var/www/html/

default: start

build:
	docker compose -f ${DOCKER_COMPOSE_PATH} build $(c)
build-no-cache:
	docker compose -f ${DOCKER_COMPOSE_PATH} build --no-cache $(c)
start:
	docker compose -f ${DOCKER_COMPOSE_PATH} up -d $(c)
stop:
	docker compose -f ${DOCKER_COMPOSE_PATH} stop $(c)
down:
	docker compose -f ${DOCKER_COMPOSE_PATH} down $(c)
restart:
	docker compose -f ${DOCKER_COMPOSE_PATH} stop $(c)
	docker compose -f ${DOCKER_COMPOSE_PATH} up -d $(c)
logs:
	docker logs $$(docker ps -q -f name=${PROJECT_NAME}_wordpress)
shell:
	docker exec -it $$(docker ps -q -f name=${PROJECT_NAME}_wordpress) bash
ps:
	docker compose -f ${DOCKER_COMPOSE_PATH} ps
wp:
	docker exec $$(docker ps -q -f name=${PROJECT_NAME}_wordpress) wp --allow-root --path=$(WP_ROOT) $(filter-out $@,$(MAKECMDGOALS)) $(c)