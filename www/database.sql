CREATE TABLE IF NOT EXISTS Categories (
  CategoryID int(11) NOT NULL AUTO_INCREMENT,
  CategoryName varchar(15) NOT NULL,
  Description varchar(100) NOT NULL,
  PRIMARY KEY (CategoryID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Customers (
  CustomerID varchar(5) NOT NULL,
  CompanyName varchar(40) NOT NULL,
  ContactName varchar(30),
  Address varchar(60),
  City varchar(15),  
  PostalCode varchar(10),
  Country varchar(15),
  Phone varchar(24),
  PRIMARY KEY (CustomerID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS Suppliers (
  SupplierID int(11) NOT NULL AUTO_INCREMENT,
  CompanyName varchar(40),
  ContactName varchar(30),
  Address varchar(60),
  City varchar(15),  
  PostalCode varchar(10),
  Country varchar(15),
  Phone varchar(24),
  PRIMARY KEY (SupplierID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Shippers (
  ShipperID int(11) NOT NULL AUTO_INCREMENT,
  CompanyName varchar(40) NOT NULL,  
  Phone varchar(24),  
  PRIMARY KEY (ShipperID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Employees (
  EmployeeID int(11) NOT NULL AUTO_INCREMENT,
  LastName varchar(20) NOT NULL,
  FirstName varchar(20) NOT NULL,
  Title varchar(30),
  HireDate date,
  Address varchar(60),
  City varchar(15),  
  PostalCode varchar(10),  
  PRIMARY KEY (EmployeeID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Products(
  ProductID int(11) NOT NULL,
  ProductName varchar(255),
  SupplierID int(11),
  CategoryID int(11),
  QuantityPerUnit varchar(255),
  UnitPrice decimal(10,2),
  ProductCost decimal(10,2),
  Discontinued BOOL,  
  PRIMARY KEY (ProductID),
  KEY supplier_ibfk_1 (SupplierID),  
  KEY category_ibfk_2 (CategoryID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE Products
  ADD CONSTRAINT supplier_ibfk_1 FOREIGN KEY (SupplierID) REFERENCES Suppliers(SupplierID),
  ADD CONSTRAINT category_ibfk_2 FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID);


CREATE TABLE IF NOT EXISTS Orders(
  OrderID int(11) NOT NULL,
  CustomerID varchar(5) NOT NULL,
  EmployeeID int(11),
  OrderDate date,
  ExpectedShipDate date,
  ShipVia int(11),
  Freight decimal(10,2),
  ShipCountry varchar(255),  
  PRIMARY KEY (OrderID),
  KEY shipper_ibfk_1 (ShipVia),  
  KEY customer_ibfk_2 (CustomerID),
  KEY employee_ibfk_3 (EmployeeID)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE Orders
  ADD CONSTRAINT shipper_ibfk_1 FOREIGN KEY (ShipVia) REFERENCES Shippers(ShipperID),
  ADD CONSTRAINT customer_ibfk_2 FOREIGN KEY (CustomerID) REFERENCES Customers(CustomerID),
  ADD CONSTRAINT employee_ibfk_3 FOREIGN KEY (EmployeeID) REFERENCES Employees(EmployeeID);  

CREATE TABLE IF NOT EXISTS OrderDetails(
  OrderID int(11) NOT NULL,
  ProductID int(11) NOT NULL,
  Quantity int(11) NOT NULL,
  Discount decimal(4,2) DEFAULT '0',  
  PRIMARY KEY (OrderID,ProductID),
  KEY order_ibfk_1 (OrderID),  
  KEY product_ibfk_2 (ProductID)  
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

ALTER TABLE OrderDetails
  ADD CONSTRAINT order_ibfk_1 FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
  ADD CONSTRAINT product_ibfk_2 FOREIGN KEY (ProductID) REFERENCES Products(ProductID);
  
  
Insert INTO Categories(CategoryName,Description) VALUES
('Beverages','Soft drinks, coffees, teas, beers, and ales'),
('Condiments','Sweet and savory sauces, relishes, spreads, and seasonings'),
('Confections','Desserts, candies, and sweet breads'),
('Dairy Products','Cheeses'),
('Grains/Cereals','Breads, crackers, pasta, and cereal'),
('Meat/Poultry','Prepared meats'),
('Produce','Dried fruit and bean curd'),
('Seafood','Seaweed and fish');

INSERT INTO Customers VALUES
('BONAP','Bon app','Laurence Lebihan','12, rue des Bouchers','Marseille','13008','France','91.24.45.40'),
('CHOPS','Chop-suey Chinese','Yang Wang','Hauptstr. 29','Bern','3012','Switzerland','0452-076545'),
('KOENE','Königlich Essen','Philip Cramer','Maubelstr. 90','Brandenburg','14776','Germany','0555-09876'),
('LILAS','LILA-Supermercado','Carlos González','Carrera 52 con Ave. Bolívar #65-98 Llano Largo','Barquisimeto','3508','Venezuela','(9) 331-6954'),
('RICSU','Richter Supermarkt','Michael Holz','Grenzacherweg 237','Genève','1203','Switzerland','0897-034214'),
('SAVEA','Save-a-lot Markets','Jose Pavarotti','187 Suffolk Ln.','Boise','83720','USA','(208) 555-8097'),
('SPLIR','Split Rail Beer & Ale','Art Braunschweiger','P.O. Box 555','Lander','82520','USA','(307) 555-4680'),
('WHITC','White Clover Markets','Karl Jablonski','305 - 14th Ave. S.Suite 3B','Seattle','98128','USA','(206) 555-4112'),
('WILMK','Wilman Kala','Matti Karttunen','Keskuskatu 45','Helsinki','21240','Finland','90-224 8858');


INSERT INTO Employees (LastName, FirstName,  Title,  HireDate,  Address, City, PostalCode) VALUES 
('Davolio','Nancy','Sales Representative','2012-5-1','507 - 20th Ave. E. Apt. 2A','Seattle','98122'),
('Fuller','Andrew','Vice President, Sales','2012-8-14','908 W. Capital Way','Tacoma','98401'),
('Lorah','Ron','Sales Representative','2009-4-1','722 Moss Bay Blvd.','Kirkland','98033'),
('Peacock','Margaret','Sales Representative','2008-5-3','4110 Old Redmond Rd.','Redmond','98052'),
('Buchanan','Steven','Sales Manager','2005-10-17','14 Garrett Hill','London','SW1 8JR'),
('Suyama','Michael','Sales Representative','2006-10-17','Coventry House Miner Rd.','London','EC2 7JR'),
('King','Robert','Sales Representative','2005-1-2','Edgeham Hollow, Winchester Way','London','RG1 9SP'),
('Callahan','Laura','Inside Sales Coordinator','2011-3-5','4726 - 11th Ave. N.E.','Seattle','98105'),
('Dodsworth','Anne','Sales Representative','2010-11-15','7 Houndstooth Rd.','London','WG2 7LT');


INSERT INTO Suppliers VALUES 
('3','Grandma Kelly''s Homestead','Regina Murphy','707 Oxford Rd.','Ann Arbor','48104','USA','(313) 555-5735'),
('5','Cooperativa de Quesos ''Las Cabras''','Antonio del Valle Saavedra ','Calle del Rosal 4','Oviedo','33007','Spain','(98) 598 76 54'),
('7','Pavlova, Ltd.','Ian Devling','"74 Rose St.Moonie Ponds"','Melbourne','3058','Australia','(03) 444-2343'),
('8','Specialty Biscuits, Ltd.','Peter Wilson','29 King''s Way','Manchester','M14 GSD','UK','(161) 555-4448'),
('11','Heli Süßwaren GmbH & Co. KG','Petra Winkler','Tiergartenstraße 5','Berlin','10785','Germany','(010) 9984510'),
('13','Nord-Ost-Fisch Handelsgesellschaft mbH','Sven Petersen','Frahmredder 112a','Cuxhaven','27478','Germany','(04721) 8713'),
('14','Formaggi Fortini s.r.l.','Elio Rossi','Viale Dante, 75','Ravenna','48100','Italy','(0544) 60323'),
('15','Norske Meierier','Beate Vileid','Hatlevegen 5','Sandvika','1320','Norway','(0)2-953010'),
('17','Svensk Sjöföda AB','Michael Björn','Brovallavägen 231','Stockholm','S-123 45','Sweden','08-123 45 67'),
('18','Aux joyeux ecclésiastiques','Guylène Nodier','203, Rue des Francs-Bourgeois','Paris','75004','France','(1) 03.83.00.68'),
('19','New England Seafood Cannery','Robb Merchant','"Order Processing Dept.2100 Paul Revere Blvd."','Boston','02134','USA','(617) 555-3267'),
('20','Leka Trading','Chandra Leka','471 Serangoon Loop, Suite #402','Singapore','0512','Singapore','555-8787'),
('24','G''day, Mate','Wendy Mackenzie','170 Prince Edward Parade Hunter''s Hill','Sydney','2042','Australia','(02) 555-5914'),
('25','Ma Maison','Jean-Guy Lauzon','2960 Rue St. Laurent','Montréal','H1J 1C3','Canada','(514) 555-9022'),
('26','Pasta Buttini s.r.l.','Giovanni Giudici','Via dei Gelsomini, 153','Salerno','84100','Italy','(089) 6547665'),
('28','Gai pâturage','Eliane Noz','Bat. B 3, rue des Alpes','Annecy','74000','France','38.76.98.06');


INSERT INTO SHIPPERS(CompanyName,Phone) VALUES
('Speedy Express','(503) 555-9831'),
('United Package','(503) 555-3199'),
('Federal Shipping','(503) 555-9931');

INSERT INTO Products VALUES
("7","Uncle Bob's Organic Dried Pears",3,7,"12 - 1 lb pkgs.","30.00","22.50","0"),
("11","Queso Cabrales",5,4,"1 kg pkg.","21.00","16.00","0"),
("17","Alice Mutton",7,6,"20 - 1 kg tins","39.00","20.70","1"),
("19","Teatime Chocolate Biscuits",8,3,"10 boxes x 12 pieces","9.20","4.50","0"),
("26","Gumbär Gummibärchen",11,3,"100 - 250 g bags","31.23","22.80","0"),
("30","Nord-Ost Matjeshering",13,8,"10 - 200 g glasses","25.89","12.20","0"),
("33","Geitost",15,4,"500 g","2.00","2.01","0"),
("36","Inlagd Sill",17,8,"24 - 250 g  jars","19.00","18.51","0"),
("38","Côte de Blaye",18,1,"12 - 75 cl bottles","263.00","263.01","0"),
("40","Boston Crab Meat",19,8,"24 - 4 oz tins","18.40","17.91","0"),
("42","Singaporean Hokkien Fried Mee",20,5,"32 - 1 kg pkgs.","14.00","13.51","1"),
("53","Perth Pasties",24,6,"48 pieces","32.80","32.31","1"),
("54","Tourtière",25,6,"16 pies","7.45","6.96","0"),
("55","Pâté chinois",25,6,"24 boxes x 2 pies","24.00","23.51","0"),
("56","Gnocchi di nonna Alice",26,5,"24 - 250 g pkgs.","38.00","37.51","0"),
("59","Raclette Courdavault",28,4,"5 kg pkg.","55.00","54.51","0"),
("63","Vegie-spread",7,2,"15 - 625 g jars","43.90","43.41","0"),
("68","Scottish Longbreads",8,3,"10 boxes x 8 pieces","12.50","12.01","0"),
("69","Gudbrandsdalsost",15,4,"10 kg pkg.","36.00","35.51","0"),
("72","Mozzarella di Giovanni",14,4,"24 - 200 g pkgs.","34.00","34.31","0");

INSERT INTO Orders VALUES
('10248','WILMK','5','2016-5-25','2016-6-4','3','44.84','Belgium'),
('10254','CHOPS','5','2016-6-1',NULL,'1','0.75','Finland'),
('10255','RICSU','9','2016-5-24',NULL,'3','65.48','Italy'),
('10269','WHITC','5','2016-6-18',NULL,'3','74.60','Austria'),
('10271','SPLIR','6','2016-7-9',NULL,'1','29.59','Germany'),
('10283','LILAS','3','2016-7-2',NULL,'1','33.05','Brazil'),
('10329','SPLIR','4','2016-9-1',NULL,'1','40.42','Germany'),
('10330','LILAS','3','2016-9-6',NULL,'2','25.19','USA'),
('10331','BONAP','9','2016-8-30',NULL,'2','3.04','UK'),
('10607','SAVEA','5','2016-6-2',NULL,'2','36.71','Germany'),
('11028','KOENE','2','2016-2-27',NULL,'3','146.06','Austria'),
('11029','CHOPS','4','2016-3-4',NULL,'3','12.76','Brazil'),
('11032','WHITC','2','2016-2-28',NULL,'3','3.67','Sweden'),
('11033','RICSU','7','2016-2-28',NULL,'1','55.28','France');

INSERT INTO OrderDetails VALUES
('10248','11','12','0.00'),
('10248','42','10','0.00'),
('10248','72','5','0.00'),
('10254','55','21','0.00'),
('10255','36','25','0.00'),
('10255','59','30','0.00'),
('10329','19','10','5.00'),
('10329','30','8','5.00'),
('10329','38','20','5.00'),
('10329','56','12','5.00'),
('10330','26','50','15.00'),
('10330','72','25','15.00'),
('10331','54','15','0.00'),
('10607','7','45','0.00'),
('10607','17','100','0.00'),
('10607','33','14','0.00'),
('10607','40','42','0.00'),
('10607','72','12','0.00'),
('11028','55','35','0.00'),
('11028','59','24','0.00'),
('11029','56','20','0.00'),
('11029','63','12','0.00'),
('11032','36','35','0.00'),
('11032','38','25','0.00'),
('11032','59','30','0.00'),
('11033','53','70','10.00'),
('11033','69','36','10.00');