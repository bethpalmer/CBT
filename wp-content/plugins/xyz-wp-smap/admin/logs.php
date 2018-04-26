<?php 

apply_filters('xyz_wp_smap_quick_schedule_logs',0);			//filter to run addon codes

$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
$xyz_smap_task_type=esc_html(get_option('xyz_smap_task_type'));
$xyz_smap_logsMessage = '';
if(isset($_GET['msg'])){
	$xyz_smap_logsMessage = $_GET['msg'];
}


if($_POST){
	
global $wpdb;
if($_POST['xyz_smap_logs_republish'])
{
	$task_ids="";
	foreach($_POST['xyz_smap_premium_logs'] as $value)
	{
		$task_ids.=$value.',';
	}
	$task_ids=rtrim($task_ids,",");
	
	if($task_ids!=""){
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&action=republish&task_ids='.$task_ids.'&pagenum='.$pagenum));
		exit();
	}
	
	
	
}

if($_POST['xyz_smap_logs_reschedule'])
{
	if($xyz_smap_task_type!=1)
	{
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=5'));
		exit();
		
	}
	$task_id="";
	
	
	foreach($_POST['xyz_smap_premium_logs'] as $value)
	{
		$task_id=$value;
		
		$entries2 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tasks WHERE ID=%d',array($task_id)));
	
		foreach( $entries2 as $entry2 ) {
			$publishtime=$entry2->publishtime;
			$acc_id=$entry2->acc_id;
			$acc_type=$entry2->acc_type;
			$postid=$entry2->postid;
			$post_config_value=$entry2->post_config_value;
			$post_message_format=$entry2->post_message_format;
			
			
		}
			$time=time();
			if($publishtime>0)
			{
				
				$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tasks WHERE acc_id=%d and acc_type=%d and postid=%d and publishtime=0',array($acc_id,$acc_type,$postid)) );

				if(count($entries3)==0)
				{
	
					$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
							'postid'	=>	$postid,
							'acc_id'	=>	$acc_id,
							'acc_type'	=>	$acc_type,
							'inserttime'	=>	$time,
							'publishtime'	=>	0,
							'post_method'	=>	0,
							'post_config_value'	=>	$post_config_value,
							'post_message_format'	=>	$post_message_format,
							'status'	=>	0,
							'scheduletime' => $time
					));
					continue;
				
				}
			}
	}
	
	header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=2'));
	exit();

}


if($_POST['xyz_smap_logs_delete'])
{
	$task_ids="";
	foreach($_POST['xyz_smap_premium_logs'] as $value)
	{
		$task_ids.=$value.",";
	}
	$task_ids=rtrim($task_ids,",");

	if($task_ids!=""){
		$wpdb->query( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE id IN('.$task_ids.')');
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=3'));
		exit();
	}
	
}

}

if(isset($_GET['action']) && $_GET['action']=='reschedule')
{
	if($xyz_smap_task_type!=1)
	{
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=5'));
		exit();
	
	}
	global $wpdb;
	$task_id=$_GET['task_id'];
	if($task_id!=""){
		
		$entries2 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tasks WHERE ID=%d',array($task_id)));
		
		foreach( $entries2 as $entry2 ) {
			$publishtime=$entry2->publishtime;
			$acc_id=$entry2->acc_id;
			$acc_type=$entry2->acc_type;
			$postid=$entry2->postid;
			$post_config_value=$entry2->post_config_value;
			$post_message_format=$entry2->post_message_format;
			
		}
		$time=time();
		if($publishtime>0)
		{
		
			$entries3 = $wpdb->get_results( $wpdb->prepare( 'SELECT * FROM '.$wpdb->prefix.'xyz_smap_tasks WHERE acc_id=%d and acc_type=%d and postid=%d and publishtime=0',array($acc_id,$acc_type,$postid)) );
			if(count($entries3)==0)
			{
					
				$wpdb->insert($wpdb->prefix."xyz_smap_tasks",array(
						'postid'	=>	$postid,
						'acc_id'	=>	$acc_id,
						'acc_type'	=>	$acc_type,
						'inserttime'	=>	$time,
						'publishtime'	=>	0,
						'post_method'	=>	0,
						'post_config_value'	=>	$post_config_value,
						'post_message_format'	=>	$post_message_format,
						'status'	=>	0,
						'scheduletime' => $time
						
				));
					
		
			}
			else 
			{
				header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=4'));
				exit();
			}
		}
		else 
		{
			header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=4'));
			exit();
		}
	
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=2'));
		exit();
		
	}
	
}

