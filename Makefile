lint:
	composer exec --verbose phpcs -- --standard=PSR12 app
install:
	composer install
test:
	php artisan test