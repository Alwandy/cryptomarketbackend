# Description
This web app was designed to provide users overview of today cryptocurrency market 

# How to use
The project itself is hosted on neumarketcap.herokuapp.com but to host it yourself you need to git the project and follow the steps below: 

1. When project has been downloaded, please open up ".env" file. 

2. Open up a powershell window and go to the project fodler and execute: 
"php artisan key:generate" 

3. Copy the code and replace the line of key currently on APP_KEY= with the new code. 

4. Run composer cmd: composer update & composer install (requires composer: https://getcomposer.org/doc/00-intro.md) 

5. Make sure PHP 7.0 is installed and configured correctly per https://laravel.com/docs/5.5/installation 

6. As we already have pre created tables for you under database/migrations you need to run "php artisan migrate --force" as it will create the tables for you in the database you specified in .env and /config/database.php or use the one we provided.

7. All steps done above, then run "php artisan serve" to start hosting app locally.

Any issues, email x14128314@student.ncirl.ie 
