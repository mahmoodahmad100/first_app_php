<?php require'inc/header.html';?>

<?php 

$get_id        =   intval($_GET['page_id']); 

$custom_page   =   mysqli_query($cms,"SELECT * FROM custom_pages WHERE p_id = $get_id ")or die("connect error");

$row           =   mysqli_fetch_object($custom_page);

?>

<!--show [custom pages] in main page--> 

<td valign="top" width="34%"> 

<?php
#* validate the correct coustom page and send massage if the wrong page or if page validate correct will show page if it was active *#
if(!$get_id) { echo '<div class="hmenu"><strong> تم طلب صفحة خاطئة </strong></div>'; }

elseif ( mysqli_num_rows($custom_page) < 1 ) { echo '<div class="hmenu"><strong> رقم الصفحة '.$get_id.' غير موجود في قاعدة البيانات </strong></div>'; }

elseif(isset($get_id)) {

$upd_count     =   mysqli_query($cms," UPDATE custom_pages SET p_count = p_count + 1  WHERE p_id = $get_id ");	

if($row->p_act=='yes') {
	
echo'<div class="hmenu"> "'.$row->p_name .'" </div>';

echo'<div class="cmenu"> "'.$row->p_con .'" </div> <br> ';

#* validate of form add comments*#
if(isset($_POST['add']) && $_POST['add'] = 'comm') {
	
$cupage_name  =  strip_tags($_POST['cupage_name']);	
$cupage_mail  =  strip_tags($_POST['cupage_mail']); 
$cupage_comm  =  addslashes($_POST['cupage_comm']);	
$cupage_ip    =  $_POST['cupage_ip'];
$cupage_date  =  $_POST['cupage_date'];
$cupage_act   =  $_POST['cupage_act'];	
$p_id	        =  $_POST['p_id'];
	
$add_cupage_comments=mysqli_query($cms,"INSERT INTO custom_page_comments VALUES
 (
 NULL,
 '$cupage_name',
 '$cupage_mail',
 '$cupage_comm',
 '$cupage_ip',
 '$cupage_date',
 '$cupage_act',
 '$p_id'
 ) 
 ") or die(mysqli_error($cms));

    if(isset($add_cupage_comments)){
    die('
    تم إرسال التعليق بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url='page.php?page_id=$get_id'"/>
    ');
 }

}

#*form add comments*#
echo'<table width="34%">';
echo'<tr><td width="34%">';
echo'<fieldset>';
echo'<legend>إضافة تعليق</legend>';
echo'<form action="page.php?page_id='.$get_id.'" method="post">';
echo'<label> إسم المعلق: </label> <label> <input type="text" name="cupage_name"/> </label> <br>';
echo'<label> البريد الإلكتروني: </label> <label> <input type="text" name="cupage_mail"/> </label> <br>';
echo'<label> التعليق: </label> <label> <textarea name="cupage_comm" rows="15" cols="110"></textarea> </label> <br>';
echo'<label dir="center"><input type="submit" value="إرسال التعليق" class="submit" /></label>';
echo'<input type="hidden" name="add" value="comm" />';
echo'<input type="hidden" name="cupage_ip" value="'.$_SERVER['REMOTE_ADDR'].'" />';
echo'<input type="hidden" name="cupage_date" value="'.date("d / m / y - h : i : s ").'" />';
echo'<input type="hidden" name="cupage_act" value="no" />';
echo'<input type="hidden" name="p_id" value="'.$get_id.'" />';
echo'</form>';
echo'</fieldset>';
echo'</td></tr>';
echo'</table>';

}

else { echo '<div class="hmenu"><strong> هذه الصفحة غير متاحة حالياً من فضلك  راسل إدارة الموقع </strong></div>'; }

}


?>         



</td>

<!--show [custom pages] in main page//-->


<?php include'../cms/inc/footer.html';?> <!--footer-->
