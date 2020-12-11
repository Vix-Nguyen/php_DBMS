create user 'Manager'@'%' identified with mysql_native_password by '11111111';
use mysql;

-- to create triggers
grant super on *.* to 'Manager'@'%';
grant all privileges on *.* to 'Manager'@'%';
flush privileges;
create database hospital;