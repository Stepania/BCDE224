USE agoraweb;
-- shhow product
DROP PROCEDURE IF EXISTS sp_showProduct;
DELIMITER //
CREATE PROCEDURE sp_showProduct(IN id INT)
BEGIN
	SELECT productID, productName,  productDescription, 
         productPicture, price, listingDate, sellerID, 
        CONCAT(firstName, ' ', lastName) AS sellerName, companyLogo
	FROM product p
	INNER  JOIN agoraUser au on au.userID=p.sellerID
    INNER JOIN business b on b.businessID=au.businessID
	WHERE productID = id;
END;
//
-- call sp_showProduct(5);
-- CALL sp_showAllProducts();
-- select * from product;
-- show listing querie/procedure
DROP PROCEDURE IF EXISTS sp_showAllProducts;
DELIMITER //
CREATE PROCEDURE sp_showAllProducts()
BEGIN
	SELECT productID, productName,  productDescription, 
         productPicture, price, listingDate, sellerID,
        CONCAT(firstName, ' ', lastName) AS sellerName
	FROM product p
	INNER  JOIN agoraUser au on au.userID=p.sellerID;
END;
//
-- check password and login
DROP PROCEDURE IF EXISTS sp_login;
DELIMITER //
CREATE PROCEDURE sp_login(IN theUsername VARCHAR(50))
BEGIN
	SELECT userPassword
	FROM agorauser where username = theUsername;
END;
//
-- testing
-- call sp_login('toolPro');
-- select* from agorauser;

-- need to create view for products!

-- 4. Create a view of products
create or replace view allProductSeller as
select  p.productID,p.sellerID,p.productName, p.listingDate, p.productPicture,p.price,CONCAT(au.firstName, ' ', au.lastName) AS sellerName,p.productDescription
from product p inner join agorauser au on p.sellerID=au.userID
inner join business b on au.businessID=b.businessID
group by b.businessID;
-- select* from allProductSeller
where sellerID=7;
-- insert into product(productName,price,productDescription,productPicture,sellerID,listingDate)
