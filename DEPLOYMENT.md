# Deployment Checklist — Ananniti Tattoo Bali

> Sprint F — Production Readiness. Ikuti urutan ini saat deploy ke server.

## 1. Environment (.env)

- [ ] `APP_ENV=production`
- [ ] `APP_DEBUG=false`
- [ ] `APP_URL=https://domain-kamu` (gunakan HTTPS)
- [ ] `APP_KEY` — pastikan terisi & unik (jangan pakai key dev)
- [ ] `SESSION_SECURE_COOKIE=true`
- [ ] `ADMIN_EMAIL=` dan `ADMIN_PASSWORD=` — isi credential admin production (password kuat)
- [ ] DB credentials production (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`)

## 2. Dependensi

```bash
composer install --no-dev --optimize-autoloader
npm ci && npm run build
```

## 3. Storage & Permission

```bash
php artisan storage:link
chmod -R 775 storage bootstrap/cache
```

- [ ] `storage/app/public` bisa ditulis (untuk upload gambar)
- [ ] Symlink `public/storage` sudah dibuat (pastikan gambar produk/portfolio tampil)

## 4. Database

```bash
php artisan migrate --force
php artisan db:seed --class=UserSeeder   # buat admin production dari ADMIN_EMAIL/ADMIN_PASSWORD
```

- [ ] Jalankan seeder lain bila data awal dibutuhkan (category, supply, portfolio, dll)
- [ ] JANGAN seed UserSeeder jika admin sudah dibuat manual

## 5. Cache & Optimize

```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan optimize
```

- [ ] Setelah `config:cache`, perubahan `.env` baru akan aktif setelah `php artisan config:clear`

## 6. Queue (bila dipakai nanti)

- [ ] Jalankan `php artisan queue:work` (atau setup supervisor) jika ada job/notifikasi
- [ ] Scheduler: `php artisan schedule:run` setiap menit di cron (jika ada)

## 7. Verifikasi Pasca-Deploy

- [ ] `/` (Landing Page) 200
- [ ] `/shop`, `/gallery`, `/booking` 200
- [ ] `/admin/login` menampilkan halaman login
- [ ] Login admin dengan credential production berhasil
- [ ] Upload gambar di Website Content / Products tersimpan di `storage/app/public`
- [ ] Halaman error custom: coba URL salah → halaman 404 elegan (bukan stack trace)
- [ ] `APP_DEBUG=false` → error tidak menampilkan detail internal

## 8. Keamanan

- [ ] Password admin ≠ `password` (seeder sekarang membaca `ADMIN_PASSWORD` dari env)
- [ ] Login rate-limited (5x/menit, otomatis lock 429)
- [ ] HTTPS aktif & `SESSION_SECURE_COOKIE=true`
- [ ] `composer install --no-dev` (tidak ada tool dev di production)

## Rollback

- [ ] Selalu backup DB sebelum `migrate --force`: `mysqldump -u USER -p DB > backup.sql`
- [ ] Simpan versi rilis sebelumnya agar bisa `git checkout` jika ada regresi
