# potential-crud

### Especificações

* **Docker** para virtualização de *container*
* **Laminas API Tools** para geração de rotas, filtros e validações
* **MySQL** como SGDB
* **Doctrine ORM** para interface de persistência
* **Composer** para gerenciamento de dependências
* **PHPUnit** para os testes unitários

### Considerações

* Não houve implementação de interface gráfica.
* O campo *nome* é obrigatório somente para propósitos de validação de criação.
* O campo *sexo* possui filtro para *uppercase* para consistência.
* O campo *idade* possui limite de 10 dígitos.
* O campo *idade* possui filtro de dígitos.
* O campo *datanascimento* tem formatação obrigatória de '*Y-m-d*' (Ex.: 2020-12-31).
* Todos os campos *varchar* possuem limite de 64 caracteres.
* Campos vazios possuem filtro para *null* para consistência.
* *querystring* para página é *page*.
* *querystring* para itens por página é *page_size*.
* Por padrão não há paginação. O retorno do *get* de *collections* traz todos os itens.

### Configurando

Levantando o Docker
```
docker-compose up -d
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

Executanto os testes unitários
```
docker-compose exec web php /var/www/html/vendor/bin/phpunit --coverage-text
```

Representação gerada pelo PHPUnit para visualização dos testes
```
./data/log/codeCoverage/index.html
```
