# MyUniv — Sistem Informasi Peminatan dan Perencanaan Pendidikan Lanjutan Siswa

> Proyek Uji Kompetensi Keahlian (UKK) Rekayasa Perangkat Lunak  
> **Tim:** SKYNIS Prism • **Sekolah:** SMK Budi Bakti Ciwidey  
> **Tahun Ajaran:** 2026/2027

## 1. Tentang MyUniv

MyUniv merupakan sistem informasi yang membantu siswa mengenali minat, kemampuan, dan kecenderungan kepribadian sebagai bahan pertimbangan dalam merencanakan pendidikan lanjutan. Sistem menyediakan hasil asesmen, rekomendasi jurusan dan universitas, fitur perencanaan pendidikan, serta layanan konsultasi dengan Guru BK.

MyUniv berfungsi sebagai alat bantu eksplorasi dan perencanaan. Hasil asesmen bukan keputusan mutlak dalam menentukan jurusan atau universitas.

## 2. Fitur Utama

- **Autentikasi dan hak akses:** akses aplikasi berdasarkan peran Siswa, Guru BK, dan Admin.
- **Asesmen peminatan:** asesmen yang mencakup minat dan bakat, kemampuan, serta kepribadian.
- **Hasil asesmen:** menampilkan ringkasan hasil berdasarkan data asesmen siswa.
- **Rekomendasi jurusan:** membantu siswa mengeksplorasi pilihan bidang studi berdasarkan hasil asesmen.
- **Informasi universitas:** menyajikan informasi universitas dan program studi yang tersedia di dalam sistem.
- **Education Planning:** membantu siswa menyusun target jurusan, universitas, jalur masuk, dan rencana pendidikan.
- **Hasil asesmen siswa untuk Guru BK:** Guru BK dapat melihat dan meninjau hasil asesmen peminatan siswa sebagai bahan pertimbangan dalam memberikan arahan dan bimbingan pendidikan lanjutan.
- **Konsultasi BK:** memfasilitasi pengajuan konsultasi oleh siswa serta penanganan dan tindak lanjut oleh Guru BK.
- **Manajemen data:** Admin mengelola data yang diperlukan oleh aplikasi sesuai hak aksesnya.

## 3. Teknologi yang Digunakan

| Komponen | Teknologi |
|---|---|
| Backend | PHP, Laravel 12 |
| Frontend | Blade, Tailwind CSS, Alpine.js |
| ORM | Eloquent ORM |
| Database | PostgreSQL |
| Database Platform | Supabase |
| Asset/build tooling | Vite (jika dikonfigurasi pada proyek) |

## 4. Peran Pengguna

- **Siswa:** mengerjakan asesmen, melihat hasil asesmen, mengeksplorasi rekomendasi jurusan dan universitas, menyusun education planning, serta mengajukan konsultasi BK.
- **Guru BK:** melihat dan meninjau hasil asesmen siswa serta menangani pengajuan konsultasi dan memberikan tindak lanjut sesuai hak akses yang diberikan.
- **Admin:** mengelola data master dan konten sistem sesuai hak akses admin.

## 5. Prasyarat Sistem

Pastikan perangkat pengembang telah memiliki:

- PHP dengan versi dan ekstensi yang sesuai dengan `composer.json` serta kebutuhan Laravel 12.
- Composer.
- Node.js dan npm apabila proses asset menggunakan Vite.
- Git.
- Akses ke database PostgreSQL/Supabase yang digunakan proyek.

## 6. Instalasi dan Menjalankan Aplikasi

### 6.1 Clone repositori

```bash
git clone <URL_REPOSITORY_MYUNIV>
cd <NAMA_FOLDER_REPOSITORY>
```

### 6.2 Instal dependency PHP

```bash
composer install
```

### 6.3 Siapkan environment

Windows PowerShell:

```powershell
Copy-Item .env.example .env
```

Linux/macOS:

```bash
cp .env.example .env
```

### 6.4 Generate application key

```bash
php artisan key:generate
```

### 6.5 Konfigurasi database

Atur variabel koneksi PostgreSQL pada `.env` berdasarkan kredensial Supabase milik tim. Contoh nama variabel:

