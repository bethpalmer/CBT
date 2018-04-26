<?php
global $current_user;
$auth_varble=0;
$imgpath= plugins_url()."/xyz-wp-smap/admin/images/";
$heimg=$imgpath."support.png";
$xyz_smap_account_type="";
if(isset($_GET['post_type']))
$xyz_smap_account_type= $_GET['type'];

if(isset($_POST['bsettngs']))
{
		
	$flag=1;$msg1="";
$xyz_smap_premium_include_pages=$_POST['xyz_smap_premium_include_pages'];
$xyz_smap_premium_include_posts=$_POST['xyz_smap_premium_include_posts'];
if($_POST['xyz_smap_cat_all']=="All")
	$smap_category_ids=$_POST['xyz_smap_cat_all'];//radio btn name
else
    $smap_category_ids=$_POST['xyz_smap_sel_cat'];//dropdown



$xyz_customtypes="";
if(isset($_POST['post_types']))
$xyz_customtypes=$_POST['post_types'];
$xyz_smap_premium_peer_verification=$_POST['xyz_smap_premium_peer_verification'];
$xyz_smap_premium_default_selection_create_postORpage=$_POST['xyz_smap_premium_default_selection_create_postORpage'];
$xyz_smap_premium_default_selection_edit=$_POST['xyz_smap_premium_default_selection_edit'];
$xyz_smap_premium_page_size=$_POST['xyz_smap_premium_page_size'];
$xyz_smap_premium_hash_tags=$_POST['xyz_smap_premium_hash_tags'];
$xyz_smap_premium_image_metakey_name=$_POST['xyz_smap_premium_image_metakey_name'];

$xyz_smap_message=$_POST['xyz_smap_fbmessage'];
$xyz_smap_twmessage=$_POST['xyz_smap_twmessage'];
$xyz_smap_lnmessage=$_POST['xyz_smap_lnmessage'];
$xyz_smap_pimessage=$_POST['xyz_smap_pimessage'];
$xyz_smap_gpmessage=$_POST['xyz_smap_gpmessage'];

$xyz_smap_fb_image_url=$_POST['xyz_smap_fb_image_url'];
$xyz_smap_tw_image_url=$_POST['xyz_smap_tw_image_url'];
$xyz_smap_ln_image_url=$_POST['xyz_smap_ln_image_url'];
$xyz_smap_pi_image_url=$_POST['xyz_smap_pi_image_url'];
$xyz_smap_gp_image_url=$_POST['xyz_smap_gp_image_url'];
//$xyz_smap_pi_board_pattern=$_POST['xyz_smap_pi_board_pattern'];

$xyz_smap_applyfilters="";
if(isset($_POST['xyz_smap_applyfilters'])) 
	$xyz_smap_applyfilters=$_POST['xyz_smap_applyfilters'];

$xyz_smap_task_type=$_POST['xyz_smap_task_type'];
$xyz_smap_clearlogs_interval=$_POST['xyz_smap_clearlogs_interval'];
if($xyz_smap_task_type==1){
$xyz_smap_post_publish_percron=$_POST['xyz_smap_post_publish_percron'];
$xyz_smap_min_timedelay_post_publish_value=$_POST['xyz_smap_min_timedelay_post_publish_value'];
$xyz_smap_min_timedealy_post_publish_period=$_POST['xyz_smap_min_timedealy_post_publish_period'];

}
if($xyz_smap_premium_page_size=="")
{
	
	$flag=0;
	$msg1="Please fill page size";
}
if(!(is_numeric( $xyz_smap_premium_page_size ) && strpos( $xyz_smap_premium_page_size, '.' ) === false) && $flag==1)
{
	
	$flag=0;
	$msg1="Please fill a valid page size";
}
if($xyz_smap_message=="" && $flag==1)
{
	$flag=0;
	$msg1="Please fill facebook message format";
}
if($xyz_smap_twmessage=="" && $flag==1)
{
	$flag=0;
	$msg1="Please fill twitter message format";
}
if($xyz_smap_lnmessage=="" && $flag==1)
{
	$flag=0;
	$msg1="Please fill linkedin message format";
}
if($xyz_smap_pimessage=="" && $flag==1)
{
	$flag=0;
	$msg1="Please fill pinterest message format";
}

if($xyz_smap_gpmessage=="" && $flag==1)
{
	$flag=0;
	$msg1="Please fill google plus message format";
}

if($xyz_smap_pi_image_url=="" && $flag==1)
{
	$flag=0;
	$msg1="Please fill pinterest image url";
}



if($flag==1)
{
   $smap_customtype_ids="";

		if($xyz_customtypes!="")
		{
			for($i=0;$i<count($xyz_customtypes);$i++)
			{
				$smap_customtype_ids.=$xyz_customtypes[$i].",";
			}
		
		}
		$smap_customtype_ids=rtrim($smap_customtype_ids,',');
		
		if(intval($xyz_smap_clearlogs_interval)==0 || $xyz_smap_clearlogs_interval=="")
			$xyz_smap_clearlogs_interval=0;
		
		if($xyz_smap_task_type==1)
		{
			if(intval($xyz_smap_post_publish_percron)==0 || $xyz_smap_post_publish_percron=="")
				$xyz_smap_post_publish_percron=10;
			
			if(intval($xyz_smap_min_timedelay_post_publish_value)==0 || $xyz_smap_min_timedelay_post_publish_value=="")
				$xyz_smap_min_timedelay_post_publish_value=0;
				
				
		}
		$xyz_smap_applyfilters_val="";
		if($xyz_smap_applyfilters!="")
		{
			for($i=0;$i<count($xyz_smap_applyfilters);$i++)
			{
				$xyz_smap_applyfilters_val.=$xyz_smap_applyfilters[$i].",";
			}
		
		}
		$xyz_smap_applyfilters_val=rtrim($xyz_smap_applyfilters_val,',');
		
update_option('xyz_smap_premium_include_pages',$xyz_smap_premium_include_pages);
update_option('xyz_smap_premium_include_posts',$xyz_smap_premium_include_posts);
if($xyz_smap_premium_include_posts==0)
	update_option('xyz_smap_premium_include_categories',"All");
else
	update_option('xyz_smap_premium_include_categories',$smap_category_ids);
update_option('xyz_smap_premium_include_customposttypes',$smap_customtype_ids);
update_option('xyz_smap_apply_filters',$xyz_smap_applyfilters_val);
update_option('xyz_smap_premium_peer_verification',$xyz_smap_premium_peer_verification);
update_option('xyz_smap_premium_default_selection_create_postORpage',$xyz_smap_premium_default_selection_create_postORpage);
update_option('xyz_smap_premium_default_selection_edit',$xyz_smap_premium_default_selection_edit);
update_option('xyz_smap_premium_page_size',$xyz_smap_premium_page_size);
update_option('xyz_smap_premium_image_metakey_name',$xyz_smap_premium_image_metakey_name);
update_option('xyz_smap_premium_hash_tags',$xyz_smap_premium_hash_tags);

update_option('xyz_smap_fbmessage_format',$xyz_smap_message);
update_option('xyz_smap_twmessage_format',$xyz_smap_twmessage);
update_option('xyz_smap_lnmessage_format',$xyz_smap_lnmessage);
update_option('xyz_smap_pimessage_format',$xyz_smap_pimessage);
update_option('xyz_smap_gpmessage_format',$xyz_smap_gpmessage);

update_option('xyz_smap_fb_image_url',$xyz_smap_fb_image_url);
update_option('xyz_smap_tw_image_url',$xyz_smap_tw_image_url);
update_option('xyz_smap_ln_image_url',$xyz_smap_ln_image_url);
update_option('xyz_smap_pi_image_url',$xyz_smap_pi_image_url);
update_option('xyz_smap_gp_image_url',$xyz_smap_gp_image_url);
// update_option('xyz_smap_pi_board_pattern',$xyz_smap_pi_board_pattern);
$xyz_smap_premium_utf_decode=$_POST['xyz_smap_premium_utf_decode'];
update_option('xyz_smap_premium_utf_decode', $xyz_smap_premium_utf_decode);
$xyz_credit_link=$_POST['xyz_credit_link'];
update_option('xyz_credit_link', $xyz_credit_link);

update_option('xyz_smap_task_type',$xyz_smap_task_type);
update_option('xyz_smap_clearlogs_interval',$xyz_smap_clearlogs_interval);

if($xyz_smap_task_type==1)
{
update_option('xyz_smap_post_publish_percron',$xyz_smap_post_publish_percron);
update_option('xyz_smap_min_timedelay_post_publish_value',$xyz_smap_min_timedelay_post_publish_value);
update_option('xyz_smap_min_timedealy_post_publish_period',$xyz_smap_min_timedealy_post_publish_period);


}
$msg1="Basic settings updated successfully";
}

}
$xyz_smap_premium_utf_decode=get_option('xyz_smap_premium_utf_decode');
$xyz_credit_link=esc_html(get_option('xyz_credit_link'));
$xyz_smap_premium_include_pages=esc_html(get_option('xyz_smap_premium_include_pages'));
$xyz_smap_premium_include_posts=esc_html(get_option('xyz_smap_premium_include_posts'));
$xyz_smap_premium_include_categories=esc_html(get_option('xyz_smap_premium_include_categories'));
$xyz_smap_premium_include_customposttypes=esc_html(get_option('xyz_smap_premium_include_customposttypes'));
$xyz_smap_apply_filters=get_option('xyz_smap_apply_filters');
$xyz_smap_premium_peer_verification=esc_html(get_option('xyz_smap_premium_peer_verification'));
$xyz_smap_premium_default_selection_create_postORpage=esc_html(get_option('xyz_smap_premium_default_selection_create_postORpage'));
$xyz_smap_premium_default_selection_edit=esc_html(get_option('xyz_smap_premium_default_selection_edit'));
$xyz_smap_premium_page_size=esc_html(get_option('xyz_smap_premium_page_size'));
$xyz_smap_premium_image_preference=esc_html(get_option('xyz_smap_premium_image_preference'));
$xyz_smap_premium_image_metakey_name=esc_html(get_option('xyz_smap_premium_image_metakey_name'));
$xyz_smap_premium_hash_tags=esc_html(get_option('xyz_smap_premium_hash_tags'));

