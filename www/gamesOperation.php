<?php
require_once("function.php");

function getGames()
{
    $SQLStr=' SELECT game.*,teamHome.name teamHomeName,teamGuest.name teamGuestName
              FROM (game INNER JOIN team teamHome ON teamHome=teamHome.teamID)
                    INNER JOIN team  teamGuest ON teamGuest=teamGuest.teamID
                    ORDER BY dateGame DESC';
    return getArrayObjects($SQLStr);
}

function getGame($id)
{
    require_once("connect.php");
    $SQLStr='SELECT * FROM game WHERE gameID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die('Error in Query');
    $val=mysqli_fetch_assoc($conn,$SQLRes);
    return $val;
}


function deleteGame($id)
{
    $SQLStr='DELETE FROM game WHERE gameID="'.$id.'"';
    $SQLRes=mysql_query($SQLStr) or die('Error in Query');
    require("connect.php");
    header("Location: index.php?activePage=games");
}


if($_REQUEST['func']=='delete')
    deleteGame($_REQUEST['id']);


?>