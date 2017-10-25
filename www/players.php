<?php
require_once ("playersOperation.php");

function getListPosition($idSelected=-1)
{
    $SQLStr='SELECT * FROM `position` ORDER BY `position`';
    $res=getArrayObjects($SQLStr);
    $str='<select name="positionID">';
    for($i=0;$i<count($res);$i++)
        if($res[$i]['positionID']==$idSelected)
            $str.='<option value="'.$res[$i]['positionID'].'" selected>'.$res[$i]['position'].'</option>';
        else
            $str.='<option value="'.$res[$i]['positionID'].'" >'.$res[$i]['position'].'</option>';
    $str.='</select>';
    return $str;
}

function showListPlayer($idTeam)
{
    $mass=getPlayers($idTeam);
    $str='<h1>List of players</h1>';
    $str.='<div><a href="index.php?activePage=players&func=createForm" class="button">Add player</a></div><br/>';
    $str.='<table id="box-table-b"><tr><th>id</th><th>Name</th><th>birthDate</th>
            <th>height</th><th>weight</th><th>country</th><th>shoots</th><th>number</th>';
    $str.='<th>action</th>';
    $str.='</tr>';

    if($mass!=false)
        for($i=0;$i<count($mass);$i++)
        {
            $val=$mass[$i];
            $str.='<tr><td>'.$val['playerID'].'</td><td>'.$val['firstName'].' '.$val['lastName'].'</td><td>'.$val['birthDate'].'</td>'.
                    '<td>'.$val['height'].'</td><td>'.$val['weight'].'</td><td>'.$val['country'].'</td><td>'.$val['shoots'].'</td><td>'.$val['number'].'</td>'.
                    '<td><a href="playersOperation.php?func=delete&id='.$val['playerID'].'">Delete</a> '.
                    '<a href="index.php?activePage=players&func=updateForm&id='.$val['playerID'].'">Update</a></td>'.
                    '</tr>';
        }
    $str.='</table>';
    return $str;
}

function showForm($type,$id)
{
    if($type=='update')
    {
        $myEl=getPlayer($id);
        $action='playersOperation.php?func=update';
        $head='Update player '.$myEl['playerID'];
    }
    else
    {
        $action='playersOperation.php?func=create';
        $head='Add player';
    }
    $textError='';
    $str='<h2>'.$head.'</h2>
            <form action="'.$action.'" method="post">'.$textError.
        '  <input type="hidden" value="'.$id.'" name="playerID">
           <input type="hidden" value="'.$myEl['teamID'].'" name="teamID">
            <table>
                <tr><th>first Name:</th><td><input type="text" name="firstName" required value="'.$myEl['firstName'].'"></td></tr>
                <tr><th>lastName:</th><td><input type="text" name="lastName" required value="'.$myEl['lastName'].'"></td></tr>
                <tr><th>birthDate:</th><td><input type="date" name="birthDate" required value="'.$myEl['birthDate'].'"></td></tr>
                <tr><th>height:</th><td><input type="text" name="height" value="'.$myEl['height'].'"></td></tr>
                <tr><th>weight:</th><td><input type="text" name="weight" value="'.$myEl['weight'].'"></td></tr>
                <tr><th>country:</th><td><input type="text" name="country" value="'.$myEl['country'].'"></td></tr>
                <tr><th>shoots:</th><td><input type="text" name="shoots" required value="'.$myEl['shoots'].'"></td></tr>
                <tr><th>number:</th><td><input type="text" name="number" required value="'.$myEl['number'].'"></td></tr>
                <tr><th>position:</th><td>'.getListPosition($myEl['position']).'</td></tr>

                <tr><th>Continue contract (years):</th><td><input type="text" name="years" required value="0"></td></tr>
            </table>
            <input type="submit" value="submit"> <input type="reset" value="reset">
            </form>
            ';
    return $str;
}


if(isset($_REQUEST['func']))
    $func=$_REQUEST['func'];
else
    $func='view';

if($func=='view')
{
    echo showListPlayer($_REQUEST['id']);

}
if($func=='updateForm')
    echo showForm('update',$_REQUEST['id']);
if($func=='createForm')
        echo showForm('create',-1);


?>