# Bibmark


### Installation

+ npm i or yarn install

+ composer install

+ cp .env.example .env `(configure .env file)`
+ php artisan key:generate

+ Skip above two steps if you're using your own `.env` file

+ php artisan migrate
+ php artisan serve


### AWS Dev Server

+ chmod 400

+ ssh -i `bak/bibmark_dev.pem` ec2-user@54.167.46.107
