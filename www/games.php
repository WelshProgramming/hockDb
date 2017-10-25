<?php
require_once ("gamesOperation.php");
function showListGames()
{
    $mass=getGames();

    $str='<h1>List of games</h1>';
   // $str.='<div><a href="index.php?activePage=employees&func=createForm" class="button">Add employee</a></div><br/>';
    $str.='<table id="box-table-b"><tr><th>id</th><th>Team1</th><th>Team2</th>
            <th>Date</th><th>Score</th>';
    //$str.='<th></th>';
    $str.='</tr>';

    if($mass!=false)
        for($i=0;$i<count($mass);$i++)
        {
            $val=$mass[$i];
            $str.='<tr><td>'.$val['gameID'].'</td><td>'.$val['teamHomeName'].'</td><td> '.$val['teamGuestName'].'</td><td>'.$val['dateGame'].'</td>'.
                    '<td>'.$val['goal1'].':'.$val['goal2'].'</td>'.
                    //'<td><a href="employeesOperation.php?func=delete&id='.$val['EmployeeID'].'">Delete</a> '.
                    //'<a href="index.php?activePage=employees&func=updateForm&id='.$val['EmployeeID'].'">Detail</a></td>'.
                    '</tr>';
        }
    $str.='</table>';
    return $str;
}

if(isset($_REQUEST['func']))
    $func=$_REQUEST['func'];
else
    $func='showAll';

if($func=='showAll')
{
    echo showListGames();

}
/*if($func=='updateForm')
    echo showForm('update',$_REQUEST['id']);
if($func=='createForm')
        echo showForm('create',-1);*/


?>