$xyz_smap_fbmessage_format=esc_textarea(get_option('xyz_smap_fbmessage_format'));
$xyz_smap_twmessage_format=esc_textarea(get_option('xyz_smap_twmessage_format'));
$xyz_smap_lnmessage_format=esc_textarea(get_option('xyz_smap_lnmessage_format'));
$xyz_smap_pimessage_format=esc_textarea(get_option('xyz_smap_pimessage_format'));
$xyz_smap_gpmessage_format=esc_textarea(get_option('xyz_smap_gpmessage_format'));


$xyz_smap_fb_image_url=esc_html(get_option('xyz_smap_fb_image_url'));
$xyz_smap_tw_image_url=esc_html(get_option('xyz_smap_tw_image_url'));
$xyz_smap_ln_image_url=esc_html(get_option('xyz_smap_ln_image_url'));
$xyz_smap_pi_image_url=esc_html(get_option('xyz_smap_pi_image_url'));
$xyz_smap_gp_image_url=esc_html(get_option('xyz_smap_gp_image_url'));
// $xyz_smap_pi_board_pattern=esc_html(get_option('xyz_smap_pi_board_pattern'));

$xyz_smap_task_type=esc_html(get_option('xyz_smap_task_type'));
$xyz_smap_clearlogs_interval=esc_html(get_option('xyz_smap_clearlogs_interval'));

