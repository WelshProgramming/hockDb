<?php
require_once("function.php");


function getDivisions()
{
    $SQLStr='SELECT * FROM division ORDER BY conference,divisionName';
    return getArrayObjects($SQLStr);
}


function getListDivisions($idSelected=-1)
{
    $SQLStr='SELECT * FROM division ORDER BY conference,divisionName';
    $res=getArrayObjects($SQLStr);
    $str='<select name="divisionID">';
    for($i=0;$i<count($res);$i++)
        if($res[$i]['divisionID']==$idSelected)
            $str.='<option value="'.$res[$i]['divisionID'].'" selected>'.$res[$i]['divisionName'].'</option>';
        else
            $str.='<option value="'.$res[$i]['divisionID'].'" >'.$res[$i]['divisionName'].'</option>';
    $str.='</select>';
    return $str;
}

function getDivisionTeams($id)
{
    $SQLStr='SELECT * FROM team WHERE divisionID="'.$id.'"';
    return getArrayObjects($SQLStr);
}

function getDivision($id)
{
    require "connect.php";
    $SQLStr='SELECT * FROM division WHERE divisionID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery);
    $val=mysqli_fetch_assoc($SQLRes);
    return $val;
}


function deleteDivision($id)
{
    require "connect.php";
    $SQLStr='DELETE FROM division WHERE divisionID="'.$id.'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die(ErrorQuery.$SQLStr);
    require("connect.php");
    header("Location: index.php?activePage=divisions");
}


function updateDivision()
{
    require "connect.php";
    $SQLStr='UPDATE division SET divisionName="'.$_REQUEST['divisionName'].'",
            amountBest="'.$_REQUEST['amountBest'].'",conference="'.$_REQUEST['conference'].'"
            WHERE divisionID="'.$_REQUEST['divisionID'].'"';
    $SQLRes=mysqli_query($conn,$SQLStr) or die('Error'.$SQLStr);

    require("connect.php");
    header("Location: index.php?activePage=divisions");
}

function createDivision()
{
    require "connect.php";
    $strSQL='INSERT INTO division
                  VALUES(NULL,"'.$_REQUEST['divisionName'].'","'.$_REQUEST['amountBest'].'",
                        "'.$_REQUEST['conference'].'")';
    $SQLRes=mysqli_query($conn,$strSQL) or die('ErrorQuery');
    header("Location: index.php?activePage=divisions");
}

if($_REQUEST['func']=='delete')
    deleteDivision($_REQUEST['id']);
if($_REQUEST['func']=='update')
    updateDivision();
if($_REQUEST['func']=='create')
    createDivision();

?>