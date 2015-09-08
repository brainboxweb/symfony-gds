WEB_CONTAINER=gds_front_1
BEHAT_FLAGS=--stop-on-failure
PHPUNIT_FLAGS=--stop-on-failure

help:
	@printf "💾  \e[1;1mdtp development environment\e[0m\n"
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

docker-build:       ## Build Docker environment
	@./vm/docker-build.sh

docker-nfs:         ## Docker NFS
	@sudo ./vm/boot2docker-use-nfs.sh

docker-reset:       ## Kill all containers
	@./scripts/docker-reset.sh

bash:               ## Run /bin/bash
	docker exec -it ${WEB_CONTAINER} /bin/bash

tail-log:
	docker exec -it ${WEB_CONTAINER} tail -f ${LOG_FILE}

access-log:         ## Display real-time server access log
	@LOG_FILE="/var/log/nginx/econfig_access.log" $(MAKE) tail-log

error-log:          ## Display real-time server error log
	@LOG_FILE="/var/log/nginx/econfig_error.log" $(MAKE) tail-log

phpunit:            ## Run phpunit tests in Docker container
	docker exec -it ${WEB_CONTAINER} vendor/phpunit/phpunit/phpunit ${PHPUNIT_FLAGS}

behat:              ## Run behat tests in Docker container
	docker exec -it ${WEB_CONTAINER} vendor/behat/behat/bin/behat ${BEHAT_FLAGS}


composer-install:   ## Run composer install in Docker container
	docker exec -it ${WEB_CONTAINER} composer install
	@echo "Installing Docker pre-commit hook ..."
	cp scripts/hooks/docker-pre-commit .git/hooks/pre-commit


db-drop:          ## Drop database
	docker exec -it ${WEB_CONTAINER} php /var/www/gds/app/console doctrine:query:sql "drop database gds"


db-create:          ## Create database
	docker exec -it ${WEB_CONTAINER} /var/www/gds/scripts/create-database.php

db-migrate:          ## Run Doctrine Migrations
	docker exec -it ${WEB_CONTAINER} php /var/www/gds/app/console doctrine:migrations:migrate