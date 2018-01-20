<?php
require_once 'conf.php';
#***********************************************************************#
#   *R = right , L = left , U = up_center , D = down_center             #
#   *blocks->id,name,con,dir,ord,act                                    #
#   *while($blocks=mysqli_fetch_object($sql_sel){}  this is the right   #
#***********************************************************************#
$sql_sel=mysqli_query($cms,"SELECT * FROM blocks WHERE dir='U' ORDER BY ord ASC") or die("The SQL ERROR");  
while($blocks=mysqli_fetch_object($sql_sel)){ 
    if($blocks->act=="yes"){
    echo'
<div class="hmenu">'.$blocks->name.'</div>
<div class="cmenu">'.stripslashes($blocks->con).'</div><br />
';
}
}

?>