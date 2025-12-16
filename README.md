# Dokumentasi Proyek Media Pembelajaran “Co-Think”

## Judul
**Media Pembelajaran Informatika Berbasis Website Interaktif pada Materi Berpikir Komputasional dengan Pendekatan Kontekstual Learning untuk Siswa Kelas 10 SMK**

## Nama Pembuat
**Isa Aulia Almadani** (K3523038)

## Tentang Proyek
Proyek ini merupakan media pembelajaran interaktif berbasis website yang dikembangkan untuk memfasilitasi pembelajaran materi **Berpikir Komputasional** bagi siswa kelas 10 SMK. Dengan pendekatan **Contextual Teaching and Learning (CTL)**, media ini dirancang untuk meningkatkan minat, pemahaman, dan keterampilan abad ke-21 seperti berpikir kritis, pemecahan masalah, dan literasi digital.

Media dikembangkan menggunakan model pengembangan **ADDIE** (Analysis, Design, Development, Implementation, Evaluation) dan memanfaatkan berbagai alat **Artificial Intelligence (AI)** untuk mempercepat proses pengembangan dan meningkatkan kualitas produk.

## Fitur Utama
1. **Halaman Landing Page** – Desain modern dengan animasi dan pengantar tentang pentingnya berpikir komputasional.
2. **Autentikasi Pengguna** – Login, register, dan lupa password.
3. **Dashboard Utama** – Overview progress belajar, statistik, dan akses cepat ke materi.
4. **Materi Pembelajaran** – Teks dan video untuk setiap pilar berpikir komputasional:
   - Dekomposisi
   - Pengenalan Pola
   - Abstraksi
   - Algoritma
5. **Halaman Capaian Pembelajaran (CP) & Tujuan Pembelajaran (TP)**.
6. **Evaluasi Interaktif** – Kuis dengan tiga level kesulitan per pilar, dilengkapi feedback instan dan review hasil.
7. **Halaman Performa** – Grafik progress, riwayat nilai, indikator penguasaan, dan rekomendasi materi.
8. **Profil Pengguna** – Informasi akun dan opsi logout/hapus akun.
9. **Halaman Tim Pengembang & Sumber Referensi**.

## Komponen Teknis
- **Framework:** Laravel
- **Frontend:** HTML, CSS, JavaScript, Blade Templating
- **Database:** MySQL
- **Alat Pengembangan AI yang Digunakan:**
  - **Claude** – Konversi flowchart ke kode .mermaid
  - **GitHub Copilot** – Autocompletion kode Frontend & Backend
  - **DeepSeek** – Pembuatan konten teks dan soal HOTS
  - **Google Gemini** – Pembuatan logo website
- **Tools Lain:** XAMPP, Composer, Git, Visual Studio Code

## Cara Instalasi Lokal

### Langkah-langkah:
1. **Buka XAMPP**, nyalakan **Apache & MySQL**.
2. **Buka CMD**, pilih lokasi untuk folder proyek.|
3. **Clone proyek ini**: git clone https://github.com/almadani12-cell/tekpemUas.git
4. **Tambahkan path folder proyek**: cd tekpemUas
5. **Masuk ke text editor Visual Studio Code**: code .
6. **Install Composer**: composer install
7. **Buat file .env**: cp .env.example .env
8. **Konfigurasi database di file .env**:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=uastekpen
DB_USERNAME=root
DB_PASSWORD=
9. **Tambahkan APP_KEY**:php artisan key:generate
10. **Jalankan migrasi database** (pilih yes jika diminta):
 ```
 php artisan migrate
 ```
11. **Jalankan proyek**:
 ```
 php artisan serve
 ```
12. **Buka proyek di browser**:
 ```
 http://localhost:8000
```

---

**Catatan:** Pastikan semua dependensi terinstall dan database sudah dibuat sebelum menjalankan migrasi. Jika ada kendala, periksa konfigurasi database di XAMPP dan pastikan port 3306 tidak digunakan oleh aplikasi lain.

---
**Proyek ini dikembangkan sebagai bagian dari tugas akhir mata kuliah Teknologi Pembelajaran, Program Studi Pendidikan Teknik Informatika dan Komputer, Universitas Sebelas Maret.**