$xyz_smap_post_publish_percron=esc_html(get_option('xyz_smap_post_publish_percron'));
$xyz_smap_min_timedelay_post_publish_value=esc_html(get_option('xyz_smap_min_timedelay_post_publish_value'));
$xyz_smap_min_timedealy_post_publish_period=esc_html(get_option('xyz_smap_min_timedealy_post_publish_period'));


?>
<script type="text/javascript">
function detdisplay(id)
{
	
document.getElementById(id).style.display='';

}
function dethide(id)
{

	 document.getElementById(id).style.display='none';

}

function dispschedule()
{
	
	if(document.getElementById("xyz_smap_task_type").value==1)
	{
			document.getElementById('sh_post_publish_percron').style.display="";
			document.getElementById('sh_post_publish_timedelay').style.display="";
	}
	else
	{
		document.getElementById('sh_post_publish_percron').style.display="none";
		document.getElementById('sh_post_publish_timedelay').style.display="none";
	}
}

jQuery(document).ready(function()
		{
			jQuery(function() 
			{jQuery("#reorder_status").hide();
				jQuery("#image_preference ul").sortable(
				{ 
					
					opacity: 0.5, cursor: 'move', update: function() 
					{
						var order = jQuery(this).sortable("serialize") + '&action=xyz_smap_premium_preference_reorder'; 
						jQuery.post(ajaxurl, order, function(theResponse)
						{   jQuery("#reorder_status").show();
							jQuery("#reorder_status").html(theResponse);
						}); 															 
					}								  
				});
			});
		});	
		
</script>
<div>
<?php 
if(isset($_POST['bsettngs']) && $msg1!="")
{
if($flag==0)
	$cl="system_notice_area_style0";
else if($flag==1)
	$cl="system_notice_area_style1";
?>

<div class="<?php  echo $cl; ?>" id="system_notice_area">
	<?php 
	echo $msg1;
	?> &nbsp;&nbsp;&nbsp;<span id="system_notice_area_dismiss">Dismiss</span>
</div>
<?php }?>

<h3>Basic Settings</h3>


<form method="post" >

<table  class="widefat xyz_smap_premium_table" style="width:98%;padding-top: 10px;">

<tr valign="top">

<td scope="row" colspan="1" width="50%" style="border-top:0px;">Publish wordpress `pages` to social media	<span class="mandatory">*</span></td>
<td style="border-top:0px;"><select name="xyz_smap_premium_include_pages" >

