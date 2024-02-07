# helium-showcase


## Getting started

```bash
# clone this repo
git clone git@github.com:agence-webup/helium-showcase.git

# clone the dependency repos
cd helium-showcase/packages
git clone git@github.com:agence-webup/helium-ui.git
git clone git@github.com:agence-webup/helium-core.git

# install & startup
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
