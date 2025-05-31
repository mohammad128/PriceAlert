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
docker-compose exec app php artisan migrate:fresh --seed
```
```bash 
docker-compose exec app php artisan queue:work 
```
#### for track email logs run this command
```bash 
docker-compose exec app tail -f storage/logs/laravel.log
```



#### Now open [http://127.0.0.1:8080](http://127.0.0.1:8080)
#### Phpmyadmin [http://127.0.0.1:8081](http://127.0.0.1:8081) (user: wallex, pass: wallex) or root (user: root, pass: toor)
#### Redisinsight [http://localhost:8082](http://localhost:8082)


___
## Manual Install
```bash 
composer install
```
```bash 
cp .env.example .env
```
###### Then set environments in .env.
###### add command `php artisan schedule:run` to crontab
```bash 
php artisan key:generate
```
```bash 
php artisan migrate:fresh --seed
```
```bash 
php artisan queue:work
```
```bash 
php artisan serve --port=8080
```
#### for track email logs run this command
```bash 
tail -f storage/logs/laravel.log
```


___
## Test Endpoint`s
### Add Alert
```bash 
curl --location 'http://127.0.0.1:8080/api/set-alert' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json' \
--data '{
    "user_id": 1,
    "price": 1000
}'
```

### Get Current Gold Price
```bash 
curl --location --request POST 'http://127.0.0.1:8080/api/current-price' \
--header 'Content-Type: application/json' \
--header 'Accept: application/json'
```
