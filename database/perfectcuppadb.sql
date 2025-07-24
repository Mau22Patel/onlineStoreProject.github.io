create database  perfectcuppadb; 
use perfectcuppaDB; 
create table product ( 
 productID varchar(8) not null, 
 productName varchar (30) not null, 
 productPrice double (5,2) not null, 
 qty int (4),
 primary key (productID)

);

-- inserting products to product table 
insert into product (productID,productName,productPrice,qty) values 
("101", "Peppermint Loose Tea", 15.00,100 ),
("102", "Lemongrass Tea Bags", 23.00,120 ),
("103", "Japanese Green Tea", 25.00,220 ),
("104", "English Breakfast  Tea", 40.00,180 ),
("105", "Loose Spiced Tea ", 50.00,300 ),
("106", "Matcha Powder", 60.00,150 ),
("107", "Loose Assam Tea", 43.00,150 ),
("108", "Japanese Tea Pot", 180.00,60 );

use perfectcuppaDB; 
create table user ( 
 userID int (100) not null, 
 email varchar (30) not null, 
 password varchar (20) not null, 
 firstName varchar(50) not null, 
 lastName varchar (50) not null, 
 telephone varchar (20) not null, 
 primary key (userID)
); 

use perfectcuppaDB; 
create table Orders ( 
 orderID varchar(30) not null, 
 email varchar (30) not null, 
 totalAmount double (10,2) not null, 
 status varchar(15), 
 shippingCharges double (10,2) not null, 
 status varchar (15),
 billingAddress varchar (100) not null, 
 primary key (orderID)

); 

use perfectcuppaDB; 
create table OrderDetails ( 
 OrderDetailsID int not null auto_increment
orderID varchar(30) not null,  
 productID varchar(8) not null, 
 qty int (4) not null, 

primary key (OrderDetailsID)

); 