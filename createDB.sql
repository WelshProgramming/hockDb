
-- divisions
CREATE TABLE division(
divisionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
divisionName varchar(30) NOT NULL,
amountBest int NOT NULL DEFAULT 2,
conference char(1) CHECK (conference IN ('w','e')));


INSERT INTO division VALUES
(NULL, 'Metropolitan',3,'e'),
(NULL,'Atlantic',3,'e'),
(NULL,'Central',3,'e'),
(NULL,'Pacific',3,'e');

-- position
CREATE TABLE `position`(
positionID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
`position` VARCHAR(30) NOT NULL
);

INSERT INTO `position` VALUES
(NULL,'Right Wing'),
(NULL, 'Left Wing'),
(NULL,'Defence');


-- teams
CREATE TABLE team(
teamID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
name varchar(50) NOT NULL,
city varchar(30) NOT NULL,
arena varchar(50),
generalManager varchar(30),
coach varchar(30),
yearFounded int,
website varchar(100),
divisionID int,
FOREIGN KEY (divisionID) REFERENCES division(divisionID));



INSERT INTO team VALUES
(NULL,'New York Rangers','New York','Madison Square Garden','Jeff Gorton','Alain Vigneault',1926,'www.nhl.com/rangers',1),
(NULL,'New York Islanders','New York','Barclays Center','Garth Snow','Jack Capuano',1972,'www.nhl.com/islanders',1);




-- players
CREATE TABLE player(
playerID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
firstName varchar(30),
lastName varchar(30),
birthDate date,
height float,
weight float,
country varchar(30),
shoots char(1),
 CHECK (shoots IN ('l','r','b')),
positionID int NOT NULL,
FOREIGN KEY (positionID) REFERENCES `position`(positionID));

INSERT INTO player VALUES
(1,'Jesper','Fast','1991-12-2',183,84,'Sweden','r',1),
(2,'Jonathan','Miller','1993-03-14',185,91,'USA','l',2),
(3,'Kevin','Klein','1984-12-13',185,91,'Canada','r',3),


-- contracts
CREATE TABLE contracts
(teamID int NOT NULL,
playerID int NOT NULL,
dateStart date,
dateEnd date,
salary decimal(10,3),
number int,
FOREIGN KEY (teamID) REFERENCES team(teamID),
FOREIGN KEY (playerID) REFERENCES player(playerID)
);

INSERT INTO contracts VALUES
(1,1,'2012-05-29',NULL,900000,19),
(1,2,'2013-02-07',NULL,NULL,10),
(1,3,'2014-01-22',NULL,NULL,8);


CREATE TABLE typeGame (
typeGameID int AUTO_INCREMENT PRIMARY KEY,
typeName varchar(30)
);


CREATE TABLE game
(
gameID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
teamHome int NOT NULL,
teamGuest int NOT NULL,
dateGame datetime,
place varchar(30),
goal1 int DEFAULT 0,
goal2 int DEFAULT 0,
typeGameID int,
FOREIGN KEY (teamHome) REFERENCES team(teamID),
FOREIGN KEY (teamGuest) REFERENCES team(teamID),
FOREIGN KEY (typeGameID) REFERENCES typeGame(typeGameID)
);

INSERT INTO game VALUES
(1,1,2,'2016-10-14 19:00',NULL,5,3,NULL)

CREATE TABLE goals
(gameID int NOT NULL,
 numberPlayer int,
 timeGoal time,
 isHomePlayer bool,
 isGoodGoal bool,
 isPenalty bool,
 FOREIGN KEY (gameID) REFERENCES game(gameID)
);

CREATE TABLE onGame
(gameID int NOT NULL,
 numberPlayer int,
 timeStart time,
 timeEnd time,
 isHomePlayer bool,
 FOREIGN KEY (gameID) REFERENCES game(gameID)
);

CREATE TABLE fouls
(gameID int NOT NULL,
 numberPlayer int,
 timeStart time,
 timeEnd time,
 isHomePlayer bool,
 `comment` varchar(50),
 FOREIGN KEY (gameID) REFERENCES game(gameID)
);
