<?php
require'conf.php';#connect to DB
#-------------------------------DB->*CMS*---------------------------------------#

#TABLE >---------------------------------main_settings--------|              
    $site_info=mysqli_query($cms,"SELECT * FROM main_settings") or die("please make sure the query is true") ;            
    $site=mysqli_fetch_object($site_info);                                   
    $s_name	=	$site->site_name;                                           
    $s_url	=	$site->site_url;
    $s_mail	=	$site->site_mail;
    $s_desc	=	$site->site_desc;
    $s_tags	=	$site->site_tags;
    $s_open_or_close	=	$site->site_open_or_close;
    $s_msg_open_or_close_name	=	$site->site_msg_open_or_close;
    $h_act=$site->header_act;
    $h_con=$site->header_con;
    $f_act=$site->footer_act;
    $f_con=$site->footer_con;
    $copyR=$site->copyrights;
#verifying the site close or not  
if($s_open_or_close==2)
{
die(
 '
 <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
 <title> '.$s_name.' - مغلق </title>
 <center><strong>'.$site->site_msg_open_or_close.'</strong></center>
 '
);
}

#TABLE >---------------------------------blocks--------------|
                 #blocks->id,name,con,dir,order,act

    
    

#-------------------------------DB->^CMS^---------------------------------------#
?>
