## Configurações Iniciais para rodar com Docker + Postgres + Nginx
---

`cp .env.example .env` 

### Mudar o DB_HOST para o mesmo a seguir

````
DB_HOST=postgres
````
> Obs: As outras configurações do banco de dados fica a critério do desenvolvedor.
---
## Usar os comandos a seguir:

- `docker-compose up -d --build` 

- `docker-compose run --rm composer install`

- `docker-compose run --rm artisan key:generate` 

- `docker-compose run --rm artisan migrate`

- `docker-compose run --rm artisan db:seed`

- `docker exec -it controlecompras-app chown -R www-data:www-data /var/www/storage`

> Obs: Se der erro no route['login'], roda esse comando: - `docker-compose run --rm artisan route:cache `

---

Se ocorrer tudo certo a aplicação irá rodar em [http://localhost](http://localhost)

Acessar o PGAdmin [http://localhost:8080](http://localhost:8080)