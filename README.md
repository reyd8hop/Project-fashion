 Fashion Store - Mini E-Commerce

 Deskripsi Project

Fashion Store adalah aplikasi e-commerce outfit kekinian yang dibangun menggunakan Laravel, Inertia.js, Vue, dan MySQL. Aplikasi ini memungkinkan pengguna untuk melihat produk, menambahkan ke keranjang, melakukan checkout, serta melihat riwayat pesanan. Admin dapat mengelola produk dan pesanan.

 Fitur Utama :

 User

- Register & Login
- Melihat daftar produk
- Detail produk
- Tambah ke keranjang
- Update quantity & hapus item
- Checkout
- Riwayat pesanan

 Admin

- CRUD produk
- Melihat semua pesanan
- Update status pesanan

 Teknologi yang Digunakan

- Laravel
- Inertia.js
- Vue.js
- Tailwind CSS
- MySQL

 Cara Instalasi

1. Clone repository:

git clone https://github.com/USERNAME/fashion-store.git
cd fashion-store

2. Install dependency:

composer install
npm install

3. Copy file environment:

cp .env.example .env

4. Generate key:

php artisan key:generate

5. Setup database di ".env"

6. Jalankan migration & seeder:

php artisan migrate --seed

7. Jalankan project:

php artisan serve
npm run dev

 Screenshot

<img width="1899" height="919" alt="Screenshot (156)" src="https://github.com/user-attachments/assets/b01d20fe-5703-46bf-83ba-91bd7322fa1b" />



 Catatan

- Untuk Admin bisa login menggunakan:
  Email: admin@example.com
  password: password
- Untuk User bisa register dulu
