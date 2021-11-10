<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>


```bash

    php artisan make:model Post -mcr
    php artisan make:model Comment -mc
    php artisan make:model Category -m

    # laravel auth
    composer require laraveldaily/larastarters --dev
    php artisan larastarters:install
    npm install && npm run dev

    FILESYSTEM_DRIVER=public # default (local)

    php artisan migrate:fresh
    php artisan storage:link
    php artisan serve

```

```php

// add this to AppServiceProvider.php

public function boot() {

    Paginator::useBootstrap();
}

```# larablog
