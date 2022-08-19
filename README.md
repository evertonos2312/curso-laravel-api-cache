<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Curso Api Cache - Especializa TI

Primeiros comandos de configuração:

- Para subir o container: docker-compose up -d
- Para parar o container: docker-compose stop
- Para reconstruir o container: docker-compose up -d --build
- Acessar o container curso_api_cache: docker-compose exec curso_api_cache bash
- Sempre executar todos comandos do laravel dentro do container curso_api_cache
- Instalar todas dependencias do projeto: composer install
- Gerar key do projeto: php artisan key:generate
- Gerar as tabelas do projeto: php artisan migrate


