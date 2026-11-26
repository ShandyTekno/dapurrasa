# DapurRasa — PT EL Capcay

Milil : EL Shandy

Website dinamis berbasis **Laravel** untuk UMKM kuliner **DapurRasa** di bawah naungan **PT EL Capcay**, yang bergerak di bidang layanan **catering, nasi kotak, lauk pauk, makanan tradisional, dan paket acara Nusantara**.

Project ini dibangun dengan tampilan responsif, katalog menu dinamis dari database, detail produk per item, pemesanan cepat via WhatsApp, serta panel admin lengkap dengan autentikasi dan manajemen CRUD + upload foto produk.

---

## Fitur Utama

### Halaman Publik
- **Beranda (`/`)**: Hero showcase interaktif menu pilihan, ringkasan keunggulan usaha, menu unggulan dari database, dan tombol konsultasi WhatsApp.
- **Katalog Menu (`/menu`)**: Menampilkan daftar seluruh menu catering dari database dengan fitur **pencarian nama menu**, **filter kategori cepat**, dan **pagination**.
- **Detail Menu (`/menu/{menu}`)**: Menampilkan foto resolusi penuh (dapat diperbesar/zoom), kategori, harga per porsi, deskripsi hidangan, serta tombol pesan langsung via WhatsApp.
- **Tentang Kami (`/tentang-kami`)**: Profil perusahaan **PT EL Capcay**, pengenalan brand **DapurRasa**, serta Visi & Misi usaha.
- **Kontak (`/kontak`)**: Informasi alamat dapur (tautan Google Maps), WhatsApp Fast Response, dan email resmi.

### Panel Admin (`/admin`)
- **Autentikasi (`/login`)**: Login & logout pengelola dengan rate limiting dan proteksi middleware `auth`.
- **Dashboard (`/admin`)**: Ringkasan jumlah kategori, jumlah menu, dan daftar menu terbaru.
- **CRUD Kategori (`/admin/kategori`)**: Tambah, lihat daftar, cari/urutkan tabel, ubah, dan hapus kategori (dilindungi agar kategori yang masih dipakai menu tidak bisa dihapus).
- **CRUD Menu (`/admin/menu`)**: Tambah, lihat daftar, ubah, dan hapus menu beserta **upload foto produk** ke `storage/app/public/menus` (format JPG/JPEG/PNG/WEBP, maks. 10 MB) lengkap dengan live preview dan pembersihan otomatis foto lama saat update/hapus.
- **Validasi Server-Side**: Menggunakan Laravel Form Request (`MenuRequest` & `KategoriRequest`) dengan aturan wajib diisi (`required`), batas maksimal karakter/ukuran (`max`), tipe data (`string`, `integer`, `image`, `mimes`), serta integritas relasi (`exists`, `unique`).

---

## Struktur Database & Relasi

Terdapat dua tabel utama yang saling berelasi menggunakan Eloquent ORM:

1. **`kategoris`** (`App\Models\Kategori` — `hasMany(Menu::class)`)
   - `id`, `nama_kategori` (unique), `deskripsi`, `timestamps`
2. **`menus`** (`App\Models\Menu` — `belongsTo(Kategori::class)`)
   - `id`, `kategori_id` (foreign key → `kategoris.id`, `restrictOnDelete`, `cascadeOnUpdate`), `nama_menu`, `harga`, `deskripsi`, `foto`, `timestamps`

---

## Teknologi yang Digunakan

- **Backend**: PHP 8.3+, Laravel 13, Eloquent ORM
- **Database**: MySQL (dengan dukungan SQLite untuk pengujian PHPUnit)
- **Frontend**: Blade Template, Bootstrap 5.3, Bootstrap Icons, Custom Responsive CSS ([dapurrasa.css](public/css/dapurrasa.css))

---

## Cara Instalasi & Menjalankan

1. **Clone repository**
   ```bash
   git clone https://github.com/ShandyTekno/dapurrasa.git
   cd dapurrasa
   ```

2. **Install dependency PHP**
   ```bash
   composer install
   ```

3. **Salin dan sesuaikan file `.env`**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
   Buat database MySQL bernama `dapurrasa`, lalu pastikan konfigurasi database di `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=dapurrasa
   DB_USERNAME=root
   DB_PASSWORD=
   ```

4. **Jalankan migrasi & seeder** (mengisi 5 kategori, 10 data menu contoh, dan 1 akun admin)
   ```bash
   php artisan migrate --seed
   ```

5. **Buat symbolic link storage** agar foto produk dapat diakses publik
   ```bash
   php artisan storage:link
   ```

6. **Jalankan server lokal**
   ```bash
   php artisan serve
   ```
   Buka di browser: `http://127.0.0.1:8000`

---

## Akun Admin Default (Seeder)

- **URL Login**: `/login`
- **Email**: `admin@dapurrasa.com`
- **Password**: `admin12345`

> Ganti kredensial default sebelum digunakan di lingkungan produksi.

---

## Pengujian

Jalankan automated feature test (mencakup halaman publik, seeder, pencarian, proteksi admin, login, validasi, dan CRUD + upload foto):

```bash
php artisan test
```
