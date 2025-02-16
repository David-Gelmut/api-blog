init:
	@cd backend; \
	composer install
up:
	docker-compose up -d
down:
	docker-compose down
migrate:
	@cd backend; \
	php artisan migrate

migrate-fresh:
	@cd backend; \
    php artisan migrate:fresh