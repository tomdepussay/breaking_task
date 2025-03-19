<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## TECHNO

---

![Docker](https://img.shields.io/badge/-Docker-0db7ed?style=for-the-badge&logo=docker&logoColor=white)
![Laravel](https://img.shields.io/badge/-Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/-TailwindCSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

## Installation

---

- PHP : https://www.php.net/downloads.php
- Composer : https://getcomposer.org/download/
- Laravel : https://laravel.com/docs/12.x/installation
- Docker Desktop : https://www.docker.com/products/docker-desktop/

## Lancement du projet

---

```bash
git clone https://github.com/tomdepussay/breaking_task.git
cd breaking_task
```

# Copie du .env
```bash
cp .env.example .env
```

# Build le projet
```bash
docker compose up --build -d
```

# Génération de la clé d’application
```bash
docker-compose exec php php artisan key:generate
```

# Lancement des migrations
```bash
docker-compose exec php php artisan migrate --seed
```
