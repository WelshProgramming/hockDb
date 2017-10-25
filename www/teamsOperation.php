<?php
require_once("function.php");


function getTotalTeam($id)
{
    require "connect.php";
    $SQLStr='SELECT COUNT(*) as CountGame FROM game WHERE (teamHome='.$id.') OR (teamGuest='.$id.')';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery.$SQLStr);
    $val=mysqli_fetch_assoc($SQLRes);
    $SQLStr='SELECT CountWin FROM win WHERE teamID='.$id;

    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery.$SQLStr);
    $val2=mysqli_fetch_assoc($SQLRes);

    $val['CountWin']=$val2['CountWin'];
    return $val;
}

function getTeam($id)
{
    require "connect.php";
    $SQLStr='SELECT * FROM team WHERE teamID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery);
    $val=mysqli_fetch_assoc($SQLRes);
    return $val;
}


function deleteTeam($id)
{
    require "connect.php";
    $SQLStr='DELETE FROM team WHERE teamID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery.$SQLStr);
    header("Location: index.php?activePage=divisions");
}


function updateTeam()
{
    require "connect.php";
    $SQLStr='UPDATE team SET name="'.$_REQUEST['name'].'", city="'.$_REQUEST['city'].'",
            arena="'.$_REQUEST['arena'].'",generalManager="'.$_REQUEST['generalManager'].'",coach="'.$_REQUEST['coach'].'",
            yearFounded="'.$_REQUEST['yearFounded'].'",website="'.$_REQUEST['website'].'",divisionID="'.$_REQUEST['divisionID'].'"
            WHERE teamID="'.$_REQUEST['teamID'].'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die('Error'.$SQLStr);

    require("connect.php");
    header("Location: index.php?activePage=divisions&func=view&id=".$_REQUEST['divisionID']);
}

function createTeam()
{
    require("connect.php");
    $strSQL='INSERT INTO team
                  VALUES(NULL,"'.$_REQUEST['name'].'","'.$_REQUEST['city'].'",
                        "'.$_REQUEST['arena'].'","'.$_REQUEST['generalManager'].'","'.$_REQUEST['coach'].'",
                        "'.$_REQUEST['yearFounded'].'","'.$_REQUEST['website'].'",'.$_REQUEST['divisionID'].')';
    $SQLRes=mysqli_query($conn,$strSQL) or die('ErrorQuery'.$strSQL);
    header("Location: index.php?activePage=divisions&func=view&id=".$_REQUEST['divisionID']);
}

if($_REQUEST['func']=='delete')
    deleteTeam($_REQUEST['id']);
if($_REQUEST['func']=='update')
    updateTeam();
if($_REQUEST['func']=='create')
    createTeam();
?>