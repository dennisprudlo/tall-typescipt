## TALL Typescript Template
This Laravel template has everything a TALL + Typescript project needs. The following versions of each component are installed:

- Tailwind *(^3.0.0-alpha.2)*
- Alpine.js *(^3.5)*
- Laravel *(^8.75)*
- Livewire *(^2.8)*
- Typescipt *(^4.5)*
- Larastan *(^1.0)*

### Setting up
Using the template requires a few steps for initial setup.

1. Remove the template's Git repository
```shell
rm -rf .git
```

2. Install project dependencies
```shell
composer install && npm ci
```

3. Generate .env file and the application encryption key
```shell
php -r "file_exists('.env') || copy('.env.example', '.env');" && php artisan key:generate
```
*After the file has been generated, the environment variables can be set.*

4. Compile frontend assets
```shell
npx mix
```
