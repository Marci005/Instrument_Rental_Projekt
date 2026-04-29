# Hangszer Kölcsönző

 ## !! FONTOS: Néhol elkövettük azt a hibát, hogy Deák Ádám csapattagunk lokális git nevét nem írtuk át, tehát kérjük, vegyék figyelembe, hogy a user néven történt commitok valójában az ő commitjai. Köszönjük !!


Webalapú hangszerkölcsönző alkalmazás
A projekt két fő részből áll:
- **Backend** — Laravel 12 + Sanctum + MySQL, REST API
- **Frontend** — Vue 3 + Pinia + Vue Router + Bootstrap 5

A két kódbázis külön branchen található: a `Backend` és a `Frontend` branchen.

---

## Telepítési útmutató

### Előfeltételek

- PHP 8.3 vagy újabb
- Composer
- Node.js 18 vagy újabb és npm
- XAMPP (Apache, MySQL)
- Git

### 1. Backend telepítése

```bash
git clone https://github.com/Marci005/Instrument_Rental_Projekt.git
cd Instrument_Rental_Projekt
git checkout Backend

composer install
cp .env.example .env
php artisan key:generate
```

A `.env` fájlban állítsa be a következőket:
```
DB_DATABASE=instrument_rental
DB_USERNAME=root
DB_PASSWORD=
```

Hozza létre az adatbázist phpMyAdmin-ban `instrument_rental` néven, majd futtassa:

```bash
php artisan migrate:fresh --seed
php artisan serve
```

A backend ezután a **http://localhost:8000** címen elérhető.

### 2. Frontend telepítése

Egy másik mappában vagy terminálban:

```bash
git clone https://github.com/Marci005/Instrument_Rental_Projekt.git frontend
cd frontend
git checkout Frontend

npm install
npm install pinia, axios, bootstrap
npm run dev
```

A frontend a **http://localhost:5173** címen érhető el. A backend-nek a frontend indításakor már futnia kell.

---

## Tesztfelhasználók

A `php artisan migrate:fresh --seed` parancs futtatása után az alábbi tesztfelhasználók állnak rendelkezésre:

| Email | Jelszó | Jogosultság |
|-------|--------|-------------|
| admin@hangszer.hu | Admin123! | Adminisztrátor |
| user@hangszer.hu | User123! | Normál felhasználó |

---

## Branch-ek

| Branch | Tartalma |
|--------|----------|
| `main` | Ez a README |
| `Backend` | Laravel API kódbázis |
| `Frontend` | Vue 3 frontend kódbázis |
| `Database` | Adatbázis-séma diagram és dump |

---

## Dokumentáció

A részletes szakmai dokumentáció a `Database` branchen található `docs/` mappában.
