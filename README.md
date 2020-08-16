# potential-crud

### Considerações

* Não houve implementação de interface gráfica.
* O campo *nome* é obrigatório somente para propósitos de validação de criação.
* O campo *sexo* possui filtro para *uppercase* por garantia.
* O campo *idade* possui limite de 10 dígitos.
* O campo *idade* possui filtro de digitos.
* O campo *datanascimento* tem formatação obrigatória de '*Y-m-d*' (Ex.: 2020-12-31).
* Todos os campos *varchar* possuem limite de 64 caracteres.
* Campos vazios possuem filtro para *null* para consistência.

### Configurando

Levantando o Docker
```
docker-compose up
```

Instalando dependências (Pode demorar alguns minutos)
```
docker-compose exec web composer install -n -d /var/www/html/
```

Gerando tabela
```
docker-compose exec web php /var/www/html/vendor/bin/doctrine-module orm:schema-tool:update --force
```

### Testes unitários

Alterando para ambiente *development*
```
docker-compose exec web composer development-enable -d /var/www/html/
```

Executanto os testes unitário
```
docker-compose exec web php /var/www/html/vendor/bin/phpunit --coverage-text
```
