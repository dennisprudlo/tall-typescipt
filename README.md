## TALL Typescript Template
This Laravel template has everything a TALL + Typescript project needs. The following versions of each component are installed:

- Tailwind *(^3.0)*
- Alpine.js *(^3.9)*
- Laravel *(^9.2)*
- Livewire *(^2.10)*
- Typescipt *(^4.5)*
- Larastan *(^2.0)*

### Setting up
Using this template requires a few steps for the initial setup.

1. Remove the template's Git repository and initialize a new one
```shell
rm -rf .git && git init
```

2. Install the project dependencies
```shell
composer install && npm ci
```

3. Generate an .env file and the application encryption key
```shell
php -r "file_exists('.env') || copy('.env.example', '.env');" && php artisan key:generate
```
*After the file has been generated, the environment variables can be set.*

4. Compile frontend assets
```shell
npx mix
```
