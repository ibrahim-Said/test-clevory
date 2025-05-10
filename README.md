# Laravel Docker Setup

This project runs Laravel in a Docker environment with NGINX, PHP-FPM, and MySQL.

## 🐳 Requirements

- [Docker](https://www.docker.com/)
- [Docker Compose](https://docs.docker.com/compose/)
- Optional: `make`, for simplified commands (see below)

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/ibrahim-Said/test-clevory
cd test-clevory
```

### 2. Start Docker Containers

```bash
docker-compose up -d --build
```

### 3. Install Composer Dependencies

```bash
docker exec -it app_1 composer install
```

### 4. Create Environment File

```bash
cp .env.example .env
```

Then update `.env` with:

```
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=laravel
DB_PASSWORD=secret
```

### 5. Generate Laravel App Key

```bash
docker exec -it app_1 php artisan key:generate
```

---

## 🛠 Database

### Run Migrations

```bash
docker exec -it app_1 php artisan migrate
```

### Run Seeders

```bash
docker exec -it app_1 php artisan db:seed
```

---

## ✅ Run Tests

```bash
docker exec -it app_1 php artisan test
```

Or with PHPUnit directly:

```bash
docker exec -it app_1 ./vendor/bin/phpunit
```

---

## 🧪 Optional: Makefile Commands

You can add a `Makefile` to simplify usage:

```make
up:
	docker-compose up -d --build

composer-install:
	docker exec -it app_1 composer install

migrate:
	docker exec -it app_1 php artisan migrate

seed:
	docker exec -it app_1 php artisan db:seed

test:
	docker exec -it app_1 php artisan test
```

## 🌐 Access the App

Make sure this is in your `/etc/hosts`:

```
127.0.0.1 app1.localhost
```