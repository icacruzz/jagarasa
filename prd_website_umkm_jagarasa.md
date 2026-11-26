# Product Requirements Document (PRD)
## Website Katalog & Manajemen Produk UMKM "JAGARASA" (Oleh-Oleh Khas Lampung)

---

### 1. Informasi Umum Proyek
* **Nama Usaha:** Jagarasa (Inisial "J" dari Jagarya)
* **Bidang Usaha:** Kuliner & Pusat Oleh-Oleh Snack Khas Lampung
* **Tagline:** *"Menjaga Keaslian Rasa, Menghadirkan Kehangatan Lampung"*
* **Deskripsi Usaha:** Jagarasa adalah UMKM kuliner yang berfokus pada produksi dan penjualan camilan serta oleh-oleh autentik khas Provinsi Lampung, seperti Keripik Pisang Kepok aneka rasa, Keripik Singkong Balado, Kemplang Panggang, dan Kopi Robusta Lampung. Mengusung filosofi "Jaga Rasa", setiap produk diolah dari bahan baku lokal pilihan dengan standar kebersihan tinggi tanpa mengorbankan cita rasa tradisional.
* **Tech Stack Utama:**
  * **Framework:** Laravel (PHP 8.2+)
  * **Database:** MySQL / MariaDB
  * **Frontend & Styling:** Blade Template + Tailwind CSS + Heroicons / Font Awesome
  * **Storage:** Laravel Public Storage (`storage/app/public`) untuk manajemen gambar produk

---

### 2. Tujuan & Ketentuan Teknis (Checklist UTS)
Dokumen ini disusun untuk memenuhi seluruh kriteria proyek UTS pengembangan web dinamis menggunakan Laravel dengan standar kode yang bersih dan terstruktur:
- [x] **Identitas UMKM:** Nama usaha sesuai inisial pendiri (Jagarasa), dilengkapi logo Siger & Keripik, serta deskripsi profil usaha pada halaman utama.
- [x] **Project Laravel Berjalan:** Dapat dijalankan dengan lancar menggunakan `php artisan serve` tanpa error.
- [x] **Relasi Database (Minimal 2 Tabel):** Menggunakan tabel `categories` dan `products` dengan relasi *One-to-Many* (`Category hasMany Product`, `Product belongsTo Category`).
- [x] **Eloquent ORM:** Pengambilan dan manipulasi data dilakukan sepenuhnya melalui Model Eloquent dengan *Eager Loading* (`with('category')`) agar query efisien.
- [x] **Halaman Dinamis:**
  - **Halaman Publik:** Beranda (Profil Usaha + Katalog Produk dari database) dan Halaman Detail Produk.
  - **Halaman Admin:** Dashboard CRUD (Create, Read, Update, Delete) untuk mengelola produk.
- [x] **Upload Gambar:** Fitur unggah foto produk yang disimpan di `storage/app/public/produk` dan diakses melalui `php artisan storage:link`.
- [x] **Validasi Server-Side:** Validasi form di sisi server menggunakan Form Request / Validator dengan aturan lengkap (`required`, `max`, `numeric`, `image`, `mimes`).
- [x] **Desain Responsif & Eye-Catching:** Antarmuka responsif di desktop maupun mobile menggunakan palet warna yang selaras dengan logo Jagarasa.
- [x] **Database Seeder:** Menyediakan minimal 5 data produk awal (plus kategori) agar halaman publik langsung terisi dan siap ditampilkan.

---

### 3. Desain UI/UX & Identitas Visual (*Selaras dengan Logo*)

#### 3.1. Palet Warna (Mengacu pada Logo Jagarasa)
* **Primary Color (Emas Siger & Kuning Pisang):** `#F59E0B` (Amber-500) & `#D97706` (Amber-600) — Mengambil warna mahkota Siger Lampung dan ilustrasi keripik pisang untuk tombol aksi utama (*Call-to-Action*) dan sorotan visual.
* **Secondary Color (Cokelat Tua Teks Logo):** `#451A03` (Amber-950) & `#5C2D16` — Mengambil warna tipografi tebal "JAGARASA" pada logo untuk warna judul utama, *footer*, dan teks agar kontras serta nyaman dibaca.
* **Accent Color (Hijau Daun Pisang):** `#15803D` (Green-700) & `#22C55E` (Green-500) — Mengambil warna ornamen daun pisang pada logo untuk *badge* kategori, status stok tersedia, dan aksen kesegaran alami.
* **Background Color:** `#FFFBEB` (Amber-50 / Krem Hangat) dan `#FFFFFF` (Putih Bersih) agar foto produk keripik terlihat menonjol.

