
# Music Tracker (WIP)

Tool which tracks BYU Music department's practice, repertoire, and jury data.

## Getting Started Locally

Your machine will need to have the following downloaded:

-Composer

-php

-mysql DB (phpmyadmin is recommended)

-artisan


Here are the steps:
```
git clone https://github.com/traysonkelii/Grade-Tracker.git
cd Grade-Tracker/tracker
composer install
```
Now change the .env.example file to a .env file.

Add the app key to this environment variable shown below. (The app key will be given by a system admin, the project will not compile without this key)
```
APP_KEY=
```

To launch the local server:

```
php artisan serve
```
