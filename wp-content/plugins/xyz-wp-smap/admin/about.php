<?php
$xyz_smap_updateMessage = '';$xyz_er_msg='';
if(isset($_GET['msg'])){
	$xyz_smap_updateMessage = $_GET['msg'];
}
if($xyz_smap_updateMessage == 1){
	if(isset($_GET['error_msg']))
		$xyz_er_msg=$_GET['error_msg'];
	?>
<div class="system_notice_area_style0" id="system_notice_area">
<?php echo $xyz_er_msg;?>. Please try manual update&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
}
else if($xyz_smap_updateMessage == 2){
	?>
<div class="system_notice_area_style0" id="system_notice_area">
Zip extraction failed. Please try manual update&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
}
else if($xyz_smap_updateMessage == 3){
	?>
<div class="system_notice_area_style0" id="system_notice_area">
Request timed out. Please try manual update&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
}
if($xyz_smap_updateMessage == 4){
	$pluginFile='xyz-wp-smap';
	$pluginName=$pluginFile."/".$pluginFile.".php";
	$activation_mode=is_plugin_active_for_network($pluginName);
	deactivate_plugins( $pluginName );
	if($activation_mode)
		$act_plugin=activate_plugin( $pluginName, admin_url('admin.php?page=social-media-auto-publish-about-premium&msg=6') , true );
	else		
		$act_plugin=activate_plugin( $pluginName);
	
	if($act_plugin!=NULL){
	?>
		<div class="system_notice_area_style0" id="system_notice_area">
		Plugin activation error. Please try manual update&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
		</div>
	<?php }else{?>
		<div class="system_notice_area_style1" id="system_notice_area">
		Plugin updated successfully.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
		</div>
	<?php
	}
}
else if($xyz_smap_updateMessage == 5){
	?>
<div class="system_notice_area_style0" id="system_notice_area">
Could not create directory. Please try manual update&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
}else if($xyz_smap_updateMessage == 6){
	?>
		<div class="system_notice_area_style1" id="system_notice_area">
		Plugin updated successfully.&nbsp;&nbsp;&nbsp;<span
		id="system_notice_area_dismiss">Dismiss</span>
		</div>
<?php
}
?>
<style>
</style>
<fieldset style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
<legend><h1 style="visibility: visible;">Social Media Auto Publish (V <?php echo xyz_smap_premium_plugin_get_version(); ?>)</h1>
</legend>
<div style="width: 99%">
<p style="text-align: justify">
Social Media Auto Publish automatically publishes posts from your blog to your   Facebook, Twitter, LinkedIn, Pinterest, Google Plus pages.
 Social Media Auto Publish is developed and maintained by
<a href="http://xyzscripts.com">xyzscripts</a>
.</p></div>
<table class="widefat" style="width: 99%; margin: 0 auto; border-bottom:thin; ">
	<tr><td>*</td><td>
		<a target="_blank" href="http://kb.xyzscripts.com/wordpress-plugins/social-media-auto-publish/" >FAQ</a> 
		</td>
	</tr>
	<tr><td>*</td><td>
		<a target="_blank" href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/">Documentation</a>  
		</td>
	</tr>
	<tr><td>*</td><td>
		<a target="_blank" href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/creating-facebook-application" target="_blank">How can I create a Facebook Application?</a>
		</td>
	</tr>
	<tr><td>*</td><td>
		<a target="_blank" href="http://kb.xyzscripts.com/how-can-i-find-my-facebook-user-id" target="_blank">How can I find my Facebook user id?</a>
		</td>
	</tr>
	<tr><td>*</td><td>
		<a target="_blank" href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/creating-twitter-application" target="_blank">How can I create a Twitter Application?</a>
		</td>
	</tr>
	<tr><td>*</td><td>
		<a target="_blank" href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/creating-linkedin-application" target="_blank">How can I create a Linkedin Application?</a>
		</td>
	</tr>
</table>
</fieldset>
<?php 

?>