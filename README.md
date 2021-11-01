# Data Filtering App

## Laravel Version
This repository contains Laravel `8.x`

##Prerequisites - for docker setup
1. Docker

## How to use?
- Clone the repository.
    - `git clone git@github.com:Mahfuz2811/data-filter.git`
- Go to project root
    - `cd data-filter`
- By default, the `postgres` database's password is set to `secret` and the database is set to `data_filter` and the user `root`. If you want to
  change the default values, then change them in (docker-compose.yml) `services.postgres.environment.POSTGRES_PASSWORD`
  and `services.postgres.environment.POSTGRES_DB` and `services.postgres.environment.POSTGRES_USER` in `docker-compose.yml` file.
- If you changed your database credentials in `docker-compose.yml` file, then you need to change values in your `.env`
  file's `DB_DATABASE`, `DB_PASSWORD` and `POSTGRES_USER` accordingly.
- If you don't change anything then let them go as it is.
- Just run the below command

```bash
docker-compose run -e COMPOSER_MEMORY_LIMIT=-1 php composer install
docker-compose run php php artisan key:generate
docker-compose run php php artisan migrate
docker-compose run php php artisan import:data
```

- Run `docker-compose up -d --build` to boot up the containers.
- Your application will be running in `http://localhost:8080`


If you want to analyse the query then run the below query in sql editor.

`EXPLAIN ANALYSE
select * from user_infos where yob = 1988 and mob = 4;`


N.B. If you don't use docker then you have to install all the dependency manually.

1. php:7.4
2. nginx:1.13.6/apache
3. postgres:10.4
4. redis:5.0.5
5. pdo pdo_pgsql pgsql

And then configure env accordingly. and run the below command

```bash
composer install
php artisan key:generate
php artisan migrate
php artisan import:data
php artisan serve --port=8080
```
