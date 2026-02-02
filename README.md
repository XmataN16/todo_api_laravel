# 📋 Todo API — REST API на Laravel

REST API для управления списком задач (Todo List) с валидацией данных, полным набором CRUD операций и поддержкой статусов задач.

---

## 🚀 Быстрый старт

```bash
# 1. Клонировать репозиторий
git clone <repository-url>
cd todo_api_laravel

# 2. Установить зависимости
composer install

# 3. Настроить окружение
cp .env.example .env
php artisan key:generate

# 4. Настроить базу данных (SQLite)
touch database/database.sqlite
# Отредактировать .env:
# DB_CONNECTION=sqlite
# DB_DATABASE=/полный/путь/к/database/database.sqlite

# 5. Запустить миграции
php artisan migrate

# 6. Запустить сервер разработки
php artisan serve
