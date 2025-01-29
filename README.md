Cara Menjalankan Project Laravel


1. Clone repository
Jalankan perintah: git clone nama-repo-github

2. Masuk ke folder project
Ketik: cd ./nama-folder-project/

3. Buka project di editor
Jika menggunakan Visual Studio Code, ketik: code .

4. Install dependency dengan Composer
Ketik: composer install
Jika composer install gagal, coba:
composer update lalu composer install
Jika tetap gagal, gunakan:
composer update --no-cache lalu composer install --no-cache

5. Buat database di MySQL
Buka MySQL atau phpMyAdmin.
Buat database baru sesuai keinginan Anda.

6. Salin file .env
Ketik: cp .env.example .env

7. Atur konfigurasi database di file .env
Buka file .env.
Cari bagian berikut dan sesuaikan:
DB_DATABASE=nama_database
DB_USERNAME=nama_user
DB_PASSWORD=password

pada bagian dibawah isi dengan ketentuan seperti ini :
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=isi dengan email anda 
MAIL_PASSWORD=isi dengan cara mengaktifkan A2F pada email yang dipakai pada bagian MAIL_USERNAME, jika sudah aktif, pergi ke pencarian lalu cari app password atau sandi aplikasi lalu buat project baru lalu nanti akan muncul kode, lalu salin kode tersebut kebagian ini (MAIL_PASSWORD).
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="hello@example.com"
MAIL_FROM_NAME="${APP_NAME}"

9. Generate Application Key
Ketik: php artisan key:generate

10. Migrasi database
ketik: php artisan migrate

11. Jalankan seeder
ketik: php artisan db:seed --class=RolePermissionSeeder lalu  php artisan db:seed --class=AdminUserSeeder.
saat di laman login, gunakan data yang ada di AdminUserSeeder untuk login.
jangan lupa juga untuk menjalankan perintah ini :
npm install lalu npm run build.

12. Jalankan server Laravel
Ketik: php artisan serve

