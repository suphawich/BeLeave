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
    - If you are administrator
        - Personalization: show profile and can edit profile.
        - Accounts: show all account of website, moreover admin can find account with filter or search bar.
        - Detail: show information of website.
        - Graph: show analytic user.
        - User log: show login and logout of account.
        - System log: show action of user which action to server.
 
    - If you are Manager
        - Request Leave: accept or decline request.
        - Request position: accept or decline request.
        - Graph: show analytic of subordinate account.
        - Personalization: show profile and can edit profile.
        - Subscription: buy or upgrade package.
        
    - If you are Supervisor
        - Request Leave: accept or decline request.
        - Request position: accept or decline request.
        - Personalization: show profile and can edit profile.
 
    - If you are Subordinate
        - Leave: request new leave and show leave history and status.
        - Personalization: show profile and can edit profile.
        - Setting: Request change position to Supervisor.
Finally, after you regsitration, your account got Manager position, user have to buy package before create new Subordinate.

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
