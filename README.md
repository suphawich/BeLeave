# Installation
1. Install Laravel 5.6.12
    - create-project --prefer-dist laravel/laravel BeLeave v5.6.12
2. Install node js (npm)
    - npm install
3. Install font awesome
    - npm install font-awesome --save
    - @import "~font-awesome/scss/font-awesome.scss"; ใน resources/assets/saas/app.scss
    - npm run dev

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

