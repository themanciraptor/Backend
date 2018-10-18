# Backend
The Avengers!

# Purpose
To be a shitty backend written in PHP

# Setting up local development
1. Install Composer https://getcomposer.org/doc/00-intro.md
2. enable ast https://github.com/nikic/php-ast#installation
3. On the commandline run `composer install`

## Setup local mysql db:
#### Note: These steps are tentative pending further investigation
1. `sudo apt-get install mysql-server`
2. `sudo mysql`
### Setup Git User
1. `CREATE USER 'git'@'localhost' IDENTIFIED BY 'gitcommitpassward';`
2. `GRANT ALL PRIVILEGES ON *.* TO 'git'@'localhost' WITH GRANT OPTION;`
4. run the db setup command `sh db_setup.sh`