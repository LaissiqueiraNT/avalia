# avalia


docker compose up -d --build
docker exec -it avalia-app-1 bash
composer install
php artisan migrate
php artisan db:seed

npm install
npm run build
