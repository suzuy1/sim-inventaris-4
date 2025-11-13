# 📦 Sistem Informasi Manajemen Inventaris

<div align="center">

![Laravel](https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=black)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=for-the-badge&logo=vite&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**Aplikasi web modern untuk manajemen inventaris dan aset organisasi**

[Fitur](#-fitur-utama) • [Teknologi](#-teknologi-yang-digunakan) • [Instalasi](#-instalasi) • [Penggunaan](#-penggunaan) • [Lisensi](#-lisensi)

</div>

---

## 📋 Deskripsi

Sistem Informasi Manajemen Inventaris adalah aplikasi web komprehensif yang dibangun dengan Laravel, Tailwind CSS, dan Alpine.js. Aplikasi ini dirancang untuk membantu organisasi dalam mengelola aset dan stok barang secara efisien dengan antarmuka yang modern dan responsif.

## ✨ Fitur Utama

### 📦 Manajemen Inventaris
- ✅ Operasi CRUD lengkap untuk data inventaris
- 📊 Impor dan ekspor data inventaris (Excel)
- 🖨️ Pencetakan daftar inventaris (semua atau per item)
- 🗂️ Pengelompokan inventaris berdasarkan nama barang

### 🛒 Manajemen Akuisisi
- Pelacakan proses akuisisi barang baru
- Riwayat pembelian dan pengadaan

### 🏢 Manajemen Ruangan
- Informasi lokasi penyimpanan inventaris
- Pemetaan barang ke ruangan

### 📦 Manajemen Stok Barang Habis Pakai
- Pelacakan jumlah masuk dan keluar
- Notifikasi stok menipis

### 👥 Manajemen Pengguna & Unit
- Manajemen akun pengguna
- Organisasi unit kerja

### 💳 Manajemen Transaksi
- Pencatatan transaksi keluar-masuk barang
- Riwayat transaksi lengkap

### 📝 Manajemen Permintaan
- Sistem permintaan barang dari pengguna
- Approval workflow

### 📊 Laporan
- 📈 Laporan riwayat item
- 💰 Laporan transaksi
- 📉 Laporan analitik

### ⚙️ Fitur Tambahan
- Pengaturan aplikasi
- Manajemen profil pengguna
- Dashboard interaktif

## 🛠️ Teknologi yang Digunakan

### Backend
<div align="left">

![PHP](https://img.shields.io/badge/PHP_8.2+-777BB4?style=flat-square&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel_12.x-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![Composer](https://img.shields.io/badge/Composer-885630?style=flat-square&logo=composer&logoColor=white)

</div>

- PHP (>=8.2)
- Laravel Framework (v12.x)
- Maatwebsite/Excel (impor/ekspor data)

### Frontend
<div align="left">

![Blade](https://img.shields.io/badge/Blade-FF2D20?style=flat-square&logo=laravel&logoColor=white)
![TailwindCSS](https://img.shields.io/badge/Tailwind_CSS-38B2AC?style=flat-square&logo=tailwind-css&logoColor=white)
![Alpine.js](https://img.shields.io/badge/Alpine.js-8BC0D0?style=flat-square&logo=alpine.js&logoColor=black)
![Vite](https://img.shields.io/badge/Vite-646CFF?style=flat-square&logo=vite&logoColor=white)

</div>

- Blade (Templating Engine Laravel)
- Tailwind CSS (Framework CSS)
- Alpine.js (JavaScript Framework Ringan)
- Vite (Build Tool)

### Database
<div align="left">

![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat-square&logo=mysql&logoColor=white)
![PostgreSQL](https://img.shields.io/badge/PostgreSQL-316192?style=flat-square&logo=postgresql&logoColor=white)
![SQLite](https://img.shields.io/badge/SQLite-07405E?style=flat-square&logo=sqlite&logoColor=white)

</div>

- Database Relasional (MySQL, PostgreSQL, atau SQLite)

## 📥 Instalasi

### Prasyarat

Pastikan Anda memiliki perangkat lunak berikut terinstal:

- ![PHP](https://img.shields.io/badge/PHP->=8.2-777BB4?style=flat-square&logo=php) PHP >= 8.2
- ![Composer](https://img.shields.io/badge/Composer-latest-885630?style=flat-square&logo=composer) Composer
- ![Node.js](https://img.shields.io/badge/Node.js->=16-339933?style=flat-square&logo=node.js) Node.js & npm (atau Yarn)
- ![Database](https://img.shields.io/badge/Database-MySQL/PostgreSQL/SQLite-4479A1?style=flat-square) Database Server

### 🚀 Langkah-langkah Instalasi

1. **Clone Repositori**
   ```bash
   git clone https://github.com/suzuy1/sim-inventaris-3.git
   cd sim-inventaris
   ```

2. **Instal Dependensi PHP**
   ```bash
   composer install
   ```

3. **Instal Dependensi JavaScript**
   ```bash
   npm install
   # atau
   yarn install
   ```

4. **Konfigurasi Lingkungan**
   
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```
   
   Kemudian edit file `.env` dan konfigurasikan pengaturan database:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=username
   DB_PASSWORD=password
   ```

5. **Generate Application Key**
   ```bash
   php artisan key:generate
   ```

6. **Jalankan Migrasi Database**
   ```bash
   php artisan migrate
   ```

7. **Jalankan Seeder (Opsional)**
   
   Untuk mengisi database dengan data dummy:
   ```bash
   php artisan db:seed
   ```

8. **Jalankan Server Pengembangan**
   
   Buka **dua terminal** terpisah:
   
   **Terminal 1** - Backend Laravel:
   ```bash
   php artisan serve
   ```
   
   **Terminal 2** - Frontend Vite:
   ```bash
   npm run dev
   # atau
   yarn dev
   ```

## 🎯 Penggunaan

Setelah instalasi berhasil, akses aplikasi melalui browser:

```
http://127.0.0.1:8000
```

### Login
- Gunakan kredensial pengguna yang telah dibuat atau dari seeder
- Akses dashboard untuk mengelola inventaris

### Navigasi
Jelajahi berbagai fitur melalui menu:
- 📦 **Dashboard** - Ringkasan dan statistik
- 📋 **Inventaris** - Manajemen aset
- 🛒 **Akuisisi** - Pengadaan barang
- 🏢 **Ruangan** - Lokasi penyimpanan
- 📦 **Stok** - Barang habis pakai
- 👥 **Pengguna** - Manajemen user
- 💳 **Transaksi** - Keluar-masuk barang
- 📝 **Permintaan** - Request barang
- 📊 **Laporan** - Analitik dan reporting
- ⚙️ **Pengaturan** - Konfigurasi sistem
- 👤 **Profil** - Data pengguna

## 🤝 Kontribusi

Kontribusi selalu diterima! Silakan buat pull request atau laporkan issue.

1. Fork repositori
2. Buat branch fitur (`git checkout -b fitur-baru`)
3. Commit perubahan (`git commit -m 'Menambahkan fitur baru'`)
4. Push ke branch (`git push origin fitur-baru`)
5. Buat Pull Request

## 📄 Lisensi

Proyek ini dilisensikan di bawah [MIT License](LICENSE).

---

<div align="center">

**Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS**

⭐ Jangan lupa berikan bintang jika proyek ini membantu Anda!

</div>