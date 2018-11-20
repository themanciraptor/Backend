# Backend
The Avengers!

# Purpose
To be a shitty backend written in PHP

# Setting up local development
1. Install Composer https://getcomposer.org/doc/00-intro.md
2. enable ast https://github.com/nikic/php-ast#installation
3. On the commandline run `composer install`

## Setup local mysql db:
1. Install mysql if not already installed: `sudo apt-get install mysql-server`
2. `sudo mysql`

### Setup MySQL Users
Scripts are written under the assumption that you have a dedicated git user in your sql database. If you want to use a single user for all, just erase the one you don't care about and update the scripts to use your chosen username.
1. Open the `db_setup.sql` and replace all instances of username with your chosen username.
2. In the commandline run `sudo mysql < db_setup.sql`. 

### Setup Git Automatic Database Commits
1. Open db_setup.sh replace all instances of `[path to backend repo]` with the directory where the git repository is stored. For example, mine is at `~/Documents/Backend`. Please look at the script and ensure that it is not overwriting any files you have already setup.
2. run the db setup command `sh db_setup.sh`

### Setup MySQL Workbench
1. Download Mysql Workbench here --> `https://dev.mysql.com/downloads/file/?id=479197` 
2. Open MySQL Workbench, The Localhost instance should be listed under MySQL Connections. Right-click on it and select `edit connection`. Put your username you created above in the username field, enter your password, and then click test connection at the bottom. If everything is setup correctly, it should provide basic information about the database connection.
3. Open a query Tab for the localhost connection by clicking on it. If you have another database on your computer, you must first add the line `USE SASMA;`. An example query:
    ```
    USE SASMA;
    SELECT * FROM User;
    ```

## Setup Apache
1. Install apache2 if it isn't installed yet.
2. Add `rewrite` module. On debian-linux: `a2enmod rewrite`
3. Add the following configuration under the security model section:
    ```
    <VirtualHost *:80>
        ServerName sasma

        DocumentRoot /srv/SASMA

        <Directory /srv/SASMA>
            RewriteEngine on

            # Don't rewrite files or directories
            RewriteCond %{REQUEST_FILENAME} -f [OR]
            RewriteCond %{REQUEST_FILENAME} -d
            RewriteRule ^ - [L]

            # Rewrite everything else to index.html
            # to allow html5 state links
            RewriteRule ^ index.html [L]
        </Directory>
    </VirtualHost>
    ```
4. Systemctl restart apache2
5. Copy into /srv/SASMA the index.php, src folder, everything in the compiled dist/frontend folder. I used scripts, each run from their respective root project directories, to make it easy:
```
# Backend
cp ./index.php /srv/SASMA
cp -rf ./src /srv/SASMA
php -S localhost:8000 index.php

```
```
# Frontend
ng build --prod
cp -rf ./dist/frontend/* /srv/SASMA/
```
