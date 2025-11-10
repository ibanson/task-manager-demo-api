# Activity Messenger – Demo Backend

[![Laravel](https://img.shields.io/badge/Laravel-12.x-ff2d20?logo=laravel&logoColor=white&style=for-the-badge)](https://laravel.com/)
[![PostgreSQL](https://img.shields.io/badge/PostgreSQL-15-336791?logo=postgresql&logoColor=white&style=for-the-badge)](https://www.postgresql.org/)
[![Docker](https://img.shields.io/badge/Docker-ready-2496ED?logo=docker&logoColor=white&style=for-the-badge)](https://www.docker.com/)

Application frontend réalisée dans le cadre d’un **test technique**.
> Il expose une série d’endpoints RESTful consommés par une application frontend Vue.js 2, et démontre la mise en place d’un environnement de développement moderne intégrant PostgreSQL, Docker et Nginx.
> Le but est de fournir un exemple clair et fonctionnel d’une architecture full-stack découplée, où chaque composant (frontend, backend, infrastructure Docker) peut être exécuté et maintenu indépendamment.

---

## Stack technique

- [Laravel 12](https://laravel.com/) – PHP framework
- [PostgreSQL 15](https://www.postgresql.org/) – Relational database
- [PHP-FPM 8.2](https://www.php.net/) – Runtime used in Docker
- [Nginx](https://nginx.org/) – Reverse proxy / web server
- [Docker Compose](https://docs.docker.com/compose/) – Environment orchestration

---

## 📁 Structure du projet

```bash
activity-messenger/
├─ docker-compose.yml                 # Orchestration principale (API, Frontend, DB, Nginx, Adminer)
│                                     # -> Dépôt cloné depuis : https://github.com/ibanson/activity-messenger-docker-config
│
├─ docker-config/                     # Configurations Docker partagées
│   ├─ api/
│   │   └─ Dockerfile                 # Image du backend (Laravel)
│   │
│   ├─ nginx/
│   │   ├─ Dockerfile                 # Image Nginx (reverse proxy)
│   │   └─ default.conf               # Configuration du serveur Nginx
│   │
│   └─ ssl/                           # (Optionnel) Certificats SSL de développement
│
├─ api/                               # Dépôt cloné depuis : https://github.com/ibanson/activity-messenger-demo-api
│   └─ (Code source du backend Laravel)
│
├─ frontend/                          # Dépôt cloné depuis : https://github.com/ibanson/activity-messenger-demo-frontend
│   └─ (Code source Vue.js 2)
│
├─ pg-data/                           # Volume local persistant pour PostgreSQL (non versionné)
│
└─ .gitignore                         # Ignore volumes, certificats, builds, etc.
```

## Project setup

### 1. Cloner le dépôt

```bash
git clone https://github.com/ibanson/activity-messenger-demo-api.git
cd activity-messenger-demo-api
```

### 2. Installer les dépendances

```bash
composer install
```

### 3. Configurer l'environnement et modifier les variables selon votre configuration locale

```bash
APP_NAME="Activity Messenger"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://api.activitymessenger.local

DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=activity_database
DB_USERNAME=activity_user
DB_PASSWORD=activity_pass
```

### 4. Générer la clé d’application

```bash
php artisan key:generate
```

### 5. Exécuter les migrations (et les seeders si nécessaire)

```bash
php artisan migrate --seed
```

### 6. Lancer le serveur de développement Laravel

```bash
php artisan serve
```

## Le projet sera accessible à l’adresse

```bash
http://localhost:8000
```

## 🐳 Si vous utilisez Docker

> Selon la configuration disponible ici https://github.com/ibanson/activity-messenger-docker-config

```bash
docker compose up --build
```

Le service Laravel API sera alors accessible à :

```bash
http://api.activitymessenger.local
```
