# Solusi Error Koneksi MySQL - Laravel

## Diagnosa Masalah
Error: "No connection could be made because the target machine actively refused it" menunjukkan bahwa layanan MySQL Laragon belum berjalan.

## Langkah-langkah Penyelesaian

### 1. Memulai Layanan Laragon
- Buka aplikasi **Laragon**
- Pastikan layanan **MySQL** (dan Apache/Nginx) sudah berjalan (hijau)
- Klik "Start All" jika belum berjalan

### 2. Membuat Database melalui phpMyAdmin
1. Buka browser dan akses: `http://localhost/phpmyadmin`
2. Login dengan:
   - Username: `root`
   - Password: (kosong)
3. Buat database baru:
   - Nama database: `bbg_inv`
   - Collation: `utf8mb4_unicode_ci`

### 3. Memverifikasi Konfigurasi .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bbg_inv
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Test Koneksi Database
Setelah layanan Laragon berjalan dan database dibuat, test koneksi dengan:

```bash
php artisan tinker --execute="
try {
    \$pdo = new PDO('mysql:host=127.0.0.1;port=3306;dbname=bbg_inv', 'root', '');
    echo '✅ Koneksi database berhasil!';
} catch(PDOException \$e) {
    echo '❌ Koneksi gagal: ' . \$e->getMessage();
}
"
```

### 5. Menjalankan Migrasi
```bash
php artisan migrate
```

### 6. Memastikan Tabel Sessions Ada
```bash
php artisan session:table
php artisan migrate
```

### 7. Test Aplikasi
Jalankan server development:
```bash
php artisan serve
```
Akses: `http://127.0.0.1:8000`

## Troubleshooting Tambahan

### Jika Masih Error:
1. **Restart Laragon**: Stop semua service, tunggu sebentar, lalu Start All
2. **Cek Port**: Pastikan tidak ada aplikasi lain yang menggunakan port 3306
3. **Cek Firewall**: Pastikan Windows Firewall tidak memblokir MySQL
4. **Log Error**: Cek log Laravel di `storage/logs/laravel.log`

### Jika Database Tidak Bisa Dibuat:
```sql
-- Via phpMyAdmin SQL tab
CREATE DATABASE bbg_inv CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Alternatif Koneksi:
Jika menggunakan MariaDB yang terinstall dengan Laragon:
```env
DB_CONNECTION=mariadb
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bbg_inv
DB_USERNAME=root
DB_PASSWORD=
```

## Ceklist
- [ ] Laragon berjalan (MySQL service hijau)
- [ ] Database `bbg_inv` sudah dibuat di phpMyAdmin
- [ ] File `.env` konfigurasi sudah benar
- [ ] Migrasi sudah dijalankan
- [ ] Tabel sessions sudah ada
- [ ] Aplikasi dapat diakses tanpa error