#### 3.2. Tipografi
* **Heading (Judul):** *Plus Jakarta Sans* atau *Poppins* (Bold/ExtraBold) — Tegas, modern, dan ramah.
* **Body (Teks):** *Inter* (Regular/Medium) — Bersih dan mudah dibaca untuk deskripsi produk maupun tabel admin.

#### 3.3. Struktur Halaman & Tata Letak
1. **Navbar (Sticky):**
   * Logo resmi Jagarasa di sisi kiri (`public/images/logo-jagarasa.png`).
   * Menu navigasi: *Beranda*, *Tentang Kami*, *Katalog Oleh-Oleh*, dan tombol menonjol **"+ Kelola Produk"** (mengarah ke panel admin untuk memudahkan demonstrasi tambah/ubah/hapus produk).
2. **Hero Section:**
   * Latar belakang krem hangat (`#FFFBEB`) dengan aksen emas Siger dan foto produk unggulan.
   * Judul besar: *"Oleh-Oleh Khas Lampung, Renyahnya Bikin Rindu Kampung Halaman"*.
   * Tombol CTA: *"Jelajahi Katalog"* (Kuning Emas) dan *"Tentang Jagarasa"* (Outline Cokelat Tua).
3. **Section Profil Usaha (Tentang Jagarasa):**
   * Menampilkan logo resmi Jagarasa, narasi filosofi usaha, serta 3 kartu keunggulan (Bahan Baku Lokal Lampung, Kemasan Higienis, Rasa Autentik).
4. **Section Katalog Produk (Publik):**
   * Filter kategori interaktif (*Semua*, *Keripik Pisang*, *Keripik Singkong*, *Kemplang & Olahan Ikan*, *Kopi Lampung*).
   * Grid Card Responsif (`grid-cols-1 sm:grid-cols-2 lg:grid-cols-3`): Menampilkan foto produk, *badge* kategori hijau daun pisang, nama produk, harga format Rupiah (`Rp 28.000`), berat bersih, dan tombol **"Lihat Detail"**.
5. **Halaman Detail Produk (`/produk/{slug}`):**
   * Foto produk ukuran besar, nama produk, kategori, harga, berat bersih (gram), status stok, deskripsi lengkap komposisi & rasa, serta tombol simulasi pesan via WhatsApp.
6. **Halaman Admin / Manajemen Produk (`/admin/produk`):**
   * Tampilan dashboard rapi berbasis tabel dengan *thumbnail* gambar produk, nama, kategori, harga, stok, serta tombol aksi **Edit** dan **Hapus**.
   * Tombol utama **"+ Tambah Produk Baru"** yang membuka form input produk lengkap dengan *live preview* gambar sebelum diunggah.

---

### 4. Arsitektur Folder & Kerapian Kode (*Clean Structure*)

Untuk menjaga kode tetap modular, mudah dibaca, dan sesuai standar *best practice* Laravel MVC, struktur file diatur sebagai berikut:

```text
jagarasa-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── HomeController.php          # Menangani halaman publik (beranda, filter, detail)
│   │   │   └── Admin/
│   │   │       └── ProductController.php   # Menangani CRUD produk & upload storage
│   │   └── Requests/
│   │       ├── StoreProductRequest.php     # Validasi terpisah untuk tambah produk
│   │       └── UpdateProductRequest.php    # Validasi terpisah untuk ubah produk
│   └── Models/
│       ├── Category.php                    # Model kategori + relasi hasMany
│       └── Product.php                     # Model produk + relasi belongsTo & helper format harga
├── database/
│   ├── migrations/
│   │   ├── xxxx_create_categories_table.php
│   │   └── xxxx_create_products_table.php
│   └── seeders/
│       ├── CategorySeeder.php              # Data awal kategori oleh-oleh Lampung
│       ├── ProductSeeder.php               # Data awal 5 produk unggulan Jagarasa
│       └── DatabaseSeeder.php              # Pemanggil utama seeder
├── public/
│   └── images/
│       └── logo-jagarasa.png               # Aset logo resmi Jagarasa
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php               # Master layout halaman publik (Navbar + Footer)
│       │   └── admin.blade.php             # Master layout panel admin
│       ├── components/
│       │   └── product-card.blade.php      # Komponen reusable kartu produk
│       ├── home/
│       │   ├── index.blade.php             # Halaman beranda (Hero + Profil + Katalog)
│       │   └── show.blade.php              # Halaman detail produk
│       └── admin/
│           └── products/
│               ├── index.blade.php         # Daftar tabel produk admin
│               ├── create.blade.php        # Form tambah produk
│               └── edit.blade.php          # Form edit produk
└── routes/
    └── web.php                             # Definisi route publik & prefix grup /admin
```