if(isset($_GET['action']) && $_GET['action']=='delete')
{
	$task_id=$_GET['task_id'];
	
	if($task_id!=""){
		global $wpdb;
		$wpdb->query( 'DELETE FROM  '.$wpdb->prefix.'xyz_smap_tasks  WHERE id IN('.$task_id.')');
		
		header("Location:".admin_url('admin.php?page=social-media-auto-publish-log-premium&pagenum='.$pagenum.'&msg=3'));
		exit();
	}
	
}

?>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery("#chkAll").click(function(){
		jQuery(".chk").prop("checked",jQuery("#chkAll").prop("checked"))
    }) 
});

function logs_checkbox_clickfn(val)
{
	 var allow_flag=0;
	 jQuery('input[name="xyz_smap_premium_logs[]"]:checked').each(function() {
		 allow_flag=1;
		});
		
	if(allow_flag==1)
	{
		if(val==1)
		{
			if(confirm('Post(s) which are already in scheduled status will not be rescheduled'))
				return true;
			else
				return false;
		}
		else
		return true;
	}
	else
	{
		alert("Please select atleast one entry from log");
		return false;
	}

}
</script>
<?php 
if($xyz_smap_logsMessage == 1){
	?>
<div class="system_notice_area_style1" id="system_notice_area">
Post published/republished successfully.&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php
}else if($xyz_smap_logsMessage == 2){
?>
<div class="system_notice_area_style1" id="system_notice_area">
Post rescheduled successfully.&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php 
}else if($xyz_smap_logsMessage == 3){?>

<div class="system_notice_area_style1" id="system_notice_area">
Log deleted successfully.&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php }
else if($xyz_smap_logsMessage == 4){?>

<div class="system_notice_area_style0" id="system_notice_area">
Post is already scheduled .&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php }

else if($xyz_smap_logsMessage == 5){?>

<div class="system_notice_area_style0" id="system_notice_area">
Automatic publishing is disabled.&nbsp;&nbsp;&nbsp;<span
id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php }?>


<div >


	<form method="post" name="xyz_smap_logs_form">
		<fieldset
			style="width: 99%; border: 1px solid #F7F7F7; padding: 10px 0px;">
			


<div style="text-align: left;padding-left: 7px;"><h3>Auto Publish Logs</h3></div>
<span style="padding-left: 6px;color:#21759B;">With Selected : </span>
<input type="submit" title="Publish/Republish" name="xyz_smap_logs_republish" onclick="javascript:return logs_checkbox_clickfn(0);" class="xyz_smap_link" value="Publish/Republish" style="color:#21759B;cursor:pointer;padding: 5px;background:linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;border: 1px solid #DFDFDF;">
<input type="submit" title="Reschedule" name="xyz_smap_logs_reschedule" onclick="javascript:return logs_checkbox_clickfn(1);" class="xyz_smap_link" value="Reschedule" style="color:#21759B;cursor:pointer;padding: 5px;background:linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;border: 1px solid #DFDFDF;">
<input type="submit" title="Delete" name="xyz_smap_logs_delete" onclick="javascript:return logs_checkbox_clickfn(0);" class="xyz_smap_link" value="Delete" style="color:#21759B;cursor:pointer;padding: 5px;background:linear-gradient(to top, #ECECEC, #F9F9F9) repeat scroll 0 0 #F1F1F1;border: 1px solid #DFDFDF;" onclick="javascript:return confirm('Are you sure you want to delete the log(s)? ');">

