# Data Filtering App

## Laravel Version
This repository contains Laravel `8.x`

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
