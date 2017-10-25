<h1>National Hockey League</h1>
<p>
Professional ice hockey league composed of 31 clubs: 24 in the United States and 7 in Canada. Headquartered in New York
    City, the NHL is the premier professional ice hockey league in the world, and one of the major
    professional sports leagues in the United States and Canada. 
</p>
<?php
require_once "function.php";
$mass=getArrayObjects('SELECT * FROM division');

$str='<h1>List of divisions</h1>';
$str.='<table id="box-table-b"><tr><th>Division</th><th>Conference</th>';
$str.='</tr>';

if($mass!=false)
    for($i=0;$i<count($mass);$i++)
    {
        $val=$mass[$i];
        if($val['conference']=='e')
            $conf='Eastern';
        else
            $conf='Western';
        $str.='<tr><td><a href="index.php?activePage=divisions&func=view&id='.$val['divisionID'].'">'.$val['divisionName'].'</a></td><td>'. $conf.'</td></tr>';
    }
$str.='</table>';
echo $str;
?>