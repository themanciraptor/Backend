-- Setup Git user - So github can automatically commit sql updates
CREATE USER 'git'@'localhost' IDENTIFIED BY 'gitcommitpassward';
GRANT ALL PRIVILEGES ON *.* TO 'git'@'localhost' WITH GRANT OPTION;

-- Setup admin user - For MySQL Workbench
CREATE USER 'username'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' WITH GRANT OPTION;