<option value ="1" <?php if($xyz_smap_premium_include_pages=='1') echo 'selected'; ?> >Yes </option>

<option value ="0" <?php if($xyz_smap_premium_include_pages!='1') echo 'selected'; ?> >No </option>
</select>
</td></tr>

<tr valign="top">
	<td  colspan="1">Publish wordpress `posts` to social media
	</td>
	<td><select name="xyz_smap_premium_include_posts" onchange="xyz_smap_premium_show_postCategory(this.value);">

			<option value="1"
			<?php if($xyz_smap_premium_include_posts=='1') echo 'selected'; ?>>Yes</option>

			<option value="0"
			<?php if($xyz_smap_premium_include_posts!='1') echo 'selected'; ?>>No</option>
	</select>
	</td>
</tr>

<tr valign="top"  id="selPostCat_premium">

<td scope="row" colspan="1">Select post categories for auto publish	<span class="mandatory">*</span></td>
<td>
<input type="hidden" value="<?php echo $xyz_smap_premium_include_categories;?>" name="xyz_smap_sel_cat" id="xyz_smap_sel_cat">

<input type="radio" name="xyz_smap_cat_all" id="xyz_smap_cat_all" value="All" onchange="rd_cat_chn(-1)" <?php if($xyz_smap_premium_include_categories=="All") echo "checked"?> >All<font style="padding-left: 10px;"></font><input type="radio" name="xyz_smap_cat_all" id="xyz_smap_cat_all" value="" onchange="rd_cat_chn(1)" <?php if($xyz_smap_premium_include_categories!="All") echo "checked"?>>Specific 

<span id="cat_dropdown_span"><br /><br />
 
<?php 


$args = array(
		'show_option_all'    => '',
		'show_option_none'   => '',
		'orderby'            => 'name',
		'order'              => 'ASC',
		'show_last_update'   => 0,
		'show_count'         => 0,
		'hide_empty'         => 0,
		'child_of'           => 0,
		'exclude'            => '',
		'echo'               => 0,
		'selected'           => '1 3',
		'hierarchical'       => 1,
		'id'                 => 'xyz_smap_catlist',
		'class'              => 'postform',
		'depth'              => 0,
		'tab_index'          => 0,
		'taxonomy'           => 'category',
		'hide_if_empty'      => false );

if(count(get_categories($args))>0)
{
$args['name']='xyz_smap_catlist';
echo str_replace( "<select", "<select multiple onClick=setcat(this) style='width:200px;height:auto !important;border:1px solid #cccccc;'", wp_dropdown_categories($args));
}
else
echo "NA";

?><br /><br />
</span>
</td></tr>


<tr valign="top">

<td scope="row" colspan="1">Select wordpress custom post types for auto publish</td>
<td>


<?php 

$args=array(
  'public'   => true,
  '_builtin' => false
); 
$output = 'names'; // names or objects, note names is the default
$operator = 'and'; // 'and' or 'or'
$post_types=get_post_types($args,$output,$operator);

$ar1=explode(",",$xyz_smap_premium_include_customposttypes);
  $cnt=count($post_types);
  foreach ($post_types  as $post_type ) {

echo '<input type="checkbox" name="post_types[]"  value="'.$post_type.'" ';
if(in_array($post_type, $ar1))
{
	echo 'checked="checked"/>';
}
else
	echo '/>';

echo '<label>'.$post_type.'</label><br/>';

  }
  if($cnt==0)
  echo 'NA';
?>

</td></tr>

<tr valign="top">
<td scope="row" colspan="1" width="50%">Default selection of auto publish while creating posts/pages	<span class="mandatory">*</span>	</td>
<td>
<input type="radio" name="xyz_smap_premium_default_selection_create_postORpage" value="1" <?php if($xyz_smap_premium_default_selection_create_postORpage=='1') echo "checked"?> >
Enable auto publish to all accounts<br>
<input type="radio" name="xyz_smap_premium_default_selection_create_postORpage" value="0" <?php if($xyz_smap_premium_default_selection_create_postORpage=='0') echo "checked"?>>
Disable auto publish to all accounts
</td></tr>

<tr valign="top">

<td scope="row" colspan="1" width="50%">Default selection of auto publish while editing posts/pages	<span class="mandatory">*</span>	</td>
<td>
<input type="radio" name="xyz_smap_premium_default_selection_edit" value="1" <?php if($xyz_smap_premium_default_selection_edit=='1') echo "checked"?> >
Enable auto publish to all accounts<br>
<input type="radio" name="xyz_smap_premium_default_selection_edit" value="0" <?php if($xyz_smap_premium_default_selection_edit=='0') echo "checked"?>>
Disable auto publish to all accounts<br>
<input type="radio" name="xyz_smap_premium_default_selection_edit" value="2" <?php if($xyz_smap_premium_default_selection_edit=='2') echo "checked"?>>
Use settings from post creation or post updation

 
</td></tr>