```dotenv
DB_CONNECTION=pgsql
DB_HOST=<HOST_DATABASE>
DB_PORT=5432
DB_DATABASE=<NAMA_DATABASE>
DB_USERNAME=<USERNAME_DATABASE>
DB_PASSWORD=<PASSWORD_DATABASE>
```

Jangan memasukkan file `.env`, password, token, `APP_KEY`, atau Supabase service-role key ke repositori.

### 6.6 Jalankan migration

Pastikan koneksi mengarah ke database pengembangan yang benar dan backup tersedia jika database berisi data penting.

```bash
php artisan migrate
```

Jangan menggunakan `migrate:fresh` pada database bersama/produksi karena perintah tersebut menghapus tabel sebelum membuatnya kembali.

### 6.7 Instal dan build asset frontend

Jalankan jika proyek menggunakan Vite dan `package.json` tersedia:

```bash
npm install
npm run build
```

Untuk mode pengembangan frontend:

```bash
npm run dev
```

### 6.8 Jalankan server Laravel

```bash
php artisan serve
```

Buka alamat lokal yang ditampilkan terminal, umumnya:

```text
http://127.0.0.1:8000
```

## 7. Struktur Direktori

Gambaran umum direktori Laravel yang digunakan:

```text
app/
  Http/
    Controllers/
    Middleware/
  Models/
bootstrap/
config/
database/
  migrations/
  seeders/
public/
resources/
  views/
  css/
  js/
routes/
  web.php
storage/
tests/
```

Struktur aktual dapat berbeda mengikuti implementasi repositori.

## 8. Pengujian

Sebelum perubahan digabungkan atau aplikasi dirilis, lakukan pemeriksaan yang relevan, seperti:

```bash
php artisan route:list
php artisan migrate:status
php artisan test
```

Jalankan perintah pengujian yang memang tersedia pada proyek. Verifikasi alur login dan hak akses setiap role serta fitur inti aplikasi secara manual.

## 9. Tim Pengembang

| Nama | Tanggung Jawab |
|---|---|
| Anisa Lidia Putri | Frontend / UI/UX |
| Rafly Resky | Backend / Database |

## 10. Keamanan dan Kontribusi

- Jangan commit `.env` atau data rahasia.
- Gunakan akun pengujian dan data yang sesuai untuk development.
- Periksa perubahan sebelum commit dan push.
- Gunakan branch/aturan pull request yang disepakati tim.
- Laporkan bug dengan langkah reproduksi dan bukti yang tidak memuat data sensitif.

## 11. Informasi Repositori

- **Repository:** `<URL_REPOSITORY_MYUNIV>`
- **Branch utama:** `<NAMA_BRANCH_UTAMA>`
- **Dokumentasi pengguna:** `docs/` atau lokasi dokumentasi aktual
- **Kontak/tim:** SKYNIS Prism

## 12. Akun Pengujian Default (Credentials)

Gunakan akun berikut untuk menguji autentikasi dan hak akses berdasarkan masing-masing role pengguna.

| Role Pengguna | Alamat Email | Password | Hak Akses Utama |
|---|---|---|---|
| Siswa | `<EMAIL_SISWA>` | `<PASSWORD_SISWA>` | Mengikuti asesmen, melihat hasil, mengeksplorasi rekomendasi jurusan dan universitas, menyusun Education Planning, serta mengajukan konsultasi BK. |
| Guru BK | `<EMAIL_GURU_BK>` | `<PASSWORD_GURU_BK>` | Melihat dan meninjau hasil asesmen siswa serta menangani pengajuan konsultasi BK. |
| Admin | `<EMAIL_ADMIN>` | `<PASSWORD_ADMIN>` | Mengelola data master dan kebutuhan administrasi sistem sesuai hak akses admin. |

**Catatan:**
- Ganti placeholder dengan kredensial akun pengujian yang benar-benar tersedia di database.
- Gunakan akun khusus pengujian, bukan akun pribadi atau akun produksi.
- Jangan mencantumkan password akun asli, kredensial database, token, atau informasi rahasia pada repositori publik.
- Ganti password default sebelum aplikasi digunakan di lingkungan produksi.

---

Dikembangkan sebagai proyek UKK Rekayasa Perangkat Lunak — SMK Budi Bakti Ciwidey.
