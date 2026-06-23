# SantapKita — Website Pemesanan Catering (Laravel 10)

Website pemesanan catering berbasis Laravel 10 sesuai dokumen Analisis Kebutuhan Sistem SantapKita: pengunjung dapat melihat & mencari paket, member dapat memesan dan membayar (Transfer/COD) serta memantau status pesanan, dan admin mengelola kategori, paket, pesanan, pembayaran, pengguna, dan laporan.

## 1. Persyaratan Sistem

- PHP >= 8.1
- Composer
- MySQL >= 5.7 / MariaDB
- Ekstensi PHP: pdo_mysql, mbstring, openssl, tokenizer, xml, ctype, json, fileinfo, gd (untuk upload gambar)

## 2. Instalasi

```bash
# 1. Masuk ke folder project
cd santapkita

# 2. Install dependency PHP
composer install

# 3. Salin file environment
cp .env.example .env

# 4. Generate application key
php artisan key:generate

# 5. Buat database MySQL bernama "santapkita" (lewat phpMyAdmin/CLI),
#    lalu sesuaikan kredensial di .env:
#    DB_DATABASE=santapkita
#    DB_USERNAME=root
#    DB_PASSWORD=

# 6. Jalankan migrasi + seeder (membuat tabel & data contoh)
php artisan migrate --seed

# 7. Buat symbolic link storage (agar gambar upload bisa diakses publik)
php artisan storage:link

# 8. Jalankan server lokal
php artisan serve
```

Akses di: **http://localhost:8000**

## 3. Akun Default (hasil seeder)

| Role   | Email                | Password   |
|--------|-----------------------|------------|
| Admin  | admin@santapkita.com  | admin123   |


> Silakan ganti password ini setelah instalasi di lingkungan produksi.

## 4. Struktur Fitur

### Pengunjung (Guest)
- Beranda (`/`)
- Daftar & pencarian paket catering (`/paket-catering`)
- Detail paket (`/paket-catering/{id}`)
- Tentang Kami (`/tentang-kami`), Kontak (`/kontak`)
- Login (`/login`) & Register (`/register`)

### Member (setelah login)
- Dashboard (`/member/dashboard`)
- Buat pesanan dari halaman detail paket
- Riwayat pesanan & detail status (`/member/pesanan`)
- Upload bukti pembayaran (transfer) pada halaman detail pesanan
- Batalkan pesanan (hanya saat status "Menunggu Pembayaran")
- Kelola profil & ubah password (`/member/profil`)

### Admin (setelah login sebagai admin)
- Dashboard ringkasan (`/admin/dashboard`)
- Kelola Kategori — CRUD (`/admin/kategori`)
- Kelola Paket Catering — CRUD + upload gambar (`/admin/paket`)
- Kelola Pesanan — lihat semua, ubah status (`/admin/pesanan`)
- Kelola Pembayaran — verifikasi/tolak bukti transfer (`/admin/pembayaran`)
- Kelola Pengguna — CRUD user & role (`/admin/pengguna`)
- Laporan pemesanan dengan filter tanggal (`/admin/laporan`)

## 5. Alur Status Pesanan

```
Menunggu Pembayaran → Menunggu Verifikasi → Diproses → Dikirim → Selesai
                                                       ↘ Dibatalkan (hanya dari "Menunggu Pembayaran")
```

- Saat member upload bukti transfer → status otomatis jadi **Menunggu Verifikasi**.
- Saat admin **Disetujui** → status pesanan otomatis jadi **Diproses**.
- Saat admin **Ditolak** → status pesanan kembali ke **Menunggu Pembayaran** (member upload ulang).
- Metode **COD** tidak memerlukan upload bukti; admin dapat langsung mengubah status secara manual.

## 6. Struktur Database

Mengikuti rancangan pada dokumen analisis kebutuhan:
- `users` (admin/member)
- `categories`
- `packages` (relasi ke categories)
- `orders` (relasi ke users & packages)
- `payments` (relasi 1-1 ke orders)

Migrasi tersedia lengkap di `database/migrations/`.

## 7. Catatan Teknis

- Desain menggunakan tema custom "Dapur Nusantara" (warna terracotta/spice) — lihat `public/css/app.css`.
- Validasi & pesan error menggunakan Bahasa Indonesia.
- Middleware `admin` dan `member` membatasi akses sesuai role (`app/Http/Middleware/`).
- Upload gambar paket disimpan di `storage/app/public/packages`, bukti pembayaran di `storage/app/public/payments` — pastikan `php artisan storage:link` sudah dijalankan.
- Tidak ada dependency frontend build (Vite/npm) — seluruh CSS/JS murni dan langsung disajikan dari folder `public/`, sehingga tidak perlu `npm install`.

## 8. Troubleshooting

- **Gambar tidak muncul**: jalankan `php artisan storage:link` dan pastikan folder `storage/app/public` memiliki permission yang sesuai (`chmod -R 775 storage`).
- **Error "could not find driver"**: aktifkan ekstensi `pdo_mysql` di `php.ini`.
- **419 Page Expired**: pastikan `APP_KEY` sudah ter-generate (`php artisan key:generate`) dan cookie session browser tidak diblokir.
