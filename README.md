การติดตั้ง
1. 
```
composer install
```
2.
```
cp .env.example .env
```
 

3.
# สร้างดาต้าเบส dbmtn
## แล้วconfig ในไฟล์ .env
```
DB_DATABASE=dbmtn
DB_USERNAME=root
DB_PASSWORD=
```
4.
Run 
```
php artisan key:generate
php artisan migrate


```
สร้าง user
run
```
 php artisan db:seed --class=BranchSeeder
 php artisan db:seed --class=UserSeeder
 php artisan db:seed --class=WalletSeeder
``
สุดท้าย
______
php artisan serve
