DOCKER_PHP_CONTAINER_NAME = api-platform-test_php-fpm

STEP = "\\n\\r**************************************************\\n"

all: up

build:
	@echo "$(STEP) Build in progress ... $(STEP)"
	docker-compose -f docker/docker-compose.yml build

up: build
	docker-compose -f docker/docker-compose.yml up -d
	docker exec $(DOCKER_PHP_CONTAINER_NAME) composer self-update

install: up
	@echo "$(STEP) Composer install ... $(STEP)"
	docker exec $(DOCKER_PHP_CONTAINER_NAME) composer install --prefer-dist
	docker exec $(DOCKER_PHP_CONTAINER_NAME) php bin/console doctrine:migrations:migrate -n

stop:
	docker-compose -f docker/docker-compose.yml stop

rm: stop
	docker-compose -f docker/docker-compose.yml rm

cli:
	@echo "$(STEP) CLI interface of $(DOCKER_PHP_CONTAINER_NAME)... $(STEP)"
	docker exec -ti $(DOCKER_PHP_CONTAINER_NAME) /bin/bash

cc:
	@echo "$(STEP) Cache clear env dev ... $(STEP)"
	docker exec $(DOCKER_PHP_CONTAINER_NAME) php bin/console cache:clear

top:
	@echo "$(STEP) Top $(DOCKER_PHP_CONTAINER_NAME)... $(STEP)"
	docker top $(DOCKER_PHP_CONTAINER_NAME)

logs:
	@echo "$(STEP) Log $(DOCKER_PHP_CONTAINER_NAME)... $(STEP)"
	docker-compose -f docker/docker-compose.yml logs
