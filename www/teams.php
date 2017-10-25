<?php
require_once ("teamsOperation.php");

function showForm($type,$id)
{
    if($type=='update')
    {
        $myEl=getTeam($id);
        $action='teamsOperation.php?func=update';
        $head='Update team '.$myEl['name'];
    }
    else
    {
        $action='teamsOperation.php?func=create';
        $head='Add team';
        $orders='';
    }

    require_once("divisionsOperation.php");
    $textError='';
//divisionID int
    $str='<h2>'.$head.'</h2>
            <form action="'.$action.'" method="post">'.$textError.
        '  <input type="hidden" value="'.$id.'" name="teamID">
            <table>
                <tr><th>Name:</th><td><input type="text" name="name" required value="'.$myEl['name'].'"></td></tr>
                <tr><th>City:</th><td><input type="text" name="city" required value="'.$myEl['city'].'"></td></tr>
                <tr><th>Arena:</th><td><input type="text" name="arena" required value="'.$myEl['arena'].'"></td></tr>
                <tr><th>General manager:</th><td><input type="text" name="generalManager" required value="'.$myEl['generalManager'].'"></td></tr>
                <tr><th>Coach:</th><td><input type="text" name="coach" required value="'.$myEl['coach'].'"></td></tr>

                <tr><th>Year founded:</th><td><input type="text" name="yearFounded" required value="'.$myEl['yearFounded'].'"></td></tr>
                <tr><th>website:</th><td><input type="text" name="website" value="'.$myEl['website'].'"></td></tr>
                <tr><th>Division:</th><td>'.getListDivisions($myEl['divisionID']).'</td></tr>
            </table>
            <input type="submit" value="submit"> <input type="reset" value="reset">
            </form>
            ';
    return $str;
}


if(isset($_REQUEST['func']))
    $func=$_REQUEST['func'];
else
    $func='showAll';

if($func=='view')
{
    require_once("players.php");
    echo showListPlayer();

}
if($func=='updateForm')
    echo showForm('update',$_REQUEST['id']);
if($func=='createForm')
        echo showForm('create',-1);


?>