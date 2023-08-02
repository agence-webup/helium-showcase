# helium-showcase


## Getting started

1. git clone git@github.com:agence-webup/helium-showcase.git --recurse-submodules
2. cp .env.example .env
3. docker run --rm --interactive --tty --volume $PWD:/app composer install
4. sail up -d
5. sail artisan key:generate
5. sail npm i
6. sail npm run dev

## Dependencies

1. Install tailwind
2. Add alpine.js
3. Install Blade Icon

```
composer require ryangjchandler/blade-tabler-icons
php artisan icons:cache
```