<p></p>
			<?php 
			global $wpdb;
			
				$pagenum = isset( $_GET['pagenum'] ) ? absint( $_GET['pagenum'] ) : 1;
				$limit =get_option('xyz_smap_premium_page_size');
				$offset = ( $pagenum - 1 ) * $limit;
				$entries = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_tasks ORDER BY id DESC LIMIT $offset,$limit" );
				$total = $wpdb->get_var( "SELECT COUNT(`id`) FROM ".$wpdb->prefix."xyz_smap_tasks" );
				$num_of_pages = ceil( $total / $limit );
				$page_links = paginate_links( array(
						'base' => add_query_arg( 'pagenum','%#%'),
						'format' => '',
						'prev_text' =>  '&laquo;',
						'next_text' =>  '&raquo;',
						'total' => $num_of_pages,
						'current' => $pagenum
				) );
				
				
			?>
			<table class="widefat" style="width: 99%; margin: 0 auto; border-bottom:none;">
				<thead>
					<tr class="xyz_smap_premium_metalist_tr">
						<th scope="col" width="5%"><input type="checkbox" id="chkAll" /></th>
						
						<th scope="col" width="9%">Post Id</th>					
						<th scope="col" width="8%">Post Title</th>
						<th scope="col" width="9%">Account</th>
						<th scope="col" width="15%">Created On</th>
						<th scope="col" width="10%">Post Method</th>
						<th scope="col" width="15%">Published On</th>
						<th scope="col" width="13%">Status</th>
						<th scope="col" width="15%">Action</th>
						<th scope="col" width="15%">SheduleTime</th>
						
					</tr>
				</thead>
				<tbody>
					<?php 
					if( count($entries)>0 ) {
						$count=1;
						$class = '';
						foreach( $entries as $entry ) {
							$class = ( $count % 2 == 0 ) ? ' class="alternate"' : '';
							?>
					<tr <?php echo $class; ?> style="line-height: 30px !important;">
					<td style="vertical-align: middle !important;padding-left: 15px;">
					<input type="checkbox" class="chk" value="<?php echo $entry->id; ?>" name="xyz_smap_premium_logs[]" id="xyz_smap_premium_logs" />
					</td>
					<td  style="vertical-align: middle !important;"><?php echo $entry->postid; ?></td>
					<td  style="vertical-align: middle !important;"><?php echo get_the_title($entry->postid); ?></td>
					
						<td style="vertical-align: middle !important;"><?php 
						if($entry->acc_type==1)
						{
							$entries1 = $wpdb->get_results( $wpdb->prepare( "SELECT xyz_smap_application_name FROM ".$wpdb->prefix."xyz_smap_fb_details WHERE id=%d" ,array($entry->acc_id)));
							if(count($entries1)>0)
							echo "Facebook : ".$entries1[0]->xyz_smap_application_name;
						}
						else if($entry->acc_type==2)
						{
							$entries1 = $wpdb->get_results( $wpdb->prepare( "SELECT xyz_smap_application_name FROM ".$wpdb->prefix."xyz_smap_tw_details WHERE id=%d",array($entry->acc_id) ));
						if(count($entries1)>0)
							echo "Twitter : ".$entries1[0]->xyz_smap_application_name;
						}
						else if($entry->acc_type==3)
						{
							$entries1 = $wpdb->get_results( $wpdb->prepare( "SELECT xyz_smap_application_name FROM ".$wpdb->prefix."xyz_smap_ln_details WHERE id=%d",array($entry->acc_id) ));
							if(count($entries1)>0)
							echo "LinkedIn : ".$entries1[0]->xyz_smap_application_name;
						}
						else if($entry->acc_type==4)
						{
							$entries1 = $wpdb->get_results( $wpdb->prepare( "SELECT xyz_smap_application_name FROM ".$wpdb->prefix."xyz_smap_pi_details WHERE id=%d",array($entry->acc_id) ));
							if(count($entries1)>0)
							echo "Pinterest : ".$entries1[0]->xyz_smap_application_name;
						}
						else if($entry->acc_type==5)
						{
							$entries1 = $wpdb->get_results( $wpdb->prepare( "SELECT xyz_smap_application_name FROM ".$wpdb->prefix."xyz_smap_gp_details WHERE id=%d",array($entry->acc_id) ));
							if(count($entries1)>0)
							echo "Google Plus : ".$entries1[0]->xyz_smap_application_name;
						}
						?></td>
						
						<td style="vertical-align: middle !important;"><?php echo xyzsmap_local_date_time('Y/m/d g:i:s A',$entry->inserttime);?></td>
						
						<td style="vertical-align: middle !important;"><?php 
						if($entry->post_method==0)
							echo "Scheduled";
						else
							 echo "Instantaneous"
						?>
						</td>
						
						<td style="vertical-align: middle !important;">
						<?php if($entry->publishtime!="" && $entry->publishtime!=0)echo xyzsmap_local_date_time('Y/m/d g:i:s A',$entry->publishtime);?>
						
						</td>
						
						<td style="vertical-align: middle !important;">
						
						<?php
						
                         if($entry->status=="1")
                         	echo "<span style=\"color:green\">Success</span>";
                         else if($entry->status=="0")
                         	echo '';
                         else 
                         {
                         	$arrval=unserialize($entry->status);
                         
						    if(isset($arrval["statuses/update_with_media"])||isset($arrval["statuses/update"])||isset($arrval["new"])||isset($arrval["post"]))
						    {
						    	foreach ($arrval as $a=>$b)
						    		echo "<span style=\"color:red\">".$a." : ".$b."</span><br>";
						    }
						    else 
						    	print_r($arrval);
                         } 
						     
						     ?>
						</td>
						<td>
						<?php if($entry->publishtime>0){?>
						<a href="<?php echo admin_url('admin.php?page=social-media-auto-publish-log-premium&action=republish&task_ids='.$entry->id.'&pagenum='.$pagenum);?>" title="Republish">Republish</a> | <a href="<?php echo admin_url('admin.php?page=social-media-auto-publish-log-premium&action=reschedule&task_id='.$entry->id.'&pagenum='.$pagenum);?>" title="Reschedule" >Reschedule</a> | <a href="<?php echo admin_url('admin.php?page=social-media-auto-publish-log-premium&action=delete&task_id='.$entry->id.'&pagenum='.$pagenum);?>" title="Delete" onclick="javascript:return confirm('Are you sure you want to delete the log(s)? ');">Delete</a></td>
					<?php }else{?>
					<a href="<?php echo admin_url('admin.php?page=social-media-auto-publish-log-premium&action=republish&task_ids='.$entry->id.'&pagenum='.$pagenum);?>" title="Publish">Publish</a> | <a href="<?php echo admin_url('admin.php?page=social-media-auto-publish-log-premium&action=delete&task_id='.$entry->id.'&pagenum='.$pagenum);?>" title="Delete" onclick="javascript:return confirm('Are you sure you want to delete the log(s)? ');">Delete</a></td>
					
					<?php }?>
					<td><?php if($entry->scheduletime!="" && $entry->scheduletime!=0)echo xyzsmap_local_date_time('Y/m/d g:i:s A',$entry->scheduletime);else echo "NA";?></td>
					
					</tr>
					
					<?php
					$count++;
						}
					} else { ?>
					<tr style="line-height: 30px !important;">
						<td colspan="8" >No logs found</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php 
			if ( $page_links ) {
				echo '<div class="tablenav" style="width:99%"><div class="tablenav-pages" style="margin: 1em 0">' . $page_links . '</div></div>';
			}
			
			?>
			
		</fieldset>

	</form>

</div>
