.DEFAULT_GOAL := help

CLI_ARGS := $(wordlist 2,$(words $(MAKECMDGOALS)),$(MAKECMDGOALS))
$(eval $(CLI_ARGS):;@:)

include docker/.env

# Current user ID and group ID except MacOS where it conflicts with Docker abilities
ifeq ($(shell uname), Darwin)
    export UID=1000
    export GID=1000
else
    export UID=$(shell id -u)
    export GID=$(shell id -g)
endif

export COMPOSE_PROJECT_NAME=${STACK_NAME}
DOCKER_COMPOSE_DEV := docker compose -f docker/compose.yml -f docker/dev/compose.yml
DOCKER_COMPOSE_TEST := docker compose -f docker/compose.yml -f docker/test/compose.yml

#
# Development
#

build: ## Build docker images
ifeq ($(filter codecept yii,$(MAKECMDGOALS)),)
	$(DOCKER_COMPOSE_DEV) build $(CLI_ARGS)
endif

up: ## Up the dev environment
	$(DOCKER_COMPOSE_DEV) up -d --remove-orphans

down: ## Down the dev environment
	$(DOCKER_COMPOSE_DEV) down --remove-orphans

clear: ## Remove development docker containers and volumes
	$(DOCKER_COMPOSE_DEV) down --volumes --remove-orphans

shell: ## Get into container shell
	$(DOCKER_COMPOSE_DEV) exec app /bin/bash

yii: ## Execute Yii command
	$(DOCKER_COMPOSE_DEV) run --rm app ./yii $(CLI_ARGS)
.PHONY: yii

composer: ## Run Composer
	$(DOCKER_COMPOSE_DEV) run --rm app composer $(CLI_ARGS)

rector: ## Run Rector
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/rector $(CLI_ARGS)

cs-fix: ## Run PHP CS Fixer
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.php --diff

#
# Tests and analysis
#

test:
	$(DOCKER_COMPOSE_TEST) run --rm app ./vendor/bin/codecept run $(CLI_ARGS)

test-coverage:
	$(DOCKER_COMPOSE_TEST) run --rm app ./vendor/bin/codecept run --coverage --coverage-html --disable-coverage-php

codecept: ## Run Codeception
	$(DOCKER_COMPOSE_TEST) run --rm app ./vendor/bin/codecept $(CLI_ARGS)

psalm: ## Run Psalm
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/psalm $(CLI_ARGS)

composer-dependency-analyser: ## Run Composer Dependency Analyser
	$(DOCKER_COMPOSE_DEV) run --rm app ./vendor/bin/composer-dependency-analyser --config=composer-dependency-analyser.php $(CLI_ARGS)

#
# Production
#

prod-build: ## PROD | Build an image
	docker build --file docker/Dockerfile --target prod --pull -t ${IMAGE}:${IMAGE_TAG} .

prod-push: ## PROD | Push image to repository
	docker push ${IMAGE}:${IMAGE_TAG}

prod-deploy: ## PROD | Deploy to production
	docker -H ${PROD_SSH} stack deploy --with-registry-auth -d -c docker/compose.yml -c docker/prod/compose.yml ${STACK_NAME}

#
# Other
#

# Output the help for each task, see https://marmelab.com/blog/2016/02/29/auto-documented-makefile.html
help: ## This help.
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Prevent make from trying to build arguments as targets.
%:
	@:
