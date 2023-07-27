setup:
	@make copy-env
	@make build
	@make up
	@make composer-setup
	@make data
	@make dev
build:
	docker-compose build --no-cache --force-rm
stop:
	docker-compose stop
up:
	docker-compose up -d
copy-env:
	cp .env src/.env
composer-setup:
	docker exec -it --user=root monolith-app-1 chmod -R 777 /var/www/storage
	docker exec monolith-app-1 bash -c "composer install"
	docker exec monolith-app-1 bash -c "php artisan key:generate"
data:
	docker exec monolith-app-1 bash -c "php artisan migrate:fresh --seed"
dev:
	docker-compose run --rm npm install && run dev