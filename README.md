# potential-crud

docker-compose up

docker-compose exec web composer install -d -n /var/www/html/ \
    && mkdir /var/www/html/data \

docker-compose exec web php /var/www/html/vendor/bin/doctrine-module orm:schema-tool:update --force

