# Installation for using project
1. Clone peoject (Project fixed config and initial project)
2. Don't migration database because this project use database on web hosting
    or new migration with
    - php artisan migrate:reset
    - php artisan migrate
3. follow this command
    - php artisan serve
4. Go to "how do it work?"


# Installation for initialization project
1. Install Laravel 5.6.12
    - create-project --prefer-dist laravel/laravel BeLeave v5.6.12
2. Install node js (npm)
    - npm install
3. Install font awesome
    - npm install font-awesome --save
    - @import "~font-awesome/scss/font-awesome.scss"; ใน resources/assets/saas/app.scss
    - npm run dev
4. Download project file from github
5. Replace view, aoo, route and migration folder to folder which installed


# How to work?
    First, you can sign in to dashboard, if you have account or sign up which log in page. Registration don't verify email or account id, but user got password (generate by server) for sign in. Second, after sign in can use function:
    - 


# Config
1. edit default disk path (for storing file)
    - In "config/filesystem.php" change "storage_path()" to "public_path()"
2. Window to Mac
    - follow this command "chmod -R u+x ."

# Packages
    - Form & HTML Collective https://laravelcollective.com/docs/5.4/html
    - Gbrock Laravel-table https://github.com/gbrock/laravel-table
    - Lavacharts http://lavacharts.com

# How to commit file to gitHub
    - Upload folder app, database, public, resources, routes or file has been edited only.
    - Avoid complex structure project
