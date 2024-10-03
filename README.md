# BOOK - API - DDD - Clean Architechture - PHP - Laravel

## Definição

Este projeto foi criado utilizando conceitos de Domain-Driven Design e Clean Architecture.
Foi utilizada a Linguagem PHP com o Laravel FrameWork.

O projeto consiste em um cadastro de livros onde temos:

-   CRUD de Autor
-   Crud de Assunto
-   Crud do Livro persistindo os relacionamentos com autor e assunto

## Teconlogias Empregadas

-   Laravel Framework 11
-   PHP 8.3
-   MySQL 8
-   Composer
-   PHP Unit Tests
-   SWAGGER

## Codificação

No projeto foram empregados

-   Clean Architecture
-   SOLID
-   Migration Pattern
-   Factory Pattern
-   Testes Unitários
-

## Configurando projeto

Clonar o projeto e rodar com docker compose com o comando:
`docker compose up --build`

Para rodar os testes unitarios
`docker exec books-backend php artisan test`

Para gerar o coverage report
`docker exec books-backend vendor/bin/phpunit --coverage-html coverage`

Para rodar as migrations
`docker exec books-backend php artisan migrate `

###Postman Collection
https://api.postman.com/collections/83683-ac0d1ff6-1da4-4fe6-b809-2e05af148a90?access_key=PMAT-01J97TV8VB6DMEV80ZSB9AST7J
