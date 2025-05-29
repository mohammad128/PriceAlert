## Run With Docker
###### Run commands step by step

```bash 
docker-compose up -d --build 
```
```bash 
docker-compose exec app cp .env.example .env
```
```bash 
docker-compose exec app composer install
```
```bash 
docker-compose exec app php artisan key:generate
```
```bash 
docker-compose exec app php artisan migrate
```
#### Open [http://127.0.0.1:8080](http://127.0.0.1:8080)
#### Phpmyadmin [http://127.0.0.1:8081](http://127.0.0.1:8081) (user: wallex, pass: wallex) or root (user: root, pass: toor)
___
## Manual Install
```bash 
composer install
```
```bash 
cp .env.example .env
```
###### Then set environments in .env.
```bash 
php artisan key:generate
```
```bash 
php artisan migrate
```
```bash 
php artisan serve
```