#### Prinsip Kerapian Kode (*Clean Code Standards*):
1. **Pemisahan Validasi (Form Request):** Aturan validasi tidak menumpuk di dalam Controller, melainkan dipisahkan ke `StoreProductRequest` dan `UpdateProductRequest`.
2. **Blade Component & Layout Inheritance:** Menggunakan `@extends`, `@section`, dan `<x-product-card />` agar tidak ada duplikasi kode HTML pada header, footer, maupun kartu produk.
3. **Storage Cleanup:** Saat produk dihapus (`destroy`) atau gambarnya diperbarui (`update`), file gambar lama otomatis dihapus menggunakan `Storage::disk('public')->delete(...)` agar tidak menumpuk sampah file.
4. **Eager Loading:** Menggunakan `Product::with('category')->latest()->get()` untuk mencegah masalah *N+1 Query*.

---

### 5. Arsitektur Database & Relasi

#### 5.1. Tabel `categories`
Menyimpan daftar kategori oleh-oleh khas Lampung.

| Nama Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `BIGINT (PK, AI)` | Primary Key |
| `nama_kategori` | `VARCHAR(100)` | Contoh: Keripik Pisang, Keripik Singkong, Kemplang, Kopi |
| `slug` | `VARCHAR(120)` | Unique slug untuk URL |
| `deskripsi` | `TEXT (Nullable)` | Keterangan singkat kategori |
| `created_at` | `TIMESTAMP` | Waktu dibuat |
| `updated_at` | `TIMESTAMP` | Waktu diperbarui |

#### 5.2. Tabel `products`
Menyimpan data produk oleh-oleh yang berelasi dengan `categories`.

| Nama Kolom | Tipe Data | Keterangan |
| :--- | :--- | :--- |
| `id` | `BIGINT (PK, AI)` | Primary Key |
| `category_id` | `BIGINT (FK)` | Foreign Key mengacu pada `categories.id` (`onDelete('cascade')`) |
| `nama_produk` | `VARCHAR(150)` | Nama produk snack Lampung |
| `slug` | `VARCHAR(170)` | Unique slug untuk halaman detail |
| `harga` | `INTEGER` | Harga dalam Rupiah (contoh: `28000`) |
| `stok` | `INTEGER` | Jumlah ketersediaan produk |
| `berat_gram` | `INTEGER` | Berat bersih kemasan dalam gram (contoh: `250`) |
| `deskripsi` | `TEXT` | Penjelasan rasa, tekstur, dan bahan baku |
| `gambar` | `VARCHAR(255)` | Path file gambar yang disimpan di `storage/public/produk` |
| `created_at` | `TIMESTAMP` | Waktu dibuat |
| `updated_at` | `TIMESTAMP` | Waktu diperbarui |

#### 5.3. Relasi Eloquent Model
* **Model `Category` (`app/Models/Category.php`):**
  ```php
  public function products()
  {
      return $this->hasMany(Product::class);
  }
  ```
* **Model `Product` (`app/Models/Product.php`):**
  ```php
  public function category()
  {
      return $this->belongsTo(Category::class);
  }
  ```

---

### 6. Data Awal (Database Seeder - Wajib 5 Produk)

Agar halaman publik langsung terisi dan menarik saat pertama kali dijalankan (`php artisan db:seed`), sistem akan men-generate **4 Kategori** dan **5 Produk Unggulan Jagarasa**:

1. **Keripik Pisang Kepok Cokelat Lumer**
   * **Kategori:** Keripik Pisang
   * **Harga:** Rp 28.000 | **Berat:** 250g | **Stok:** 45
   * **Deskripsi:** Keripik pisang kepok pilihan khas Lampung yang dipotong tipis renyah dan dibalut bubuk cokelat premium tebal yang lumer di mulut.