<tr valign="top">

<td scope="row" colspan="1" width="50%">SSL peer verification	<span class="mandatory">*</span>	</td><td><select name="xyz_smap_premium_peer_verification" >

<option value ="1" <?php if($xyz_smap_premium_peer_verification=='1') echo 'selected'; ?> >Enable </option>

<option value ="0" <?php if($xyz_smap_premium_peer_verification=='0') echo 'selected'; ?> >Disable </option>
</select> 
</td></tr>

<tr valign="top">

<td scope="row" >Page Size	<span class="mandatory">*</span>	</td>
<td>
<input id="xyz_smap_premium_page_size"  name="xyz_smap_premium_page_size" type="text" value="<?php echo $xyz_smap_premium_page_size;?>"/>
	
</td></tr>

<tr  valign="top"><td>Meta key name for fetching image url for auto publish</td><td>
<input type="text" value="<?php echo $xyz_smap_premium_image_metakey_name;?>" name="xyz_smap_premium_image_metakey_name" id="xyz_smap_premium_image_metakey_name">  
</td></tr>

<tr valign="top">
<td>Image preference<br><span style="color: green;">[Image Preference Order - Drag and Drop to Reorder]</span></td>
<td>
		<div id="image_preference">
			<ul>
			<?php $xyz_smap_premium_image_preference1=explode(',',$xyz_smap_premium_image_preference);
			
			foreach ($xyz_smap_premium_image_preference1 as $key=>$value)
			{
				if($value==1)
					echo '<li id="image_preference_1">Featured</li>';
				else if($value==2)
					echo '<li id="image_preference_2">First Image From the Content</li>';
				else if($value==3)
					echo '<li id="image_preference_3">Meta Keyname</li>';
				else if($value==4)
					echo '<li id="image_preference_4">Open Graph Tags</li>';
			}
			
			?>
			
			</ul>
			<div id="reorder_status" style="display: none;"></div>
		</div>
		
</td></tr>



<tr valign="top">

<td>Hash tags <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_hash_tag')" onmouseout="dethide('xyz_hash_tag')">
						<div id="xyz_hash_tag" class="informationdiv" style="display: none;">
							If the specified keywords are found in the message to be posted.
							Those will be replaced as hash tags while posting to facebook,twitter,pinterest and google plus.<br />
						</div>
<br><span style="color: maroon;">[Seperated by comma]</span>
</td>
<td>
<textarea id="xyz_smap_premium_hash_tags"  name="xyz_smap_premium_hash_tags" style="height:80px;"/><?php echo $xyz_smap_premium_hash_tags;?></textarea>
</td></tr>






