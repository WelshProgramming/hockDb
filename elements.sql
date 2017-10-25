
CREATE VIEW win AS
SELECT teamID,COUNT(gameID) as CountWin 
FROM game, team
WHERE ((goal1>goal2) and (teamHome=teamID)) or
	  ((goal1<goal2) and (teamGuest=teamID)) 
GROUP BY teamID;

-- CREATE VIEW POINTS AS
-- SELECT teamID,SUM(winPoints(gameID, IF(teamHome=teamID,1,0)))
-- FROM game, team
-- WHERE (teamHome=teamID) or (teamGuest=teamID)
-- GROUP BY teamID;

--Function DDL (minimum 1): function which define by game win points
DELIMITER //
CREATE FUNCTION winPoints(idGame int, forHome bool)
  RETURNS int 
  LANGUAGE SQL
BEGIN
  DECLARE baseDifference int;
  DECLARE points int;
   
  SELECT SUM(IFF((isHomePlayer-1)*(isGoodGoal-1)=0,1,-1))INTO baseDifference 
  FROM goals
  WHERE timeGoal<='1:00:00';
  
  IF baseDifference=0 THEN
	 IF forHome=1 THEN
	    SELECT IFF(goal1>goal2,1,0) INTO points
		FROM goals;
	 ELSE
	    SELECT IFF(goal1>goal2,0,1) INTO points
		FROM goals;
	 END IF;
  ELSE
	 IF forHome=1 THEN
	    SELECT IFF(goal1>goal2,1,0) INTO points
		FROM goals;
	 ELSE
	    SELECT IFF(goal1>goal2,0,1) INTO points
		FROM goals;
 	 END IF;
 END IF;
RETURN  points;
        
END;//
DELIMITER ;


--Procedures DDL (minimum 1)
-- procedure which change players on game: find, is exist this number on game, set for him endTime and add record for new player:
DELIMITER //
CREATE PROCEDURE changePlayer(idGame int, isHome bool, numberNew int, numberOld int,timeChange time)  
  LANGUAGE SQL
BEGIN
  DECLARE countNumberOnGame int;
  DECLARE points int;
  
  SELECT COUNT(gameID) INTO countNumberOnGame
  FROM onGame
  WHERE (timeStart<=timeChange) AND ((timeChange<=timeEnd) OR (timeEnd is NULL)) AND (isHome=isHomePlayer) AND numberOld=numberPlayer;
  IF countNumberOnGame=1 THEN
	UPDATE onGame SET timeEnd=timeChange WHERE (gameID=idGame) AND (numberOld=numberPlayer)AND (		isHome=isHomePlayer);
	INSERT INTO onGame VALUES(idGame,numberNew,timeChange,NULL,isHome);
  END IF;
  END;//
 DELIMITER ; 
   
   

--Trigger DDL (minimum 1): if we add one goal in the table goals, update table game
DELIMITER //
CREATE TRIGGER addGoal 
	BEFORE INSERT ON goals FOR EACH ROW
	BEGIN
	IF ((New.isHomePlayer=1) AND (NEW.isGoodGoal=1)) OR ((New.isHomePlayer=0) AND (NEW.isGoodGoal=0)) THEN
		  UPDATE game SET goal1=goal1+1 WHERE gameID=New.gameID;
	 ELSE
          UPDATE game SET goal2=goal2+1 WHERE gameID=New.gameID;
	 END IF;
    END;
	//

DELIMITER ;