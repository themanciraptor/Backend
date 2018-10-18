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
### Setup Git User
1. `CREATE USER 'git'@'localhost' IDENTIFIED BY 'gitcommitpassward';`
2. `GRANT ALL PRIVILEGES ON *.* TO 'git'@'localhost' WITH GRANT OPTION;`
3. Open db_setup.sh replace all instances of `[path to backend repo]` with the directory where the git repository is stored. For example, mine is at `~/Documents/Backend`. Please look at the script and ensure that it is not overwriting any files you have already setup.
4. run the db setup command `sh db_setup.sh`