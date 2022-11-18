use agoraweb;


select * from business;
select * from agorauser;
select* from product;

SET @encrypt_key = SHA2('kjqweq43423jfhdqw4e', 256);

INSERT INTO Business (companyName,NZBN,address,companyLogo,bankAccount) VALUES 
("Fasteners",1234569632364,"Christchurch,2 kissel street","cross.jpg",1234564789632584),
("Troy",1363784596325,"Christchurch,2 Brougham street","cross1.jpg",2564795456985456),
("LooseScrews",1269784596325,"Wellington,8 Krouch street","dude.jpg",1236547896565956),
("Trademark",2369784596325,"Hamilton,2 Brams street","fit.jpg",369852147856325),
("EcoTools",5369784596325,"Auckland,11 Riverside street","house.jpg",1236547896512365);

insert into agorauser (username,email,userPassword,firstName,lastName,userAddress,businessID,userRole) 
values ("fasteners","fasteners@gmail.com","qwerty12345","Alex","Props","",1,"Admin"),
 ("troy","troy@gmail.com","qwerty12345","John","Black","",3,"Buyer"), 
 ("looseScrew","loosescrew@gmail.com","qwerty1","Ivan","Drago","",4,"Buyer"),
 ("trademark","trademark@gmail.com","qwerty12","Rocky","Balboa","",2,"Buyer"),
 ("ecotools","ecotools@gmail.com","qwerty123","John","Travolta","",3,"Buyer"),
 ("workman","workman@gmail.com","qwerty1234","Sarah","Parker","Auckland,265 main street",2,"Buyer"),
 ("drenders","drenders@gmail.com","qwerty12345","Karen","Volk","Auckland,25 main street",1,"Seller"),
 ("fortnight","fortnight@gmail.com","qwerty123454","Melissa","King","Auckland,456 Main street",2,"Seller"),
 ("toolPro","toolpro@gmail.com","qwerty123453","Cristian","Kloud","Auckland,4 Fitzerald street",3,"Seller"),
 ("fitYou","fityou@gmail.com","qwerty123452","Eva","Mandis","Auckland,2 Manukai street",4,"Seller"),
 ("IamBoss","admin@gmail.com","qwerty123451","Philip","Stresful","",5,"Admin");
 
-- 7,8,9
select * from product;
insert into product(productName,price,productDescription,productPicture,sellerID,listingDate)
values("Screwdriver",35.00,"the best screwdriver you ever seen","screwdriv.jpg",7,now()),
("Shovel",85.00,"Dewalt,hight standarts.","shovel.jpg",7,now()),
("Hammer",85.00,"Eastwing. Best hammers in the market of hammers.","hammer.jpg",7,now()),
("Skill saw",250.00,"Makita,diameter is 165 mm","skilly.jpg",8,now()),
("Sledge Hammer",120.00,"Weight is 10 lbs.","sledge.jpg",9,now()),
("Multitool",200.00,"Boch. Easy to assemble,easier to use.","makitaTool.jpg",7,now()),
("Wrench set",55.00,"Stanley wrench","wrenchset.jpg",8,now()),
("Pencils.Box",50.00,"Box of a hard pencils,100pcs","pencils.jpeg",7,now());




