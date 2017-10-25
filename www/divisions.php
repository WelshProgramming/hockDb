<?php
require_once ("divisionsOperation.php");
function showListDivision()
{
    $mass=getDivisions();

    $str='<h1>List of divisions</h1>';
    $str.='<div><a href="index.php?activePage=divisions&func=createForm" class="button">Add division</a></div><br/>';
    $str.='<table id="box-table-b"><tr><th>id</th><th>Division</th><th>Conference</th>
            <th>amount team for play-off</th>';
    $str.='<th>action</th>';
    $str.='</tr>';

    if($mass!=false)
        for($i=0;$i<count($mass);$i++)
        {
            $val=$mass[$i];
            if($val['conference']=='e')
                $conf='Eastern';
            else
                $conf='Western';
            $str.='<tr><td>'.$val['divisionID'].'</td><td>'.$val['divisionName'].'</td><td>'.$conf.'</td>'.
                    '<td>'.$val['amountBest'].'</td>'.
                    '<td><a href="divisionsOperation.php?func=delete&id='.$val['divisionID'].'">Delete</a> '.
                    '<a href="index.php?activePage=divisions&func=updateForm&id='.$val['divisionID'].'">Update</a> '.
                '<a href="index.php?activePage=divisions&func=view&id='.$val['divisionID'].'">Detail</a></td>'.
                    '</tr>';
        }
    $str.='</table>';
    return $str;
}

function showListTeam()
{
    $idDiv=$_REQUEST['id'];
    $division=getDivision($idDiv);
    $mass=getDivisionTeams($idDiv);

    $str='<h1>List of team for '.$division['divisionName'].' divisions</h1>';
    $str.='<p>For this division to play off go '.$division['amountBest'].' teams.</p><br/>';
    $str.='<div><a href="index.php?activePage=teams&func=createForm" class="button">Add team</a></div><br/>';
    $str.='<table id="box-table-b"><tr><th>id</th><th>Team</th><th>Games</th><th>Win</th><th>Lose</th>';
    $str.='<th>action</th>';
    $str.='</tr>';
    require_once("teamsOperation.php");
    if($mass!=false)
        for($i=0;$i<count($mass);$i++)
        {
            $val=$mass[$i];
            $teamInfo=getTotalTeam($val['teamID']);

            $str.='<tr><td>'.$val['teamID'].'</td><td>'.$val['name'].'</td><td>'.$teamInfo['CountGame'].'</td>'.
                '<td>'.$teamInfo['CountWin'].'</td><td>'.($teamInfo['CountGame']-$teamInfo['CountWin']).'</td>'.
                '<td><a href="teamsOperation.php?func=delete&id='.$val['teamID'].'">Delete</a> '.
                '<a href="index.php?activePage=teams&func=updateForm&id='.$val['teamID'].'">Update</a> '.
                '<a href="index.php?activePage=players&func=view&id='.$val['teamID'].'">Detail</a></td>'.
                '</tr>';
        }
    $str.='</table>';
    return $str;
}

function showForm($type,$id)
{
    $sel[0]='';
    $sel[1]='';
    if($type=='update')
    {
        $myEl=getDivision($id);
        $action='divisionsOperation.php?func=update';
        $head='Update division '.$myEl['divisionID'];
    //    require_once("teams.php");
//        $teams=showListTeam($id);
        if($myEl['conference']=='e')
            $sel[0]=' selected ';
        else
            $sel[1]=' selected ';
    }
    else
    {
        $action='divisionsOperation.php?func=create';
        $head='Add division';
        $teams='';
    }

    $textError='';
    $str='<h2>'.$head.'</h2>
            <form action="'.$action.'" method="post">'.$textError.
        '  <input type="hidden" value="'.$id.'" name="DivisionID_old">
            <table>
                <tr><th>Division name:</th><td><input type="text" name="divisionName" required value="'.$myEl['divisionName'].'"></td></tr>
                <tr><th>Amount best:</th><td><input type="text" name="amountBest" required value="'.$myEl['amountBest'].'"></td></tr>
                <tr><th>Conference:</th><td><select name="conference">
                                            <option value="e"'.$sel[0].'>Eastern</option>
                                            <option value="w"'.$sel[1].'>Western</option>
                                            </select></td>
               </tr>
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

if($func=='showAll')
{
    echo showListDivision();

}
if($func=='updateForm')
    echo showForm('update',$_REQUEST['id']);
if($func=='createForm')
        echo showForm('create',-1);

if($func=='view')
    echo showListTeam();
?>