# helium-showcase


## Getting started

```bash
git clone git@github.com:agence-webup/helium-showcase.git --recurse-submodules
cp .env.example .env
docker run --rm --interactive --tty --volume $PWD:/app composer install
sail up -d
sail artisan key:generate
sail npm i
sail npm run dev
```

## Dependencies

1. Install tailwind
2. Add alpine.js
3. Install Blade Icon

```
composer require ryangjchandler/blade-tabler-icons
php artisan icons:cache
```
