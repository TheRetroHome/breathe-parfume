# Breathe Parfume

## Установка

```bash
cd C:\OSPanel\home
git clone https://github.com/TheRetroHome/breathe-parfume.git breathe-parfume
```

В OSPanel:
- Добавить домен `breathe-parfume.loc`, корневая папка → `breathe-parfume/public`, PHP 8.2+
- Создать базу данных `breathe_parfume` (пользователь `root`, пароль пустой)

```bash
cd C:\OSPanel\home\breathe-parfume

composer install

php artisan migrate --seed

php artisan storage:link
```

Открыть: http://breathe-parfume.loc

**Админ:** `admin@breathe.ru` / `password`
