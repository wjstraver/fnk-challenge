# Fonky Development assignment

This application to display orders is made in Laravel, with React as Frontend Framework and InertiaJS as broker. For
system requirements there are two options: running locally or with Docker.

## Tools and Frameworks

This application is build using the following tools and frameworks:

- Laravel 10
- Laravel Sail
- InertiaJS
- TypeScript
- Vite
- React
- PostCSS
- Tailwind

## Installation

This project has been set up with Laravel Sail. If you have Docker installed on your machine, you can install this
application using the following command in the root directory of this project:

```shell
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

After that you can take the following steps:

- `./vendor/bin/sail up -d` to start all Docker containers (without the flag `-d` to run in foreground)
- `cp .env.example .env`
- `sail artisan key:generate`
- `sail artisan migrate --seed`
- `sail npm run dev` for development or `sail npm run build` for production.

To stop all Docker containers, run `./vendor/bin/sail stop`.

If you have conflicts with ports (e.g. for MySQL), you can change these in the `.env file`. You might have to restart
Laravel Sail by quiting the `sail up` command and running it again. For more info on Laravel Sail, please refer to
the [documentation](https://laravel.com/docs/10.x/sail).

Now you should be able to visit the application on Localhost on the **APP_PORT** set in your `.env` file. By default
this is [localhost:8080](http://localhost:8080).

#### Installment without Docker

It is also possible to install and run the application without Docker. Make sure on your machine you have:

- php ^8.2
- NodeJS ^18
- MySQL ^8
- Composer

In the root of the directory, take the following steps:

- `composer install`
- `npm install`
- `cp .env.example .env`
- `php artisan key:generate`
- Fill in the `.env` file according to your system specifications
- `npm run dev` for local development or `npm run build` for production
- `php artisan migrate --seed`
- `php artisan serve` or you can use alternative like Laravel Valet to run the application.

#### Running tests

For backend you kan run the tests using `sail test` or `php artisan test` respectively.

### TODO

- [ ] Mobile optimisations
- [ ] Implement pagination
- [ ] Move Sortable to backend to make it work with pagination
- [ ] Add language files
- [ ] Create homepage with metrics
  like [Laravel Nova Metrics](https://nova.laravel.com/docs/4.0/metrics/defining-metrics.html)
- [ ] Add Policies

### Future development

This application is very basic in functionality. For once, it does not have a login/authorisation system in place, and
data in the application cannot yet be managed using a CMS. For this, I would recommend
using [Laravel Nova](https://nova.laravel.com/) as backend framework. 
