<?php
require_once("function.php");

function getPlayers($idTeam)
{
    $SQLStr='SELECT player.*,`number` FROM player INNER JOIN contracts ON player.playerID=contracts.playerID
          WHERE ((CURDATE() BETWEEN dateEnd AND dateStart) OR (dateEnd is NULL)) AND teamID='.$idTeam.'
          ORDER BY number';
    return getArrayObjects($SQLStr);
}

function getPlayer($id)
{
    require "connect.php";
    $SQLStr='SELECT player.*,`number`,teamID FROM player INNER JOIN contracts ON player.playerID=contracts.playerID
          WHERE ((CURDATE() BETWEEN dateEnd AND dateStart) OR (dateEnd is NULL)) AND player.playerID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery.$SQLStr);
    $val=mysqli_fetch_assoc($SQLRes);
    return $val;
}


function deletePlayer($id)
{
    require "connect.php";
    $SQLStr='DELETE FROM player WHERE playerID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery.$SQLStr);
    require("connect.php");
    header("Location: index.php?activePage=teams");
}


function updatePlayer()
{
    require "connect.php";
    $SQLStr='UPDATE player SET firstName="'.$_REQUEST['firstName'].'", lastName="'.$_REQUEST['lastName'].'",
            birthDate="'.$_REQUEST['birthDate'].'",height="'.$_REQUEST['height'].'",weight="'.$_REQUEST['weight'].'",
            country="'.$_REQUEST['country'].'",shoots="'.$_REQUEST['shoots'].'",positionID='.$_REQUEST['positionID'].'
            WHERE playerID="'.$_REQUEST['playerID'].'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die('Error'.$SQLStr);
    if($_REQUEST['years']>0) {
        $str = 'ADDDATE(CURDATE(), INTERVAL ' . $_REQUEST['years'] . ' YEAR) ';
        $strSQL = 'INSERT INTO contracts VALUES(' . $_REQUEST['teamID'] . ',' . $_REQUEST['playerID'] . ',CURDATE(),' . $str . ',0,' . $_REQUEST['number'] . ')';
        $SQLRes = mysqli_query($conn, $strSQL) or die('ErrorQuery'.$strSQL);
    }


    header("Location: index.php?activePage=players&func=view&id=".$_REQUEST['teamID']);
}

function createPlayer()
{
    require("connect.php");
    $strSQL='INSERT INTO player
                  VALUES(NULL,"'.$_REQUEST['firstName'].'","'.$_REQUEST['lastName'].'","'.$_REQUEST['birthDate'].'",
                        "'.$_REQUEST['height'].'","'.$_REQUEST['weight'].'","'.$_REQUEST['country'].'",
                        "'.$_REQUEST['shoots'].'","'.$_REQUEST['positionID'].'")';
    $SQLRes=mysqli_query($conn,$strSQL) or die('ErrorQuery'.$strSQL);
    $id=mysqli_insert_id($conn);
    // add contracts:
    if($_REQUEST['years']>0)
        $str='ADDDATE(CURDATE(), INTERVAL '.$_REQUEST['years'].' YEAR) ';
    else
        $str='NULL';
    $strSQL='INSERT INTO contracts VALUES('.$_REQUEST['teamID'].','.$id.',CURDATE(),'.$str.',0,'.$_REQUEST['number'].')';
    $SQLRes=mysqli_query($conn,$strSQL) or die('ErrorQuery'.$strSQL);
    header("Location: index.php?activePage=players&func=view&id=".$_REQUEST['teamID']);
}

if($_REQUEST['func']=='delete')
    deletePlayer($_REQUEST['id']);
if($_REQUEST['func']=='update')
    updatePlayer();
if($_REQUEST['func']=='create')
    createPlayer();

?>