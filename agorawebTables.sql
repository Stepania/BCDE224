drop database agoraweb;

create database agoraweb;

use agoraweb;
-- drop table agorauser;
-- drop table business;
-- drop table product;
-- drop table Purchase;
-- drop table ProductOrder;


-- creating table Business
create table business(
businessID int auto_increment not null,
companyName varchar(50) not null,
NZBN varchar(13) not null,
address varchar(60) NOT NULL,
companyLogo VARCHAR(50) NULL,
bankAccount binary(16) not null,
primary key (businessID,companyName,NZBN),
constraint businessID unique (businessID)
)engine=innodb;

select * from business;
-- creating table User with a reference to Business table

create table agorauser(
userID int auto_increment not null,
username varchar(20) not null,
email varchar(50) not null,
userPassword binary(40) not null,
firstName varchar(50) not null,
lastName varchar(80) not null,
userAddress varchar(60) NOT NULL,
businessID int null,
userRole varchar(20) not null,
primary key (userID),
constraint userID unique (userID),
constraint username unique (username),
foreign key (businessID) references Business(businessID)
)engine=innodb;

-- drop table Product ;

create table Product(
productID int auto_increment not null,
productName varchar(30) null,
price DECIMAL(10,2),
productDescription varchar(50) null,
productPicture VARCHAR(50) NULL,
sellerID int not null,
listingDate date not null,
primary key(productID),
constraint productID unique (productID),
foreign key (sellerID) references agorauser(userID)
)engine=innoDB;

