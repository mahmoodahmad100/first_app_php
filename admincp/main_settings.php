<?php 
require'../inc/conf.php';#conect to DB->cms
#main_settings ----> site_name,site_url,site_mail,site_desc,site_tags,site_open_or_close,site_msg_open_or_close,admin_notes,header_act,header_con,footer_act,footer_con,copyrights 
$mysql_sel=mysqli_query($cms,"SELECT * FROM main_settings");
$mysql_sel_arr=mysqli_fetch_array($mysql_sel) ;


//-------------this check  fileds of form and send The data to DB----------------//
if(isset($_POST['save']) && $_POST['save']=='changes'){
    $s_name=strip_tags($_POST['site_name']);
    $s_url=strip_tags($_POST['site_url']);
    $s_mail=strip_tags($_POST['site_mail']);
    $s_desc=strip_tags($_POST['site_desc']);
    $s_tags=strip_tags($_POST['site_tags']); 
    $s_open_or_close=$_POST['site_open_or_close'];
    $s_msg_open_or_close_name=addslashes($_POST['site_msg_open_or_close']); 
    $h_act=$_POST['h_act'];
    $h_con=addslashes($_POST['h_con']);
    $f_act=$_POST['f_act'];
    $f_con=addslashes($_POST['f_con']);
    $copyR=addslashes($_POST['copyR']);

  $update=mysqli_query($cms,"UPDATE main_settings SET 
  site_name='$s_name',
  site_url='$s_url',
  site_mail='$s_mail',
  site_desc='$s_desc',
  site_tags='$s_tags',
  site_open_or_close='$s_open_or_close',
  site_msg_open_or_close='$s_msg_open_or_close_name',
  header_act='$h_act',
  header_con='$h_con',
  footer_act='$f_act',
  footer_con='$f_con',
  copyrights='$copyR';
  ");
if(isset($update)){
    die('
    تم الإرسال بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=main_settings"/>        
    ');
} 
}
//-----------------------------------------------------------------------------------//
//---------------------------this code to show the forms-----------------------------//
echo' 
<link rel="stylesheet" type="text/css" href="thems/style.css" />
<form action="?page=main_settings" method="post">
<table width="100%">
<tr><td class="head_page" colspan="2">الإعدادات العامة للموقع</td></tr>

<tr class="style1">
<td>اسم الموقع:</td>	
<td><input type="text" size="30" name="site_name"  value="'.$mysql_sel_arr['site_name'].'"  class="fields" /></td>
</tr>

<tr class="style2">
<td>عنوان الموقع:</td>	
<td><input type="text" size="30" name="site_url" value="'.$mysql_sel_arr['site_url'].'"  class="fields" /></td>
</tr>

<tr class="style1">	
<td>بريد الموقع:</td>	
<td><input type="text" size="30" name="site_mail" value="'.$mysql_sel_arr['site_mail'].'" class="fields" /></td>
</tr>

<tr class="style2">
<td>وصف الموقع:</td>	
<td><textarea name="site_desc" rows="6" cols="30" class="fields">'.$mysql_sel_arr['site_desc'].'</textarea></td>
</tr>

<tr class="style1">
<td>الكلمات الدليلية:</td>	
<td><textarea name="site_tags" rows="6" cols="30" class="fields">'.$mysql_sel_arr['site_tags'].'</textarea></td>
</tr>

<tr class="style2">
<td>حالة الموقع:</td>	
<td>
<select name="site_open_or_close" class="fields" style="background-color:#FFF" >
' ;
//this code to organize content of <select> 
if($mysql_sel_arr['site_open_or_close']==1)
{
echo'
<option value="1">مفتوح</option>
<option value="2">مغلق</option>
';
}
else {
echo'
<option value="2">مغلق</option>
<option value="1">مفتوح</option>
';
}

echo'
</select>
</td>
</tr>

<tr class="style1">
<td>رسالة غلق\فتح الموقع:</td>	
<td><textarea name="site_msg_open_or_close" rows="6" cols="30" class="fields">'.stripslashes($mysql_sel_arr['site_msg_open_or_close']).'</textarea></td>
</tr>

<tr><td class="head_page" colspan="2" >رأس وتذييل الصفحة</td></tr>	
<tr>
<td>رأس الصفحة</td>
<td><select name="h_act" class="fields" style="background-color:#FFF" >
';
//this code to organize content of <select>
if($mysql_sel_arr['header_act']=='yes')
{
echo'
<option value="yes">مفعل</option>
<option value="no">غير مفعل</option>

';
}
else {
echo'
<option value="no">غير مفعل</option>
<option value="yes">مفعل</option>
';
}
echo'
</select></td></tr>

<tr>
<td>محتوى رأس الصفحة</td>
<td><textarea name="h_con" rows="6" cols="30" class="fields">'.stripslashes($mysql_sel_arr['header_con']).'</textarea></td>
</tr>

<tr>
<td>أسفل الصفحة</td>
<td><select name="f_act" class="fields" style="background-color:#FFF" >
';
//this code to organize content of <select>
if($mysql_sel_arr['footer_act']=='yes')
{
echo'
<option value="yes">مفعل</option>
<option value="no">غير مفعل</option>

';
}
else {
echo'
<option value="no">غير مفعل</option>
<option value="yes">مفعل</option>
';
}
echo'
</select></td></tr>

<tr>
<td>محتوى أسفل الصفحة</td>
<td><textarea name="f_con" rows="6" cols="30" class="fields">'.stripslashes($mysql_sel_arr['footer_con']).'</textarea></td>
</tr>

<tr>
<td>الحقوق</td>
<td><textarea name="copyR" rows="6" cols="30" class="fields">'.stripslashes($mysql_sel_arr['copyrights']).'</textarea></td>
</tr>

<tr>
<td align="center" colspan="3"  >
<input type="submit" value="حفظ" class="submit" />
<input type="hidden" name="save" value="changes" /> 	  
</td>
</tr>
	
</table>
</form>
';
//----------------------------^|this code to show the forms|^--------------------------------//
mysqli_close($cms);
?> 