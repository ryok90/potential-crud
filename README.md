# potential-crud

docker-compose up

docker-compose exec web composer install -d -n /var/www/html/

docker-compose exec web php /var/www/html/vendor/bin/doctrine-module orm:schema-tool:update --force

# Para os testes

docker-compose exec web composer development-enable /var/www/html/ \
    && composer update

docker-compose exec web php /var/www/html/vendor/bin/phpunit --coverage-text