<tr valign="top"><td>
	Facebook message format for posting	<span class="mandatory">*</span>	<img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_fb')" onmouseout="dethide('xyz_fb')">
						<div id="xyz_fb" class="informationdiv" style="display: none;">
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.
							<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div>
		</td>
		<td>
		<select name="xyz_smap_premium_fb_info" id="xyz_smap_premium_fb_info" onchange="xyz_smap_premium_fb_info_insert(this)">
		<option value ="0" selected>--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr><tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_fbmessage"  name="xyz_smap_fbmessage" style="height:80px;"><?php echo $xyz_smap_fbmessage_format;?></textarea> 
		</td></tr>
	
	
	<tr valign="top"><td>
	Twitter message format for posting	<span class="mandatory">*</span>	<img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_tw')" onmouseout="dethide('xyz_tw')">
						<div id="xyz_tw" class="informationdiv"
							style="display: none; font-weight: normal;">
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.
							<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div>
		</td>
		<td>
		<select name="xyz_smap_premium_tw_info" id="xyz_smap_premium_tw_info" onchange="xyz_smap_premium_tw_info_insert(this)">
		<option value ="0" selected>--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr><tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_twmessage"  name="xyz_smap_twmessage" style="height:80px;" ><?php echo $xyz_smap_twmessage_format;?></textarea> 
	</td></tr>
	
	<tr valign="top"><td>
	Linkedin message format for posting	<span class="mandatory">*</span>	<img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_ln')" onmouseout="dethide('xyz_ln')">
						<div id="xyz_ln" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.
							<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div>
		</td>
		<td>
		<select name="xyz_smap_premium_ln_info" id="xyz_smap_premium_ln_info" onchange="xyz_smap_premium_ln_info_insert(this)" >
		<option value ="0" selected>--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr><tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_lnmessage"  name="xyz_smap_lnmessage" style="height:80px;" ><?php echo $xyz_smap_lnmessage_format;?></textarea> 
	</td></tr>
	
	<tr valign="top"><td>
	Pinterest message format for posting	<span class="mandatory">*</span>	<img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_pi')" onmouseout="dethide('xyz_pi')">
						<div id="xyz_pi" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.
							<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div>
		</td>
		<td>
		<select name="xyz_smap_premium_pi_info" id="xyz_smap_premium_pi_info" onchange="xyz_smap_premium_pi_info_insert(this)" >
		<option value ="0" selected>--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr><tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_pimessage"  name="xyz_smap_pimessage" style="height:80px;" ><?php echo $xyz_smap_pimessage_format;?></textarea> 
	</td></tr>
	
	<tr valign="top"><td>
	Google plus message format for posting	<span class="mandatory">*</span>	<img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_gp')" onmouseout="dethide('xyz_gp')">
						<div id="xyz_gp" class="informationdiv"
							style="display: none; font-weight: normal;"> 
							{POST_TITLE} - Insert the title of your post.<br />{PERMALINK} -
							Insert the URL where your post is displayed.<br />{POST_EXCERPT}
							- Insert the excerpt of your post.<br />{POST_CONTENT} - Insert
							the description of your post.<br />{BLOG_TITLE} - Insert the name
							of your blog.<br />{USER_NICENAME} - Insert the nicename
							of the author.<br />{POST_ID} - Insert the ID of your post.<br />
							{POST_TAGS} - Insert the tags of your post.<br />{POST_CATEGORY} - Insert the categories
							of your post.<br />{SHORTLINK} -
							Insert the short url where your post is displayed.
							<br /><b>Note:</b> You may limit the content of {POST_TITLE}, {POST_EXCERPT} & {POST_CONTENT} using below format.
							<br/>{POST_CONTENT<b>:L-2</b>} to use <b>2 lines</b> from content
							<br/>{POST_CONTENT<b>:W-3</b>} to use <b>3 words</b> from content
						</div>
		</td>
		<td>
		<select name="xyz_smap_premium_gp_info" id="xyz_smap_premium_gp_info" onchange="xyz_smap_premium_gp_info_insert(this)" >
		<option value ="0" selected>--Select--</option>
		<option value ="1">{POST_TITLE}  </option>
		<option value ="2">{PERMALINK} </option>
		<option value ="3">{POST_EXCERPT}  </option>
		<option value ="4">{POST_CONTENT}   </option>
		<option value ="5">{BLOG_TITLE}   </option>
		<option value ="6">{USER_NICENAME}   </option>
		<option value ="7">{POST_ID}    </option>
		<option value ="8">{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select> </td></tr><tr><td>&nbsp;</td><td>
		<textarea id="xyz_smap_gpmessage"  name="xyz_smap_gpmessage" style="height:80px;" ><?php echo $xyz_smap_gpmessage_format;?></textarea> 
	</td></tr>
	
	<tr valign="top">
	<td>Facebook default image url</td>
	<td>
	<input id="xyz_smap_fb_image_url"  name="xyz_smap_fb_image_url" type="text" value="<?php echo $xyz_smap_fb_image_url;?>" style="width: 375px">
	</td></tr>
	
	<tr valign="top">
	<td>Twitter default image url</td>
	<td>
	<input id="xyz_smap_tw_image_url"  name="xyz_smap_tw_image_url" type="text" value="<?php echo $xyz_smap_tw_image_url;?>" style="width: 375px">
	</td></tr>
	
	<tr valign="top">
	<td>Linkedin default image url</td>
	<td>
	<input id="xyz_smap_ln_image_url"  name="xyz_smap_ln_image_url" type="text" value="<?php echo $xyz_smap_ln_image_url;?>" style="width: 375px">
	</td></tr>
	
	<tr valign="top">
	<td>Pinterest default image url	<span class="mandatory">*</span></td>
	<td>
	<input id="xyz_smap_pi_image_url"  name="xyz_smap_pi_image_url" type="text" value="<?php echo $xyz_smap_pi_image_url;?>" style="width: 375px"> 
	</td></tr>
	
	<tr valign="top">
	<td>Google plus default image url</td>
	<td>
	<input id="xyz_smap_gp_image_url"  name="xyz_smap_gp_image_url" type="text" value="<?php echo $xyz_smap_gp_image_url;?>" style="width: 375px">
	</td></tr>
	<!-- 
	<tr valign="top">
	<td>Pinterest board matching pattern	<span class="mandatory">*</span></td>
	<td>
	<input id="xyz_smap_pi_board_pattern"  name="xyz_smap_pi_board_pattern" type="text" value="<?php echo $xyz_smap_pi_board_pattern;?>" style="width: 375px"> 
	<br>[Change this only if XYZ Scripts team asks to do so.]</td></tr>
	 -->
	
<tr valign="top">

<td scope="row" colspan="1">Cron command</td>
<td><span style="color: #21759B">
<?php 
echo 'wget -O /dev/null --quiet '.get_site_url().'/index.php?wp_smap=cron';
?></span>
</td></tr>


<tr valign="top">

<td scope="row" colspan="1">Cron interval for clearing logs	<span class="mandatory">*</span></td>
<td>
<input id="xyz_smap_clearlogs_interval"  name="xyz_smap_clearlogs_interval" type="text" value="<?php echo $xyz_smap_clearlogs_interval;?>"/>days 
	
</td></tr>

<tr valign="top">
	<td scope="row" colspan="1">Apply filters during publishing	</td>
	<td>
	<?php 
	$ar2=explode(",",$xyz_smap_apply_filters);
	for ($i=0;$i<3;$i++ ) {
		$filVal=$i+1;
		
		if($filVal==1)
			$filName='the_content';
		else if($filVal==2)
			$filName='the_excerpt';
		else if($filVal==3)
			$filName='the_title';
		else $filName='';
		
		echo '<input type="checkbox" name="xyz_smap_applyfilters[]"  value="'.$filVal.'" ';
		if(in_array($filVal, $ar2))
		{
			echo 'checked="checked"/>';
		}
		else
			echo '/>';
	
		echo '<label>'.$filName.'</label><br/>';
	
	}
	
	?>
	</td>
</tr>


<tr valign="top">

<td scope="row" colspan="1">Enable scheduling of automatic publishing	<span class="mandatory">*</span>	</td>
<td><select name="xyz_smap_task_type" id="xyz_smap_task_type" onchange="dispschedule()" >

<option value ="1" <?php if($xyz_smap_task_type=='1') echo 'selected'; ?> >Yes </option>

<option value ="2" <?php if($xyz_smap_task_type=='2') echo 'selected'; ?> >No </option>
</select>
</td></tr>


<tr valign="top" id="sh_post_publish_percron">

<td scope="row" >Max. no. of post to be processed per cron	<span class="mandatory">*</span>	</td>
<td>
<input id="xyz_smap_post_publish_percron"  name="xyz_smap_post_publish_percron" type="text" value="<?php echo $xyz_smap_post_publish_percron;?>"/> 
	
</td></tr>

<tr valign="top" id="sh_post_publish_timedelay">

<td scope="row" colspan="1">Min. time delay for publishing posts	<span class="mandatory">*</span>	</td>
<td>
<input id="xyz_smap_min_timedelay_post_publish_value"  name="xyz_smap_min_timedelay_post_publish_value" type="text" value="<?php echo $xyz_smap_min_timedelay_post_publish_value;?>"/>

<select name="xyz_smap_min_timedealy_post_publish_period" id="xyz_smap_min_timedealy_post_publish_period" >

<option value ="1" <?php if($xyz_smap_min_timedealy_post_publish_period=='1') echo 'selected'; ?> >Minutes </option>

<option value ="2" <?php if($xyz_smap_min_timedealy_post_publish_period=='2') echo 'selected'; ?> >Hours </option>

<option value ="3" <?php if($xyz_smap_min_timedealy_post_publish_period=='3') echo 'selected'; ?> >Days </option>
</select> 
</td></tr>
<tr valign="top" id="xyz_smap">

<td scope="row" colspan="1">Enable utf-8 decoding before publishing	<span class="mandatory">*</span>	
</td><td><select name="xyz_smap_premium_utf_decode" id="xyz_smap_premium_utf_decode" >

<option value ="1" <?php if($xyz_smap_premium_utf_decode==1) echo 'selected'; ?> >Yes </option>

<option value ="0" <?php if($xyz_smap_premium_utf_decode==0) echo 'selected'; ?> >No </option>
</select> 
</td></tr>

<tr valign="top" id="xyz_smap">

<td scope="row" colspan="1">Enable credit link to author	<span class="mandatory">*</span>	</td><td><select name="xyz_credit_link" id="xyz_credit_link" >

<option value ="smap" <?php if($xyz_credit_link=='smap') echo 'selected'; ?> >Yes </option>

<option value ="<?php echo $xyz_credit_link!='smap'?$xyz_credit_link:0;?>" <?php if($xyz_credit_link!='smap') echo 'selected'; ?> >No </option>
</select> 
</td></tr>

<tr>
 <td   id="bottomBorderNone">&nbsp;</td>
 <td   id="bottomBorderNone" style="height: 50px">
	<input type="submit" class="submit_smap_new" style=" margin-top: 10px;" name="bsettngs" value="Update Settings" />
 </td>
</tr>



</table></form>
</div>

<script type="text/javascript">
var catval='<?php echo $xyz_smap_premium_include_categories; ?>';
var custtypeval='<?php echo $xyz_smap_premium_include_customposttypes; ?>';
var get_opt_cats='<?php echo get_option('xyz_smap_premium_include_posts');?>';
jQuery(document).ready(function() {
 
	
	  if(catval=="All")
		  jQuery("#cat_dropdown_span").hide();
	  else
		  jQuery("#cat_dropdown_span").show();
	  if(get_opt_cats==0)
		  jQuery('#selPostCat_premium').hide();
	  else
		  jQuery('#selPostCat_premium').show();
	}); 
 	
function setcat(obj)
{
var sel_str="";
for(k=0;k<obj.options.length;k++)
{
if(obj.options[k].selected)
sel_str+=obj.options[k].value+",";
}


var l = sel_str.length; 
var lastChar = sel_str.substring(l-1, l); 
if (lastChar == ",") { 
	sel_str = sel_str.substring(0, l-1);
}

document.getElementById('xyz_smap_sel_cat').value=sel_str;

}

var d1='<?php echo $xyz_smap_premium_include_categories;?>';
splitText = d1.split(",");
jQuery.each(splitText, function(k,v) {
jQuery("#xyz_smap_catlist").children("option[value="+v+"]").attr("selected","selected");
});

function rd_cat_chn(act)
{ 
		if(act==-1)
		  jQuery("#cat_dropdown_span").hide();
		else
		  jQuery("#cat_dropdown_span").show();
}
function xyz_smap_premium_fb_info_insert(inf){
	
    var e = document.getElementById("xyz_smap_premium_fb_info");
    var ins_opt = e.options[e.selectedIndex].text;
    if(ins_opt=="0")
    	ins_opt="";
    var str=jQuery("textarea#xyz_smap_fbmessage").val()+ins_opt;
    jQuery("textarea#xyz_smap_fbmessage").val(str);
    jQuery('#xyz_smap_premium_fb_info :eq(0)').prop('selected', true);
    jQuery("textarea#xyz_smap_fbmessage").focus();

}
function xyz_smap_premium_tw_info_insert(inf){
	
    var e = document.getElementById("xyz_smap_premium_tw_info");
    var ins_opt = e.options[e.selectedIndex].text;
    if(ins_opt=="0")
    	ins_opt="";
    var str=jQuery("textarea#xyz_smap_twmessage").val()+ins_opt;
    jQuery("textarea#xyz_smap_twmessage").val(str);
    jQuery('#xyz_smap_premium_tw_info :eq(0)').prop('selected', true);
    jQuery("textarea#xyz_smap_twmessage").focus();

}
function xyz_smap_premium_ln_info_insert(inf){
	
    var e = document.getElementById("xyz_smap_premium_ln_info");
    var ins_opt = e.options[e.selectedIndex].text;
    if(ins_opt=="0")
    	ins_opt="";
    var str=jQuery("textarea#xyz_smap_lnmessage").val()+ins_opt;
    jQuery("textarea#xyz_smap_lnmessage").val(str);
    jQuery('#xyz_smap_premium_ln_info :eq(0)').prop('selected', true);
    jQuery("textarea#xyz_smap_lnmessage").focus();

}
function xyz_smap_premium_pi_info_insert(inf){
	
    var e = document.getElementById("xyz_smap_premium_pi_info");
    var ins_opt = e.options[e.selectedIndex].text;
    if(ins_opt=="0")
    	ins_opt="";
    var str=jQuery("textarea#xyz_smap_pimessage").val()+ins_opt;
    jQuery("textarea#xyz_smap_pimessage").val(str);
    jQuery('#xyz_smap_premium_pi_info :eq(0)').prop('selected', true);
    jQuery("textarea#xyz_smap_pimessage").focus();

}
function xyz_smap_premium_gp_info_insert(inf){
	
    var e = document.getElementById("xyz_smap_premium_gp_info");
    var ins_opt = e.options[e.selectedIndex].text;
    if(ins_opt=="0")
    	ins_opt="";
    var str=jQuery("textarea#xyz_smap_gpmessage").val()+ins_opt;
    jQuery("textarea#xyz_smap_gpmessage").val(str);
    jQuery('#xyz_smap_premium_gp_info :eq(0)').prop('selected', true);
    jQuery("textarea#xyz_smap_gpmessage").focus();

}
function xyz_smap_premium_show_postCategory(val)
{
	if(val==0)
		jQuery('#selPostCat_premium').hide();
	else
		jQuery('#selPostCat_premium').show();
}
dispschedule();
</script>
<?php 
?>