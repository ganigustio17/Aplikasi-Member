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

8. Generate Application Key
Ketik: php artisan key:generate

9. Migrasi database
ketik: php artisan migrate

10. Jalankan seeder
ketik: php artisan db:seed --class=RolePermissionSeeder lalu  php artisan db:seed --class=AdminUserSeeder
di laman login, gunakan data yang ada di AdminUserSeeder untuk login.

12. Jalankan server Laravel
Ketik: php artisan serve

