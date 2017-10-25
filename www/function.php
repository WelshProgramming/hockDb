<?php

function getArrayObjects($SQLStr)
{
    require ("connect.php");
    $SQLRes=mysqli_query($conn,$SQLStr) or die('Error in Query'. $SQLStr);
    $i=0;
    while($val=mysqli_fetch_assoc($SQLRes))
    {
        $MasObjects[$i]=$val;
        $i++;
    }
    return $MasObjects;
}


function getCategories()
{

    $SQLStr='SELECT *
              FROM Categories
              ORDER BY CategoryName';
    return getArrayObjects($SQLStr);
}

?>