2. **Keripik Pisang Kepok Rasa Keju Susu**
   * **Kategori:** Keripik Pisang
   * **Harga:** Rp 28.000 | **Berat:** 250g | **Stok:** 30
   * **Deskripsi:** Perpaduan gurihnya keju dan manisnya susu bubuk yang membalut sempurna keripik pisang kepok kuning asli Pesawaran, Lampung.
3. **Keripik Singkong Balado Pedas Manis**
   * **Kategori:** Keripik Singkong
   * **Harga:** Rp 20.000 | **Berat:** 200g | **Stok:** 50
   * **Deskripsi:** Singkong lokal pilihan yang digoreng garing lalu dimasak dengan bumbu karamel cabai merah asli, menghasilkan sensasi pedas manis yang bikin ketagihan.
4. **Kemplang Panggang Ikan Tenggiri + Sambal Terasi**
   * **Kategori:** Kemplang & Olahan Ikan
   * **Harga:** Rp 32.000 | **Berat:** 200g | **Stok:** 25
   * **Deskripsi:** Kerupuk kemplang tradisional yang dipanggang di atas bara api tanpa minyak, terbuat dari ikan tenggiri segar lengkap dengan sambal terasi khas Lampung di dalam kemasan.
5. **Kopi Bubuk Robusta Lampung Barat (Fine Grind)**
   * **Kategori:** Kopi Lampung
   * **Harga:** Rp 35.000 | **Berat:** 200g | **Stok:** 40
   * **Deskripsi:** Biji kopi Robusta petik merah dari dataran tinggi Liwa, Lampung Barat. Memiliki aroma cokelat yang kuat, body tebal, dan rasa pahit yang mantap.

---

### 7. Spesifikasi Fungsional & Validasi Form

#### 7.1. Daftar Routing (`routes/web.php`)
* **Halaman Publik:**
  * `GET /` -> `HomeController@index` (Menampilkan profil UMKM, filter kategori, & katalog 5+ produk).
  * `GET /produk/{slug}` -> `HomeController@show` (Menampilkan halaman detail per produk).
* **Halaman Admin (Prefix `/admin`):**
  * `GET /admin/produk` -> `Admin\ProductController@index` (Tabel daftar produk).
  * `GET /admin/produk/create` -> `Admin\ProductController@create` (Form tambah produk baru).
  * `POST /admin/produk` -> `Admin\ProductController@store` (Menyimpan produk baru & upload gambar).
  * `GET /admin/produk/{product}/edit` -> `Admin\ProductController@edit` (Form ubah data produk).
  * `PUT /admin/produk/{product}` -> `Admin\ProductController@update` (Memperbarui data produk & mengganti gambar jika ada).
  * `DELETE /admin/produk/{product}` -> `Admin\ProductController@destroy` (Menghapus produk beserta file gambarnya dari storage).

#### 7.2. Aturan Validasi Server-Side (`FormRequest`)
1. `nama_produk`: `'required|string|max:150'` *(Wajib diisi, teks, maksimal 150 karakter)*
2. `category_id`: `'required|exists:categories,id'` *(Wajib dipilih, valid di tabel kategori)*
3. `harga`: `'required|numeric|min:1000'` *(Wajib diisi, tipe angka, minimal 1000)*
4. `stok`: `'required|integer|min:0'` *(Wajib diisi, bilangan bulat, minimal 0)*
5. `berat_gram`: `'required|integer|min:10'` *(Wajib diisi, bilangan bulat)*
6. `deskripsi`: `'required|string|max:1000'` *(Wajib diisi, maksimal 1000 karakter)*
7. `gambar`:
   * Saat Create (`StoreProductRequest`): `'required|image|mimes:jpeg,png,jpg,webp|max:2048'`
   * Saat Update (`UpdateProductRequest`): `'nullable|image|mimes:jpeg,png,jpg,webp|max:2048'`

---

### 8. Langkah Setup & Pengujian Aplikasi
1. Buat project Laravel baru: `composer create-project laravel/laravel jagarasa-app`
2. Konfigurasi database pada file `.env` (`DB_DATABASE=db_jagarasa`).
3. Simpan file logo ke `public/images/logo-jagarasa.png`.
4. Jalankan migrasi dan seeder: `php artisan migrate --seed`
5. Buat symbolic link untuk akses gambar publik: `php artisan storage:link`
6. Jalankan server lokal: `php artisan serve`