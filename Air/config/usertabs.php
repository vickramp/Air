<?php
require 'dbconfig.php';
$db=connectDataBase('users');
$q='CREATE TABLE if not exists user (
userno  bigint  AUTO_INCREMENT PRIMARY KEY,
regdno varchar(20) not null unique,
fname VARCHAR(30) ,
mname varchar(30) ,
lname VARCHAR(30) ,
fathname varchar(50),
mothname varchar(50),
phno1 INT(15),
phno2 int(15),
phno3 int(15),
email VARCHAR(50),
fb varchar(50),
google varchar(50),
address text,
password VARCHAR(100),
picture mediumblob,
sex char(1),
bgroup varchar(3),
dob varchar(20),
type tinyint ,
branch tinyint,
year tinyint,
section varchar(1) default null,
joindate date,
sem int
)'
;
if ($db->query($q) === TRUE) {
    echo "table created successfully";
} else {
    echo "Error creating table: " . $db->error;
}
?>
