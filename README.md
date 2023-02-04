## Tentang Repo

Ini adalah core app untuk memudahkan pengembangan aplikasi di USK. Repo ini dibangun menggunakan Framework Laravel 9. Versi PHP yang dibutuhkan adalah PHP v8. Repo ini memiliki fitur:

- Manajemen User (Manual user, User Pegawai, User Mhs)

## Tata cara penggunaan

- Silahkan fork repo ini kemudian jalankan `composer install`
- Copy .env.example ke file .env (buat baru)
- Isi value yang sesuai untuk .env

## Laravel Modules

Repo ini dibangun dengan tambahan package `nwidart/laravel-modules`. Full dokumentasi dari Laravel Modules dapat dilihat di [laravel-module-docs](https://github.com/nWidart/laravel-modules).
Beberapa command yang sering digunakan dalam laravel modules diantaranya:

- Buat module baru: `php artisan module:make [modulename]`
- Load assets module: `php artisan module:publish namamodule`, load js di view `modules/modulename/js/contoh.js`
- Tambah model per module: `php artisan module:make-model NamaModel NamaModule` (hal yang sama bisa dilakukan utk controller make-controller)
- Hapus module:
```
php artisan module:disable modulename
php artisan cache:clear
hapus folder module yang inginkan
php artisan cache:clear
```
