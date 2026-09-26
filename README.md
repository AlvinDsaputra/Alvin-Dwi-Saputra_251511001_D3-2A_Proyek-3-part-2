# Activity Manager v1

Aplikasi manajemen kegiatan (Activity Manager) yang dibangun menggunakan Laravel framework dengan menerapkan arsitektur **Skinny Controller**, **Form Request Validation**, dan **Service Layer Pattern**.

---

## 🛠️ Persyaratan Sistem (Prerequisites)

Sebelum menjalankan proyek ini, pastikan sistem kamu sudah terinstal:
- **PHP** >= 8.2
- **Composer** >= 2.x
- **SQLite** atau **MySQL / MariaDB** (via Laragon / XAMPP)
- **Git**

---

## 🚀 Cara Menjalankan Proyek (Installation & Setup)

Jika proyek ini di-clone dari repositori GitHub baru, ikuti langkah-langkah setup berikut:

### 1. Clone Repositori
```bash
git clone https://github.com/AlvinDsaputra/Alvin-Dwi-Saputra_251511001_D3-2A_Proyek-3-part-2.git
cd activity-manager
```

### 2. Install Dependensi Composer
```bash
composer install
```

### 3. Konfigurasi Environment Variable
Salin file `.env.example` menjadi `.env`:
```bash
# Untuk Git Bash / Terminal Laragon / Linux:
cp .env.example .env

# Atau jika menggunakan Command Prompt (CMD) Windows:
copy .env.example .env
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Jalankan Migration dan Seeder
Pastikan database sudah disiapkan di `.env`, lalu jalankan:
```bash
php artisan migrate --seed
```

### 6. Jalankan Server Lokal
```bash
php artisan serve
```
Akses aplikasi melalui browser di alamat: `http://127.0.0.1:8000/activities`

---

## 📂 Fitur Utama

- **CRUD Activities**: Membuat, melihat daftar & detail, memperbarui, serta menghapus kegiatan.
- **Form Request**: Validasi data input HTTP terisolasi pada `StoreActivityRequest` dan `UpdateActivityRequest`.
- **Service Layer**: Pemisahan logika bisnis utama ke dalam `ActivityService`.
- **Code Style Standard**: Diformat menggunakan Laravel Pint.