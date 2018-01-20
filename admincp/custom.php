<?php
require'../inc/conf.php';#conect to DB->cms
$get_page_id  =  intval($_GET['id']);

#=================================edit pages==============================# 

#-------check  fileds of form and change then send The data to DB-------#

if( isset($_POST['save']) && $_POST['save']=='changes' ){
	
    $pa_name     = strip_tags($_POST['pa_name']); 
    $pa_con      = addslashes($_POST['pa_con']); 
    $pa_comm_act = $_POST['pa_comm_act']; 
    $pa_count    = $_POST['pa_count'];        
    $pa_act      = $_POST['pa_act']; 
    $pa_id       = $_POST['pa_id']; 
  
  $edit_page=mysqli_query($cms,"UPDATE custom_pages SET
  p_name='$pa_name',
  p_con='$pa_con',
  p_comm_act='$pa_comm_act',
  p_count='$pa_count',
  p_act='$pa_act' 
  p_id ='$pa_id' 
  where p_id='$get_page_id'") or die(mysqli_error($cms));

    if(isset($edit_page)){
    die('
    تم التعديل بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');
 }
}
#-------------------------------------------------------------------#
if(isset($_REQUEST['edit']) && $_REQUEST['edit']=='page'	 ) {
$get_page_id  =  intval($_GET['id']);
$data         =  mysqli_query($cms,"SELECT * FROM custom_pages WHERE p_id = $get_page_id");
$data_obj     =  mysqli_fetch_object($data);
echo' 
<link rel="stylesheet" type="text/css" href="thems/style.css" />
<form action="?page=custom" method="post">
<table width="100%">
<tr><td class="head_page" colspan="2">تعديل الصفحة</td></tr>

<tr class="style1">
<td>اسم الصفحة:</td>	
<td><input type="text" size="30" name="pa_name" class="fields" value="'.$data_obj->p_name.'" /></td>
</tr>

<tr class="style1">
<td>محتوى الصفحة:</td>	
<td><textarea name="pa_con" rows="15" cols="110" class="fields" >'.$data_obj->p_con.'</textarea></td>
</tr>

<tr class="style1">
<td>حالة الصفحة:</td>	 
<td>
<select name="pa_act" class="fields" style="background-color:#FFF">';

if($data_obj->p_act=="yes") {
	echo'
    <option value="yes">تفعيل الصفحة</option>
    <option value="no">الغاء تفعيل الصفحة</option>
';
	}
else {
	echo'
	 <option value="no">الغاء تفعيل الصفحة</option>
    <option value="yes">تفعيل الصفحة</option>
';
	}
	
echo'	
</td>
</tr>
</select>
<tr class="style1">
<td>حالة التعليقات:</td>	
<td>
<select name="pa_comm_act" class="fields" style="background-color:#FFF">';

if($data_obj->p_comm_act=="yes") {
	echo'
    <option value="yes">تفعيل التعليقات</option>
    <option value="no">الغاء تفعيل التعليقات</option>
';
	}
else {
	echo'
	 <option value="no">الغاء تفعيل التعليقات</option>
    <option value="yes">تفعيل التعليقات</option>
';
	}

echo'
</td>
</tr>
</select>
<tr>
<td align="center" colspan="3"  >
    <input type="submit" value="تعديل الصفحة" class="submit" />
    <input type="hidden" name="save" value="changes" />
    <input type="hidden" name="pa_count" value="'.$data_obj->p_count.'" />   
    <input type="hidden" name="pa_id" value="'.$get_page_id.'" />    
</td>
</tr>
</table>
</form>
';
}
#=========================================================================#





#================================add_pages===============================#

#------------check  fileds of form and send The data to DB-----------#

if( isset($_POST['add']) && $_POST['add']=='page' ){
	
    $pa_name     = strip_tags($_POST['pa_name']); 
    $pa_con      = addslashes($_POST['pa_con']); 
    $pa_comm_act = $_POST['pa_comm_act']; 
    $pa_count    = $_POST['pa_count'];        
    $pa_act      = $_POST['pa_act']; 
  
  $add_page=mysqli_query($cms,"INSERT INTO custom_pages VALUES (NULL,'$pa_name','$pa_con','$pa_comm_act','$pa_count','$pa_act')") or die(mysqli_error($cms));

    if(isset($add_page)){
    die('
    تم إنشاء الصفحة بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');
 }
}
#-------------------------form of add pages-------------------------#
echo'<center><i><strong><a href="?page=custom&add_page=add">إضافة صفحة</a></strong></i></center>';
if(isset($_REQUEST['add_page']) && $_REQUEST['add_page']=='add'	 ) {
echo' 
<link rel="stylesheet" type="text/css" href="thems/style.css" />
<form action="?page=custom" method="post">
<table width="100%">
<tr><td class="head_page" colspan="2">إضافة الصفحات</td></tr>

<tr class="style1">
<td>اسم الصفحة:</td>	
<td><input type="text" size="30" name="pa_name" class="fields" /></td>
</tr>

<tr class="style1">
<td>محتوى الصفحة:</td>	
<td><textarea name="pa_con" rows="15" cols="110" class="fields"></textarea></td>
</tr>

<tr class="style1">
<td>حالة الصفحة:</td>	 
<td>
<select name="pa_act" class="fields" style="background-color:#FFF">
    <option value="yes">مفعل</option>
    <option value="no">غير مفعل</option>
</select>
</td>
</tr>

<tr class="style1">
<td>حالة التعليقات:</td>	
<td>
<select name="pa_comm_act" class="fields" style="background-color:#FFF">
    <option value="yes">مفعل</option>
    <option value="no">غير مفعل</option>
</select>
</td>
</tr>

<tr>
<td align="center" colspan="3"  >
    <input type="submit" value="انشاء الصفحة" class="submit" />
    <input type="hidden" name="add" value="page" />
    <input type="hidden" name="pa_count" value="0" />    
</td>
</tr>
</table>
</form>
';}
#=========================================================================#


#=======================show data on the admin cp=========================#
echo'
<table width="100%">
<tr><td class="head_page" colspan="4">الصفحات الموجودة</td></tr>
<tr>
<td width="20%">إسم الصفحة</td>
<td width="25%">رابط الصفحة</td>
<td width="10%">الزيارات</td>
<td width="45%">الخيارات</td>
</tr>
';

$show         =  mysqli_query($cms,"SELECT * FROM custom_pages order by p_id asc");
while($show_rows=mysqli_fetch_object($show)) {
echo'
<tr>
<td width="20%">'.$show_rows->p_name.'</td>

<td width="25%"><a href="../page.php?page_id='.$show_rows->p_id.'">مشاهدة الصفحة</a></td>

<td width="10%">'.$show_rows->p_count.'</td>

<td width="45%">
	<a href="?page=custom&edit=page&id='.$show_rows->p_id.'">تعديل</a> -
	<a href="?page=custom&del=delete&id='.$show_rows->p_id.'">حذف</a> -
	';


	if($show_rows->p_act=="no") {
	echo'
	<a href="?page=custom&pa_act=yes&id='.$show_rows->p_id.'">تفعيل الصفحة</a> -';
	}
	else {
	echo'
	<a href="?page=custom&pa_act=no&id='.$show_rows->p_id.'">الغاء تفعيل الصفحة</a> -';
}
	

	if($show_rows->p_comm_act=="no") {
	echo'
	<a href="?page=custom&pa_comm_act=yes&id='.$show_rows->p_id.'">تفعيل التعليقات</a> 
    </td>
	</tr>';
	}
	else {
	echo'
	<a href="?page=custom&pa_comm_act=no&id='.$show_rows->p_id.'">الغاء تفعيل التعليقات</a> 
    </td>
	</tr>';
		}
}
echo '</table>';
#========================================================================#

#========== do the options (edit-act or unact >>>page-comments) ===========#

//---------------act or un act page-----------------//
if(isset($_REQUEST['pa_act'])){
if($_REQUEST['pa_act']=='yes' ) {
	 	$act_page=mysqli_query($cms," UPDATE custom_pages SET p_act='yes' WHERE p_id=$get_page_id");
    if(isset($act_page)){
    die('
    تم تنشيط الصفحة بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');
 }
}

	elseif($_REQUEST['pa_act']=='no') {
	$unact_page=mysqli_query($cms," UPDATE custom_pages SET p_act='no' WHERE p_id=$get_page_id");
	 if(isset($unact_page)){
    die('
    تم الغاء تنشيط الصفحة بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');
 }
	}
}

//---------------act or un act comments-----------------//
elseif(isset($_REQUEST['pa_comm_act'])){
if($_REQUEST['pa_comm_act']=='yes' ) {
	 	$act_comm=mysqli_query($cms," UPDATE custom_pages SET p_comm_act='yes' WHERE p_id=$get_page_id");
    if(isset($act_comm)){
    die('
    تم تنشيط التعليقات بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');
 }
}

	elseif($_REQUEST['pa_comm_act']=='no') {
	$unact_comm=mysqli_query($cms," UPDATE custom_pages SET p_comm_act='no' WHERE p_id=$get_page_id");
	 if(isset($unact_comm)){
    die('
    تم الغاء تنشيط التعليقات بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');
 }
	}
	}
//---------------------Delete pages-----------------------//	
elseif(isset($_REQUEST['del']) && $_REQUEST['del']=='delete' )
{
$del=mysqli_query($cms,"DELETE FROM custom_pages WHERE p_id=$get_page_id ");
    if(isset($del)){
    die('
    تم الحذف بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=custom"/>
    ');

}
	} 

#=========================================================================#




?>
