.DEFAULT_GOAL := help
.PHONY: yii

# Run silent.
MAKEFLAGS += --silent

RUN_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(RUN_ARGS):;@:)

include docker/.env

# Current user ID and group ID
export UID=$(shell id -u)
export GID=$(shell id -g)

export COMPOSE_PROJECT_NAME=${STACK_NAME}

DOCKER_COMPOSE_DEV := docker compose -f docker/compose.yml -f docker/compose.dev.yml
DOCKER_COMPOSE_TEST := docker compose -f docker/compose.yml -f docker/compose.test.yml

build: ## Build docker images
	$(DOCKER_COMPOSE_DEV) build $(RUN_ARGS)

up: ## Up the dev environment
	$(DOCKER_COMPOSE_DEV) up -d --remove-orphans

down: ## Down the dev environment
	$(DOCKER_COMPOSE_DEV) down --remove-orphans

shell: ## Get into container shell
	$(DOCKER_COMPOSE_DEV) exec app /bin/sh

yii: ## Execute Yii command
	$(DOCKER_COMPOSE_DEV) run --rm app ./yii $(RUN_ARGS)

composer: ## Run Composer
	$(DOCKER_COMPOSE_DEV) run --rm app composer $(RUN_ARGS)

codecept: ## Run Codeception
	$(DOCKER_COMPOSE_TEST) run --rm app ./vendor/bin/codecept $(RUN_ARGS)

psalm: ## Run Psalm
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/psalm $(RUN_ARGS)

rector: ## Run Rector
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/rector $(RUN_ARGS)

cs-fix:
	$(DOCKER_COMPOSE_DEV) run --rm --entrypoint ./vendor/bin/php-cs-fixer app fix --config=.php-cs-fixer.php --diff

build-prod: ## PROD | Build an image
	docker build --file docker/Dockerfile --target prod --pull -t ${IMAGE}:${IMAGE_TAG} .

push-prod: ## PROD | Push image to repository
	docker push ${IMAGE}:${IMAGE_TAG}

deploy-prod: ## PROD | Deploy to production
	docker -H ${PROD_SSH} stack deploy --with-registry-auth -d -c docker/compose.yml -c docker/compose.prod.yml ${STACK_NAME}

# Output the help for each task, see https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
.PHONY: help
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)
