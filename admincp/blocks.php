<?php
require'../inc/conf.php';#conect to DB->cms

#------------check  fileds of form and send The data to DB-----------#
if( isset($_POST['save']) && $_POST['save']=='block' ){
    $b_name = strip_tags($_POST['b_name']); #name->block
    $b_content = addslashes($_POST['b_content']); #content->block
    $b_dir = $_POST['b_dir']; #direction->block
    $b_order = strip_tags($_POST['b_order']); #order->block
    $b_active = $_POST['b_active']; #active_or_not->block

    if( $b_name=='' or $b_content=='' or $b_order=='' ) {
    echo '<center><strong><i>من فضلك...املأ جميع الحقول</i></strong></center>';
}else{
 #$add=mysqli_query($cms,"INSERT INTO blocks (name,con,dir,ord,act) VALUES ('$b_name','$b_content','$b_dir','$b_order','$b_active')") or die(mysqli_error($cms));
  $add=mysqli_query($cms,"INSERT INTO blocks VALUES (NULL,'$b_name','$b_content','$b_dir','$b_order','$b_active')") or die(mysqli_error($cms));

    if(isset($add)){
    die('
    تم الإرسال بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=blocks"/>
    ');
 }
}
}
#------------------------------------------------------------------#

#-----------------------request_edit-del------------------#
########################-EDIT All form-################################
if(isset($_REQUEST['block']) ) {
$get_id=intval($_GET['id']);
if($_REQUEST['block']=='edit' ) {
$query=mysqli_query($cms,"SELECT * FROM blocks where id=$get_id ");
$val_block=mysqli_fetch_object($query);
	echo'
<link rel="stylesheet" type="text/css" href="thems/style.css" />
<form action="?page=blocks" method="post">
<table width="100%" align="center">
<tr><td class="head_page" colspan="2">تعديل القائمة</td></tr>

<tr class="style1">
    <td>اسم القائمة:</td>
    <td><input type="text" size="30" name="b_name"  class="fields" value="'.$val_block->name.'" /></td>
</tr>

<tr class="style2">
    <td>محتوى القائمة:</td>
    <td><textarea name="b_content" rows="15" cols="110" class="fields">'.stripslashes($val_block->con).'</textarea></td>
</tr>

<tr class="style1">
    <td>مكان القائمة:</td>
<td>
<select name="b_dir" class="fields" style="background-color:#FFF">
';
if($val_block->dir=='R') {
	echo'
    <option value="R">يمين</option>
    <option value="L">يسار</option>
    <option value="U">اعلى المنتصف</option>
    <option value="D">اسفل المنتصف</option>
';
	}
elseif($val_block->dir=='L') {
echo'
	 <option value="L">يسار</option>
    <option value="R">يمين</option>
    <option value="U">اعلى المنتصف</option>
    <option value="D">اسفل المنتصف</option>
';
	}
elseif($val_block->dir=='U') {
echo'
    <option value="U">اعلى المنتصف</option>
    <option value="D">اسفل المنتصف</option>
    <option value="R">يمين</option>
    <option value="L">يسار</option>
';
	}
else {
	echo'
    <option value="D">اسفل المنتصف</option>
    <option value="U">اعلى المنتصف</option>
    <option value="R">يمين</option>
    <option value="L">يسار</option>
';
	}

echo'
</select>
</td>
</tr>
<tr class="style2">
    <td>ترتيب القائمة:</td>
<td>
    <input type="text" size="10" name="b_order" value="'.$val_block->ord.'"  class="fields" />
</td>
</tr>


<tr class="style1">
    <td>التفعيل</td>
<td>
<select name="b_active" class="fields" style="background-color:#FFF">
';
if($val_block->act=="yes") {
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
</select>
</td>
</tr>
<tr>
<td align="center" colspan="3"  >
    <input type="submit" value="تعديل القائمة" class="submit" />
    <input type="hidden" name="save" value="change" />
    <input type="hidden" name="id_url" value="'.$get_id.'" />
</td>
</tr>

</table>
</form>';}
	###########################edit act-unact#################
	elseif($_REQUEST['block']=='act' ) {
	 	$act=mysqli_query($cms," UPDATE blocks SET act='yes' WHERE id=$get_id");
    if(isset($act)){
    die('
    تم تنشيط القائمة بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=blocks"/>
    ');
 }
}

	elseif($_REQUEST['block']=='unact') {
	$unact=mysqli_query($cms," UPDATE blocks SET act='no' WHERE id=$get_id");
	 if(isset($unact)){
    die('
    تم الغاء التنشيط بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=blocks"/>
    ');
 }
	}

	###########################DELETE#########################
elseif($_REQUEST['block']=='del' )
{
$del=mysqli_query($cms,"DELETE FROM blocks WHERE id=$get_id ; ");
    if(isset($del)){
    die('
    تم الحذف بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=blocks"/>
    ');

}
	} 
	}
#--------------------------------------------------------#
#------------check  fileds of form and edit-send The data to DB-----------#
if( isset($_POST['save']) && $_POST['save']=='change' ){
    $b_name = strip_tags($_POST['b_name']); #name->block
    $b_content = addslashes($_POST['b_content']); #content->block
    $b_dir = $_POST['b_dir']; #direction->block
    $b_order = strip_tags($_POST['b_order']); #order->block
    $b_active = $_POST['b_active']; #active_or_not->block

    if( $b_name=='' or $b_content=='' or $b_order=='' ) {
    echo '<center><strong><i>من فضلك...املأ جميع الحقول</i></strong></center>';
}else{
  $id_val=intval($_POST['id_url']);
  $up=mysqli_query($cms,"
  UPDATE blocks SET
  name='$b_name',
  con='$b_content',
  dir='$b_dir',
  ord='$b_order',
  act='$b_active' where id='$id_val'
 ")
   or die(mysqli_error($cms));

    if(isset($up)){
    die('
    تم التعديل بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=?page=blocks"/>
    ');
 }
}
}


#-----------show the forms and add blocks--------------------#
echo'<center><i><strong><a href="?page=blocks&add_b=block">إضافة قائمة</a></strong></i></center>';
if(isset($_REQUEST['add_b']) && $_REQUEST['add_b']=='block'	 ) {
echo'
<link rel="stylesheet" type="text/css" href="thems/style.css" />
<form action="?page=blocks" method="post">
<table width="100%" align="center">
<tr><td class="head_page" colspan="2">اضافة القوائم</td></tr>

<tr class="style1">
    <td>اسم القائمة:</td>
    <td><input type="text" size="30" name="b_name"  class="fields" /></td>
</tr>

<tr class="style2">
    <td>محتوى القائمة:</td>
    <td><textarea name="b_content" rows="15" cols="110" class="fields"></textarea></td>
</tr>

<tr class="style1">
    <td>مكان القائمة:</td>
<td>
<select name="b_dir" class="fields" style="background-color:#FFF">
    <option value="R">يمين</option>
    <option value="L">يسار</option>
    <option value="U">اعلى المنتصف</option>
    <option value="D">اسفل المنتصف</option>
</select>
</td>
</tr>

<tr class="style2">
    <td>ترتيب القائمة:</td>
<td>
    <input type="text" size="10" name="b_order"  class="fields" />
</td>
</tr>

<tr class="style1">
    <td>التفعيل</td>
<td>
<select name="b_active" class="fields" style="background-color:#FFF">
    <option value="yes">مفعل</option>
    <option value="no">غير مفعل</option>
</select>
</td>
</tr>

<tr>
<td align="center" colspan="3"  >
    <input type="submit" value="انشاء القائمة" class="submit" />
    <input type="hidden" name="save" value="block" />
</td>
</tr>

</table>
</form>';
}
#-------------------------------------------------------------#


#------------------edit and delete the BLOCKS----------------#
echo'
<table width="100%" align="center">
<tr><td class="head_page" colspan="3">القوائم المتوفرة</td></tr>
	<tr class="style1">
	<td>اسم القائمة</td>
	<td>ترتيب القائمة</td>
	<td>خيارات القائمة</td>
	</tr>
';
#   *blocks->id,name,con,dir,ord,act
class edit_blocks{
	public $cms;	    #connect to DB CMS
	public $var;     #this var is for get data from DB
	public $obj;	   #this var is for show data from DB
	public $up_act; #this var set act in DB 'yes' or 'no'
	public $req_edit;#value of url to edit -->localhost/cms/admincp/index?page=blocks&edit=block&b_id=5

function __construct(){
	$this->cms=mysqli_connect('localhost','root','11111','CMS') or die ('not found');
	}

public function show_edit_blocks ($var_dir,$head)
{
	$this->var=mysqli_query($this->cms,"SELECT * FROM blocks WHERE dir='$var_dir' ORDER BY ord ASC") or die("The query is wrong");
if(mysqli_num_rows($this->var)>0){
    echo'<tr><td><b><i>'.$head.'</i></b></td></tr>';
while($this->obj=mysqli_fetch_object($this->var)){
echo'
    <tr>
	<td>'.$this->obj->name.'</td>
	<td>'.$this->obj->ord.'</td>
	<td>
	<a href="?page=blocks&block=edit&id='.$this->obj->id.'">تعديل</a>-
	<a href="?page=blocks&block=del&id='.$this->obj->id.'">حذف</a>-';
	if($this->obj->act=="no") {
	echo'
	<a href="?page=blocks&block=act&id='.$this->obj->id.'">تفعيل</a>
    </td>
	</tr>';
	}
	else {
	echo'
	<a href="?page=blocks&block=unact&id='.$this->obj->id.'">الغاء التفعل</a>
    </td>
	</tr>';
		}

}
}
}
}##################>show The blocks<#####################
#----------show the right blocks------------------#
$right_block=new edit_blocks();
$right_block->show_edit_blocks("R", "القائمة اليمنى");

#----------show the left blocks------------------#
$left_block=new edit_blocks();
$left_block->show_edit_blocks("L", "القائمة اليسرى");

#----------show the up_center blocks------------------#
$upc_block=new edit_blocks();
$upc_block->show_edit_blocks("U", "القائمة اعلى المنتصف");

#----------show the down_center blocks------------------#
$downc_block=new edit_blocks();
$downc_block->show_edit_blocks("D", "القائمة اسفل المنتصف");
echo '</table>';
#-----------------------------------------------------------#
?>
