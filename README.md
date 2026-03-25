# 🚀 Sistem Presensi Karyawan - Media Pratama Solusinet

Aplikasi manajemen kehadiran (presensi) berbasis web yang dikembangkan menggunakan framework **CodeIgniter 4**. Project ini dibuat dalam rangka pelaksanaan **Praktek Kerja Lapangan (PKL)** untuk digitalisasi pencatatan data karyawan.

---

## 📋 Deskripsi Project

Sistem ini dirancang untuk mempermudah karyawan dalam melakukan absensi harian dan membantu pihak manajemen dalam memantau kedisiplinan staf secara real-time. Dengan antarmuka yang modern, aplikasi ini fokus pada kemudahan penggunaan (user-friendly).

## 🛠️ Tech Stack

- **Framework:** CodeIgniter 4.1.x
- **Language:** PHP 8.x
- **Database:** MySQL
- **Frontend:** CSS3, HTML5, Bootstrap 5
- **Version Control:** Git & GitHub

## ✨ Fitur Utama

- **Dashboard Karyawan:** Menampilkan ringkasan status kehadiran dan profil user.
- **Sistem Login:** Keamanan akses akun berdasarkan role (Admin/Karyawan).
- **Manajemen Profil:** Informasi jabatan (Direktur, Marketing, dll) beserta foto profil.
- **User Interface Modern:** Desain bersih dengan skema warna profesional.

## ⚙️ Panduan Instalasi

1. **Clone Repository**

   ```bash
   git clone [https://github.com/IZWAFAHZANALI/presensi.git](https://github.com/IZWAFAHZANALI/presensi.git)
   ```

2. **Persiapan Database (Import SQL)**
   Sebelum menjalankan aplikasi, kamu perlu mengimpor struktur database:
   1. Buka phpMyAdmin (localhost/phpmyadmin).
   2. Buat database baru dengan nama db_presensi.
   3. Klik tab Import di bagian menu atas.
   4. Klik tombol Choose File dan pilih file db_presensi.sql yang sudah disediakan di folder database dalam repository ini.
   5. Gulir ke bawah dan klik tombol Go atau Import.
3. **Update Dependencies**
   ```bash
   composer update
   ```
4. **Konfigurasi Environment**
   - Rename file env menjadi .env.
   - Sesuaikan pengaturan database:
   ```bash
   database.default.hostname = localhost
   database.default.database = nama_db_kamu
   database.default.username = root
   database.default.password =
   ```
5. **Jalankan Lokal Server**
   ```bash
   php spark serve
   ```
   Akses di browser: http://localhost:8080

## 👨‍💻 Developed By

**IZWA FAHZAN ALI**
siswa PKL dari SMK NEGERI 1 ADIWERNA
