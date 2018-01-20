<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<link rel="stylesheet" type="text/css" href="thems/style.css" />
<title>لوحة التحكم</title>

<script type="text/javascript" src="../jquery-2.1.1.min.js"></script>
<!--<script type="text/javascript">


/*this code to show admin pages when click on element of UL with ajax (admin pages will show in left-center of page) */
/*function get_admin_page(get_page){    //this func to do ajax
	$.ajax({                                   //$.ajax(json); don't forget that !!! 
	url:get_page,
	type:'GET',
	beforeSend:function(){
		$('.admin_page').html('<img src="../thems/img/loading1.gif" class="loading">');//img not work the src is true!!
	},
	success:function(data){
		$('.admin_page').html(data);
	}
});	
}
$(function(){
	/*$('table tr td ul li a').click(function(){
	$('table tr td ul li a').removeClass('a_click');
	$(this).addClass('a_click');
	var a_number=$('table tr td ul li a').index(this);
	if(a_number==0){get_admin_page('index.php')}        //dont' forget add url in func
	else if(a_number==1){get_admin_page('main_settings.php')}   //dont' forget add url in func
	else if(a_number==2){get_admin_page('tmp.php')}   //dont' forget add url in func
	
	});  */
/*this code to show admin pages when click on element of UL with ajax (admin pages will show in left-center of page) // */

	
});	
</script>-->
</head>
<body>
	
	
<!--header-->	
<table width="100%">
<div class="header">مرحبا بك في لوحة التحكم! </div>		
</table>
<!--header//-->
<hr />	



<!--body-->

<!--right_block-->
<table width="100%">
<tr>
<td valign="top" width="20%">
<ul><!--**I have idea when click on the follownig list there will img added in left of list** -->
<li class="h_menu">اعدادات الموقع</li>	
<li><a href="index.php">الرئيسية</a></li>
<li><a href="?page=main_settings">اعدادات عامة</a></li>
<li><a href="http://localhost/cms" target="_blank">معاينة الموقع</a></li>
</ul>

<ul><!--**I have idea when click on the follownig list there will img added in left of list** -->
<li class="h_menu">القوائم</li>	
<li><a href="?page=blocks">القوائم الجانبية</a></li>
</ul>

<ul>
<li class="h_menu">الصفحات الخارجية</li>
<li><a href="?page=custom">إعدادات الصفحات الخارجية</a></li>
</ul>
</td>
<!--right_block//-->


<!--left-center_block-->
<div class="bordr_right">
<td valign="top" width="80%" class="admin_page">
<?php
/*this code to verify The page found or not*/
require '../inc/conf.php';
if(isset($_GET['page'])){
	$get_page=$_GET['page'];
	$get_page.='.php';
	if(file_exists($get_page)){
		require $get_page;        // if I write  require '$get_page' it won't be work
		
	}else {
		echo "الصفحة ليست موجودة";
	}
}
else {      // this check  fileds of form and send The data to DB (form->notes for admin) 
    if(isset($_POST['save']) && $_POST['save']=='changes'){
    $admin_notes=strip_tags($_POST['admin_notes']);
    $update=mysqli_query($cms,"UPDATE main_settings SET admin_notes='$admin_notes';")  or die ("please check your DB query");
    if(isset($update)){
    die('
    تم الإرسال بنجاح..من فضلك انتظر قليلاً
    <meta http-equiv="refresh" content="2; url=index.php"/>        
    ');
	}
}
    $site_info=mysqli_query($cms,"SELECT admin_notes FROM main_settings");
    $site=mysqli_fetch_object($site_info);    
	echo '
<form method="post" action="index.php">
<table width="100%">
<tr><td colspan="2" class="head_page">ملاحظات المدير العام</td></tr>	
<tr>
<td>الملاحظات</td>
<td><textarea name="admin_notes" rows="20" cols="115" class="fields">'.$site->admin_notes.'</textarea></td>	
</tr>
<tr>
<td align="center" colspan="3"  >
    <input type="submit" value="حفظ" class="submit" />
    <input type="hidden" name="save" value="changes" /> 	  
</td>
</tr>
</table>
</form>
<table width="100%">
<tr><td colspan="2" class="head_page">معلومات الموقع</td></tr>
<tr>
<td>اسم الموقع : ادارة محتوى</td>
<td>الإصدار : 1.1</td>
</tr>
<tr>
<td>المبرمج : محمود أحمد</td>
<td>تاريخ الانشاء : 8/8/2014</td>
</tr>	
</table>
	';
}
/*this code to verify The page found or not//*/
?>	
</td>
</div>	
</tr>
</table>
<!--left-center_block//-->

<!--body//-->	


<!--footer-->
<table width="100%">
<div class="clear"> </div>
<div class="footer">جميع الحقوق محفوظة لــ محمود أحمد ولجميع فريق العمل ولكل من ساهم في بناء هذا القالب</div>	
</table>		
</body>
</html>
<!--footer//-->
