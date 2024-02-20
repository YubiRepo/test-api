<h1 align="center">TEST API</h1>

## Table of Contents
1. [Requirements](#requirements)
2. [Setup](#setup)
3. [Production Setup](#production-setup)

## Requirements
- [PHP ^8.1](https://www.php.net/releases/8.1/en.php)
- [Composer](https://getcomposer.org/)
- [Mysql](https://www.mysql.com/)

## Setup
1. Clone or download
```bash
git clone https://github.com/YubiRepo/test-api
```

2. CD into `/test-api`
```shell 
cd test-api
```

3. Install Laravel dependency
```shell
composer install
```

4. Create copy of ```.env```
```shell
cp .env.example .env
```

5. Generate laravel key
```shell
php artisan key:generate
```

6. Set database name and account in ```.env```
```shell
DB_DATABASE=test_api
DB_USERNAME=root
DB_PASSWORD=
```

7. Run Laravel migrate and seeder
```shell
php artisan migrate --seed
```

9. Create the symbolic link
```shell
php artisan storage:link
``` 

9. Start development server
```shell
php artisan serve
``` 

<h2 id="production-setup">Production Setup</h2>

Apply changes to  `.env`  file:
```shell
APP_ENV=production
APP_DEBUG=false
```

Run these commands sequentially

```sh
composer install --optimize-autoloader --no-dev
```
```sh
php artisan storage:link
```
```sh
php artisan optimize
```
