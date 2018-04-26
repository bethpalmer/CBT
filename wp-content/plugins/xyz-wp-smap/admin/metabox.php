<?php 

add_action( 'add_meta_boxes', 'xyz_smap_add_custom_premium_box' );

$GLOBALS['edit_flag']=0;
function xyz_smap_add_custom_premium_box()
{
	$posttype="";
	if(isset($_GET['post_type']))
	$posttype=$_GET['post_type'];
	
	if($posttype=="")
		$posttype="post";
	
	if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		$fb_metaArray=array();$tw_metaArray=array();$ln_metaArray=array();$pi_metaArray=array();$gp_metaArray=array();
		$postid=$_GET['post'];
		$get_post_meta=get_post_meta($postid,"xyz_smap",true);
	
		if($get_post_meta==1){
			$GLOBALS['edit_flag']=1;}
			
		global $wpdb;
		$table='posts';
		$accountCount = $wpdb->query( 'SELECT * FROM '.$wpdb->prefix.$table.' WHERE id="'.$postid.'" and post_status="publish" LIMIT 0,1' ) ;
		
		
		if($accountCount>0){
		$GLOBALS['edit_flag']=1;}
		$posttype=get_post_type($postid);
	
	}

	add_meta_box( "xyz_smap", 'XYZ Social Media Auto Publish ', 'xyz_smap_addpostmetatagspremium') ;
	
}

function xyz_smap_addpostmetatagspremium()
{
	
	$postid="";
	$posttype="";
	if(isset($_GET['post_type']))
		$posttype=$_GET['post_type'];
	
	if($posttype=="")
		$posttype="post";
	if(isset($_GET['action']) && $_GET['action']=="edit")
	{
		$postid=$_GET['post'];$posttype=get_post_type($postid);
	}
	
	$imgpath= plugins_url()."/xyz-wp-smap/admin/images/";
	$heimg=$imgpath."support.png";
	apply_filters('xyz_wp_smap_before_metabox',array('postid'=>$postid));	//filter to run addon codes
	
	?>
<script>
var fcheckid;
var tcheckid;
var lcheckid;

function displaycheck(id)
{
	if(document.getElementById("xyz_smap_post_fbpermission_"+id))
	{
		
		fcheckid=document.getElementById("xyz_smap_post_fbpermission_"+id).value;
		
		if(fcheckid==1)
		{
			document.getElementById("fpmd_"+id).style.display='';	
			document.getElementById("fpmf_"+id).style.display='';
			document.getElementById("fb_shareprivate_"+id).style.display='';
			document.getElementById("xyz_smap_fbmessage_textarea_"+id).style.display='';	
		}
		else
		{
			document.getElementById("fpmd_"+id).style.display='none';	
			document.getElementById("fpmf_"+id).style.display='none';
			document.getElementById("fb_shareprivate_"+id).style.display='none';
			document.getElementById("xyz_smap_fbmessage_textarea_"+id).style.display='none';	
		}
	}
	if(document.getElementById("xyz_smap_twpost_permission_"+id))
	{
		
		tcheckid=document.getElementById("xyz_smap_twpost_permission_"+id).value;
		if(tcheckid==1)
		{
			document.getElementById("xyz_smap_twpost_permission_"+id).value=1;
			document.getElementById("twmf_"+id).style.display='';
			document.getElementById("twai_"+id).style.display='';
			document.getElementById("xyz_smap_twmessage_textarea_"+id).style.display='';
		}
		else
		{
			document.getElementById("xyz_smap_twpost_permission_"+id).value=0;
			document.getElementById("twmf_"+id).style.display='none';
			document.getElementById("twai_"+id).style.display='none';
			document.getElementById("xyz_smap_twmessage_textarea_"+id).style.display='none';		
		}
	
	}
	if(document.getElementById("xyz_smap_post_lnpermission_"+id))
	{
		lcheckid=document.getElementById("xyz_smap_post_lnpermission_"+id).value;
		if(lcheckid==1)
		{

			document.getElementById("lnimg_"+id).style.display='';
			document.getElementById("lnmf_"+id).style.display='';	
			document.getElementById("shareprivate_"+id).style.display='';
			document.getElementById("share_post_profile_"+id).style.display='';
			document.getElementById("company_page_tr_"+id).style.display='';
			

			document.getElementById("xyz_smap_lnmessage_textarea_"+id).style.display='';	

			if(document.getElementById("xyz_smap_ln_share_post_profile_"+id))
				share_post_profile_drop_down(document.getElementById("xyz_smap_ln_share_post_profile_"+id).value,id);
		}
		else
		{
			document.getElementById("lnimg_"+id).style.display='none';
			document.getElementById("lnmf_"+id).style.display='none';	
			document.getElementById("shareprivate_"+id).style.display='none';
			document.getElementById("share_post_profile_"+id).style.display='none';
			document.getElementById("company_page_tr_"+id).style.display='none';
			
			document.getElementById("xyz_smap_lnmessage_textarea_"+id).style.display='none';
		}
	
	}
	if(document.getElementById("xyz_smap_post_pipermission_"+id))
	{
		
		pcheckid=document.getElementById("xyz_smap_post_pipermission_"+id).value;
		if(pcheckid==1)
		{		
			document.getElementById("pimf_"+id).style.display='';
			document.getElementById("pi_shareprivate_"+id).style.display='';
			document.getElementById("xyz_smap_pimessage_textarea_"+id).style.display='';	
		}
		else
		{	
			document.getElementById("pimf_"+id).style.display='none';
			document.getElementById("pi_shareprivate_"+id).style.display='none';
			document.getElementById("xyz_smap_pimessage_textarea_"+id).style.display='none';	
		}
	}
	if(document.getElementById("xyz_smap_post_gppermission_"+id))
	{
		
		gcheckid=document.getElementById("xyz_smap_post_gppermission_"+id).value;
		if(gcheckid==1)
		{	
			document.getElementById("gpmd_"+id).style.display='';				
			document.getElementById("gpmf_"+id).style.display='';
			document.getElementById("gp_shareprivate_"+id).style.display='';
			document.getElementById("xyz_smap_gpmessage_textarea_"+id).style.display='';	
		}
		else
		{	
			document.getElementById("gpmd_"+id).style.display='none';				
			document.getElementById("gpmf_"+id).style.display='none';
			document.getElementById("gp_shareprivate_"+id).style.display='none';
			document.getElementById("xyz_smap_gpmessage_textarea_"+id).style.display='none';	
		}
	}

	
}

function detdisplay(id)
{
	document.getElementById(id).style.display='';
}
function dethide(id)
{
	document.getElementById(id).style.display='none';
}

jQuery(document).ready(function() {

	jQuery('#category-all').bind("DOMSubtreeModified",function(){
		get_categorylist(1);
		});
	
	get_categorylist(1);
	jQuery('#category-all').on("click",'input[name="post_category[]"]',function() {
		get_categorylist(1);
				});

	jQuery('#category-pop').on("click",'input[type="checkbox"]',function() {
		get_categorylist(2);
				});

	
});

function get_categorylist(val)
{
	var cat_list="";
	if(val==1){
	 jQuery('input[name="post_category[]"]:checked').each(function() {
		 cat_list+=this.value+",";
		});
	}else if(val==2)
	{
		jQuery('#category-pop input[type="checkbox"]:checked').each(function() {
			
			cat_list+=this.value+",";
		});
	}
	 if (cat_list.charAt(cat_list.length - 1) == ',') {
		 cat_list = cat_list.substr(0, cat_list.length - 1);
		}
		jQuery('#cat_list').val(cat_list);

		metaboxbycategory();

}


var catListArray=new Array();
</script>
<table class="xyz_smap_premium_metalist_table">
<input type="hidden" name="cat_list" id="cat_list" value="">
<input type="hidden" name="xyz_smap_pre_post" id="xyz_smap_pre_post" value="0" >
<?php 
global $wpdb;$postid='';
$post_fb_permissin=$post_twitter_permission=$lnposting_permission=$piposting_permission=$gpposting_permission=get_option('xyz_smap_premium_default_selection_create_postORpage');
if(isset($_GET['post']))
	$postid=$_GET['post'];
$entries = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_fb_details WHERE xyz_smap_account_status=1 and xyz_smap_authorization_flag=0 ORDER BY id DESC" );
$fbacccount=count($entries);

$entries1 = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_tw_details WHERE xyz_smap_account_status=1 ORDER BY id DESC" );
$twacccount=count($entries1);

$entries2 = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_ln_details WHERE xyz_smap_account_status=1 and xyz_smap_authorization_flag=0 ORDER BY id DESC" );
$lnacccount=count($entries2);

$entries3 = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_pi_details WHERE xyz_smap_account_status=1 and xyz_smap_authorization_flag=0 ORDER BY id DESC" );
$piacccount=count($entries3);

$entries4 = $wpdb->get_results( "SELECT * FROM ".$wpdb->prefix."xyz_smap_gp_details WHERE xyz_smap_account_status=1 and xyz_smap_authorization_flag=0 ORDER BY id DESC" );
$gpacccount=count($entries4);

$get_post_meta_future_data=get_post_meta($postid,"xyz_smap_future_to_publish",true);
if(get_option('xyz_smap_premium_default_selection_edit')==1)
	$get_post_meta_future_data="";
	

if (!empty($get_post_meta_future_data))
{
	foreach ($get_post_meta_future_data as $key => $val)
	{
		$pos_fb = strpos($key, 'fb-');
		if ($pos_fb !== false)
			$fb_metaArray[$key]=$val;
		$pos_tw = strpos($key, 'tw-');
		if ($pos_tw !== false)
			$tw_metaArray[$key]=$val;
		$pos_ln = strpos($key, 'ln-');
		if ($pos_ln !== false)
			$ln_metaArray[$key]=$val;
		$pos_pi = strpos($key, 'pi-');
		if ($pos_pi !== false)
			$pi_metaArray[$key]=$val;
		$pos_gp = strpos($key, 'gp-');
		if ($pos_gp !== false)
			$gp_metaArray[$key]=$val;
	}
}


if($fbacccount>0){
?>

<tr><td colspan="2" valign="top">&nbsp;</td></tr>
<tr class="xyz_smap_premium_metalist_tr"><td colspan="2" valign="top" class="xyz_smap_premium_pleft10 xyz_smap_premium_meta_acc_heading_td" ><strong>Select facebook accounts for auto publish</strong></td></tr>

<?php 
}
foreach( $entries as $entry ) {

	$id=esc_html($entry->id);
	$appid=esc_html($entry->xyz_smap_application_id);
	$xyz_smap_fbapplication_name=esc_html($entry->xyz_smap_application_name);
	$appsecret=esc_html($entry->xyz_smap_application_secret);
	//$fbid=esc_html($entry->xyz_smap_fb_id);
	$posting_method=esc_html($entry->xyz_smap_po_method);
	$access_token=esc_html($entry->xyz_smap_access_token);
	$messagetopost=esc_textarea($entry->xyz_smap_message);
	$page_ids=esc_html($entry->xyz_smap_page_ids);
	$xyz_smap_authorization_flag=esc_html($entry->xyz_smap_authorization_flag);
	$xyz_smap_premium_fb_default_custtype_sel=esc_html($entry->xyz_smap_premium_fb_default_custtype_sel);
	$xyz_smap_premium_fb_include_posts= esc_html($entry->xyz_smap_premium_include_posts);
	$xyz_smap_premium_fb_include_pages=esc_html($entry->xyz_smap_premium_include_pages);
	$xyz_smap_premium_fb_default_includePage=esc_html($entry->xyz_smap_premium_default_includePage);
	$xyz_smap_premium_fb_include_customposttypes=esc_html($entry->xyz_smap_premium_fb_include_customposttypes);
	$xyz_smap_premium_fb_default_cat_sel=esc_html($entry->xyz_smap_premium_fb_default_cat_sel);
	$xyz_smap_premium_fb_include_categories=esc_html($entry->xyz_smap_premium_fb_include_categories);
	$xyz_smap_premium_fb_spec_cat=$entry->xyz_smap_premium_fb_spec_cat;
	
	
	$xyz_smap_premium_fb_catlist="";
	if($xyz_smap_premium_fb_default_cat_sel==1)
	{
		$xyz_smap_premium_fb_catlist=get_option('xyz_smap_premium_include_categories');
	}
	else if($xyz_smap_premium_fb_default_cat_sel==0)
	{
		if($xyz_smap_premium_fb_include_posts==1)
		{
			$xyz_smap_premium_fb_catlist=$xyz_smap_premium_fb_include_categories;
			if($xyz_smap_premium_fb_include_categories=="Specific")
				$xyz_smap_premium_fb_catlist=$xyz_smap_premium_fb_spec_cat;
		}
		
	}
	
	if($posttype=="post")
	{
		if($xyz_smap_premium_fb_default_cat_sel==1)
		{
			if(get_option('xyz_smap_premium_include_posts')==0)
				continue;
		}
		else if($xyz_smap_premium_fb_default_cat_sel==0)
		{
			if($xyz_smap_premium_fb_include_posts==0)
				continue;
		}
	}
	if($posttype=="page")
	{
		if($xyz_smap_premium_fb_default_includePage==1)
		{
			if(get_option('xyz_smap_premium_include_pages')==0)
				continue;
		}
		else if($xyz_smap_premium_fb_default_includePage==0)
		{
			if($xyz_smap_premium_fb_include_pages==0)
				continue;
		}
	}
	
	if($posttype!="post" && $posttype!="page")
	{
		if($xyz_smap_premium_fb_default_custtype_sel==1){
			$xyz_smap_premium_include_customposttypes=get_option('xyz_smap_premium_include_customposttypes');
		
			$carr=explode(',', $xyz_smap_premium_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		}
		else if($xyz_smap_premium_fb_default_custtype_sel==0)
		{
			
			$carr=explode(',', $xyz_smap_premium_fb_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		
		}
		
	}
	
	
	if (!empty($fb_metaArray))
	{
		foreach ($fb_metaArray as $key => $val)
		{
			$ac_id_fb=substr($key, 3);
	
			if($id==$ac_id_fb)
			{
				$post_fb_permissin=$val['post_permissin'];
				$posting_method= $val['post_method'];
				$messagetopost=$val['message'];
			}
		}
	
	}
	
	
?>

<script type="text/javascript" >
catListArray["fb_"+"<?php echo $id;?>"]="<?php echo $xyz_smap_premium_fb_catlist;?>";
</script>
<tr id="xyz_smap_premium_fb_metabox_<?php echo $id;?>"><td colspan="2" >

<table class="xyz_smap_premium_meta_acclist_table"><!-- FB META -->


<tr>
		<td colspan="2" class="xyz_smap_premium_pleft15 xyz_smap_premium_meta_acclist_table_td"><strong><?php echo $xyz_smap_fbapplication_name;?></strong>
		<input type="hidden" name="xyz_smap_fb_tableid[]" value="<?php echo $id;?>" >
		
		</td>
</tr>
	
	<tr><td colspan="2" valign="top">&nbsp;</td></tr>
	
	<tr valign="top">
		<td class="xyz_smap_premium_pleft15">Enable auto publish post to my facebook account
		</td>
		<td><select id="xyz_smap_post_fbpermission_<?php echo $id;?>" name="xyz_smap_post_fbpermission[]"
			onchange="displaycheck(<?php echo $id;?>)"><option value="0"
			<?php if($post_fb_permissin==0) echo 'selected';?>>
					No</option>
				<option value="1"
				<?php  if($post_fb_permissin==1) echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	
	<tr valign="top" id="fpmd_<?php echo $id;?>">
		<td class="xyz_smap_premium_pleft15">Posting method
		</td>
		<td>
		<select id="xyz_smap_po_method[]" name="xyz_smap_po_method[]">
							<option value="3"
				<?php  if($posting_method==3) echo 'selected';?>>Simple text message</option>
				
				<optgroup label="Text message with image">
					<option value="4"
					<?php  if($posting_method==4) echo 'selected';?>>Upload image to app album</option>
					<option value="5"
					<?php  if($posting_method==5) echo 'selected';?>>Upload image to timeline album</option>
				</optgroup>
				
				<optgroup label="Text message with attached link">
					<option value="1"
					<?php  if($posting_method==1) echo 'selected';?>>Attach
						your blog post</option>
					<option value="2"
					<?php  if($posting_method==2) echo 'selected';?>>
						Share a link to your blog post</option>
					</optgroup>
					</select>
		</td>
	</tr>
	
	<tr valign="top" id="fb_shareprivate_<?php echo $id;?>">
	<td class="xyz_smap_premium_pleft15" style="vertical-align: middle;">Share post to</td>
	<td style="padding: 6px !important;font-size: 14px;">
	<?php 
	$prof_p="";
	$seper_prof_page = strpos($page_ids, ',');
	if ($seper_prof_page !== false)
	{
		$app_share="";
		$prof_p=explode(',', $page_ids);
		$ar_cnt=count($prof_p);
		
		for($x=0;$x<$ar_cnt;$x++)
		{
			$pageid=substr($prof_p[$x],0,strpos($prof_p[$x],"-"));
			if($prof_p[$x]==-1)
				$app_share.="Profile ,";
			else 
				$app_share.="Page-ID : ".$pageid.",";
			
// 				$app_share.="Page-ID : ".$prof_p[$x].",";
			
		}
		$app_share=rtrim($app_share,',');
		echo $app_share;
	}
	else 
	{
		if($page_ids==-1) 
			echo "Profile";
		else 
		{
			$pageid1=substr($page_ids,0,strpos($page_ids,"-"));
			echo "Page-ID : ".$pageid1;
		}
	}
	?>
	</td></tr>
	
	<tr valign="top" id="fpmf_<?php echo $id;?>">
		<td class="xyz_smap_premium_pleft15">Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_fb_<?php echo $id;?>')" onmouseout="dethide('xyz_fb_<?php echo $id;?>')">
						<div id="xyz_fb_<?php echo $id;?>" class="informationdiv"
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
		</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
		<td>
			<select name="xyz_smap_premium_fb_info" id="xyz_smap_premium_fb_info_<?php echo $id;?>" onchange="xyz_smap_premium_fb_info_insert(this,<?php echo $id;?>)">
		<option value ="0" selected="selected">--Select--</option>
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
		</select> </td></tr>
		
		<tr id="xyz_smap_fbmessage_textarea_<?php echo $id;?>"><td>&nbsp;</td><td>
		<textarea id="xyz_smap_message_<?php echo $id;?>" name="xyz_smap_message[]"><?php echo $messagetopost;?></textarea>
		</td>
	</tr>
	
	</table></td></tr><!-- FB META -->
	
	<?php }
	if($twacccount>0){
	?>
	

<tr><td colspan="2" valign="top">&nbsp;</td></tr>
<tr class="xyz_smap_premium_metalist_tr"><td colspan="2" valign="top" class="xyz_smap_premium_pleft10 xyz_smap_premium_meta_acc_heading_td"><strong>Select twitter accounts for auto publish</strong></td></tr>
	
	<?php 
    }
	foreach( $entries1 as $entry ) {
    $tid=esc_html($entry->id);
	$xyz_smap_twapplication_name=esc_html($entry->xyz_smap_application_name);
	$tappid=esc_html($entry->xyz_smap_consumer_id);
	$tappsecret=esc_html($entry->xyz_smap_consumer_secret);
	$twid=esc_html($entry->xyz_smap_tw_id);
	$taccess_token=esc_html($entry->xyz_smap_access_token);
	$taccess_token_secret=esc_html($entry->xyz_smap_access_token_secret);
	$tposting_image_permission=esc_html($entry->xyz_smap_post_image_permission);
	$tmessagetopost=esc_textarea($entry->xyz_smap_message);
	$xyz_smap_premium_tw_default_custtype_sel=esc_html($entry->xyz_smap_premium_tw_default_custtype_sel);
	$xyz_smap_premium_tw_include_posts= esc_html($entry->xyz_smap_premium_include_posts);
	$xyz_smap_premium_tw_include_pages=esc_html($entry->xyz_smap_premium_include_pages);
	$xyz_smap_premium_tw_default_includePage=esc_html($entry->xyz_smap_premium_default_includePage);
	$xyz_smap_premium_tw_include_customposttypes=esc_html($entry->xyz_smap_premium_tw_include_customposttypes);
	$xyz_smap_premium_tw_default_cat_sel=esc_html($entry->xyz_smap_premium_tw_default_cat_sel);
	$xyz_smap_premium_tw_include_categories=esc_html($entry->xyz_smap_premium_tw_include_categories);
	$xyz_smap_premium_tw_spec_cat=$entry->xyz_smap_premium_tw_spec_cat;
	
	
	$xyz_smap_premium_tw_catlist="";
	if($xyz_smap_premium_tw_default_cat_sel==1)
	{
		$xyz_smap_premium_tw_catlist=get_option('xyz_smap_premium_include_categories');
	}
	else if($xyz_smap_premium_tw_default_cat_sel==0)
	{
		if($xyz_smap_premium_tw_include_posts==1)
		{
			$xyz_smap_premium_tw_catlist=$xyz_smap_premium_tw_include_categories;
			if($xyz_smap_premium_tw_include_categories=="Specific")
				$xyz_smap_premium_tw_catlist=$xyz_smap_premium_tw_spec_cat;
		}
	}
	if($posttype=="post")
	{
		if($xyz_smap_premium_tw_default_cat_sel==1)
		{
			if(get_option('xyz_smap_premium_include_posts')==0)
			continue;
		}
		else if($xyz_smap_premium_tw_default_cat_sel==0)
		{
			if($xyz_smap_premium_tw_include_posts==0)
				continue;
		}
	}
	if($posttype=="page")
	{
		if($xyz_smap_premium_tw_default_includePage==1)
		{
			if(get_option('xyz_smap_premium_include_pages')==0)
			continue;
		}
		else if($xyz_smap_premium_tw_default_includePage==0)
		{
			if($xyz_smap_premium_tw_include_pages==0)
				continue;
		}
	}
	if($posttype!="post" && $posttype!="page")
	{
		if($xyz_smap_premium_tw_default_custtype_sel==1){
			$xyz_smap_premium_include_customposttypes=get_option('xyz_smap_premium_include_customposttypes');
		
			$carr=explode(',', $xyz_smap_premium_include_customposttypes);
			
			if(!in_array($posttype,$carr))
				continue;
		}
		else if($xyz_smap_premium_tw_default_custtype_sel==0)
		{
			
			$carr=explode(',', $xyz_smap_premium_tw_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		
		}
	}
	
	if (!empty($tw_metaArray))
	{
		foreach ($tw_metaArray as $key => $val)
		{
			$ac_id_tw=substr($key, 3);
	
			if($tid==$ac_id_tw)
			{
				$post_twitter_permission= $val['post_twitter_permission'];
				$tposting_image_permission= $val['post_twitter_image_permission'];
				$tmessagetopost=$val['message'];
			}
		}
	
	}
	?>
	<script type="text/javascript">
	catListArray["tw_"+"<?php echo $tid;?>"]="<?php echo $xyz_smap_premium_tw_catlist;?>";
	</script>

	<tr id="xyz_smap_premium_tw_metabox_<?php echo $tid;?>"><td colspan="2" >
	
	<table class="xyz_smap_premium_meta_acclist_table"><!-- TW META -->

<tr>
		<td colspan="2" class="xyz_smap_premium_pleft15 xyz_smap_premium_meta_acclist_table_td"><strong><?php echo $xyz_smap_twapplication_name;?></strong>
		<input type="hidden" name="xyz_smap_tw_tableid[]" value="<?php echo $tid;?>" >
		</td>
	</tr>
	
	<tr><td colspan="2" valign="top">&nbsp;</td></tr>
	
	<tr valign="top">
		<td class="xyz_smap_premium_pleft15">Enable auto publish posts to my twitter account
		</td>
		<td><select id="xyz_smap_twpost_permission_<?php echo $tid;?>" name="xyz_smap_twpost_permission[]"
			onchange="displaycheck(<?php echo $tid;?>)">
				<option value="0"
				<?php if($post_twitter_permission==0) echo 'selected';?>>
					No</option>
				<option value="1"
				<?php if($post_twitter_permission==1) echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	
	<tr valign="top" id="twai_<?php echo $tid;?>">
		<td class="xyz_smap_premium_pleft15">Attach image to twitter post
		</td>
		<td><select id="xyz_smap_twpost_image_permission_<?php echo $tid;?>" name="xyz_smap_twpost_image_permission[]"
			onchange="displaycheck(<?php echo $tid;?>)">
				<option value="0"
				<?php  if($tposting_image_permission==0) echo 'selected';?>>
					No</option>
				<option value="1"
				<?php  if($tposting_image_permission==1) echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	
	<tr valign="top" id="twmf_<?php echo $tid;?>">
		<td class="xyz_smap_premium_pleft15">Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_tw_<?php echo $tid;?>')" onmouseout="dethide('xyz_tw_<?php echo $tid;?>')">
						<div id="xyz_tw_<?php echo $tid;?>" class="informationdiv"
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
		</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
		<td>
		<select name="xyz_smap_premium_tw_info" id="xyz_smap_premium_tw_info_<?php echo $tid;?>" onchange="xyz_smap_premium_tw_info_insert(this,<?php echo $tid;?>)">
		<option value ="0" selected="selected">--Select--</option>
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
		</select> </td></tr>
		
		<tr id="xyz_smap_twmessage_textarea_<?php echo $tid;?>"><td>&nbsp;</td><td>
		<textarea id="xyz_smap_twmessage_<?php echo $tid;?>" name="xyz_smap_twmessage[]"><?php echo $tmessagetopost;?></textarea>
		</td>
	</tr>
	
	
	</table></td></tr><!-- TW META -->
<?php }if($lnacccount>0){?>

<tr><td colspan="2" valign="top">&nbsp;</td></tr>
<tr class="xyz_smap_premium_metalist_tr"><td colspan="2" valign="top" class="xyz_smap_premium_pleft10 xyz_smap_premium_meta_acc_heading_td"><strong>Select linkedin accounts for auto publish</strong></td></tr>
	
<?php }
foreach( $entries2 as $entry ) {
	
	$lnid=esc_html($entry->id);
	$xyz_smap_lnapplication_name=esc_html($entry->xyz_smap_application_name);
	$lnappikey=esc_html($entry->xyz_smap_lnapikey);
	$lnapisecret=esc_html($entry->xyz_smap_lnapisecret);
	$lmessagetopost=esc_textarea($entry->xyz_smap_lnmessage);
	$lposting_image_permission=esc_html($entry->xyz_smap_post_image_permission);
	$xyz_smap_ln_share_post_profile=$entry->xyz_smap_ln_share_post_profile;
	
	$xyz_smap_ln_shareprivate=esc_html($entry->xyz_smap_ln_shareprivate);
	$xyz_smap_authorization_flag=esc_html($entry->xyz_smap_authorization_flag);
	$xyz_smap_premium_ln_default_custtype_sel=esc_html($entry->xyz_smap_premium_ln_default_custtype_sel);
	$xyz_smap_premium_ln_include_pages=esc_html($entry->xyz_smap_premium_include_pages);
	$xyz_smap_premium_ln_default_includePage=esc_html($entry->xyz_smap_premium_default_includePage);
	$xyz_smap_premium_ln_include_customposttypes=esc_html($entry->xyz_smap_premium_ln_include_customposttypes);
	$xyz_smap_ln_company_name=esc_html($entry->xyz_smap_ln_company_name);
	$xyz_smap_ln_company_id=esc_html($entry->xyz_smap_ln_company_id);
	$xyz_smap_premium_ln_include_posts= esc_html($entry->xyz_smap_premium_include_posts);
	$xyz_smap_premium_ln_default_cat_sel=esc_html($entry->xyz_smap_premium_ln_default_cat_sel);
	$xyz_smap_premium_ln_include_categories=esc_html($entry->xyz_smap_premium_ln_include_categories);
	$xyz_smap_premium_ln_spec_cat=$entry->xyz_smap_premium_ln_spec_cat;
	
	
	$xyz_smap_premium_ln_catlist="";
	if($xyz_smap_premium_ln_default_cat_sel==1)
	{
		$xyz_smap_premium_ln_catlist=get_option('xyz_smap_premium_include_categories');
	}
	else if($xyz_smap_premium_ln_default_cat_sel==0)
	{
		if($xyz_smap_premium_ln_include_posts==1)
		{
			$xyz_smap_premium_ln_catlist=$xyz_smap_premium_ln_include_categories;
			if($xyz_smap_premium_ln_include_categories=="Specific")
				$xyz_smap_premium_ln_catlist=$xyz_smap_premium_ln_spec_cat;
		}
	}
	if($posttype=="post")
	{
		if($xyz_smap_premium_ln_default_cat_sel==1)
		{
			if(get_option('xyz_smap_premium_include_posts')==0)
			continue;
		}
		else if($xyz_smap_premium_ln_default_cat_sel==0)
		{
			if($xyz_smap_premium_ln_include_posts==0)
				continue;
		}
	}
	if($posttype=="page")
	{
		if($xyz_smap_premium_ln_default_includePage==1)
		{
			if(get_option('xyz_smap_premium_include_pages')==0)
				continue;
		}
		else if($xyz_smap_premium_ln_default_includePage==0)
		{
			if($xyz_smap_premium_ln_include_pages==0)
				continue;
		}
	}
	if($posttype!="post" && $posttype!="page")
	{
	
		if($xyz_smap_premium_ln_default_custtype_sel==1){
			$xyz_smap_premium_include_customposttypes=get_option('xyz_smap_premium_include_customposttypes');
		
			$carr=explode(',', $xyz_smap_premium_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		}
		else if($xyz_smap_premium_ln_default_custtype_sel==0)
		{
			
			$carr=explode(',', $xyz_smap_premium_ln_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		
		}
	}
	
	if (!empty($ln_metaArray))
	{
		foreach ($ln_metaArray as $key => $val)
		{
			$ac_id_ln=substr($key, 3);
	
			if($lnid==$ac_id_ln)
			{
				$lnposting_permission= $val['lnposting_permission'];
				$lposting_image_permission= $val['xyz_smap_lnpost_image_permission'];
				$lmessagetopost=$val['message'];
			}
		}
	
	}
?>
<script type="text/javascript">
	catListArray["ln_"+"<?php echo $lnid;?>"]="<?php echo $xyz_smap_premium_ln_catlist;?>";
	</script>
<tr id="xyz_smap_premium_ln_metabox_<?php echo $lnid;?>"><td colspan="2" >

<table class="xyz_smap_premium_meta_acclist_table"><!-- LN META -->


<tr valign="top" >
		<td colspan="2" class="xyz_smap_premium_pleft15 xyz_smap_premium_meta_acclist_table_td"><strong><?php echo $xyz_smap_lnapplication_name;?></strong>
		<input type="hidden" name="xyz_smap_ln_tableid[]" value="<?php echo $lnid;?>" >
		
		</td>
	</tr>
	
	<tr><td colspan="2" valign="top">&nbsp;</td></tr>
	
	<tr valign="top">
		<td class="xyz_smap_premium_pleft15">Enable auto publish post to my linkedin account
		</td>
		<td><select id="xyz_smap_post_lnpermission_<?php echo $lnid;?>" name="xyz_smap_post_lnpermission[]"
			onchange="displaycheck(<?php echo $lnid;?>)"><option value="0"
			<?php if($lnposting_permission==0) echo 'selected';?>>
					No</option>
				<option value="1"
				<?php if($lnposting_permission==1) echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	
		<tr valign="top" id="lnimg_<?php echo $lnid;?>">
		<td class="xyz_smap_premium_pleft15">Attach image to linkedin post
		</td>
		<td><select id="xyz_smap_lnpost_image_permission_<?php echo $lnid;?>" name="xyz_smap_lnpost_image_permission[]"
			onchange="displaycheck(<?php echo $lnid;?>)">
				<option value="0"
				<?php  if($lposting_image_permission==0) echo 'selected';?>>
					No</option>
				<option value="1"
				<?php  if($lposting_image_permission==1) echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	
	
	<tr valign="top" id="share_post_profile_<?php echo $lnid;?>"><td class="xyz_smap_premium_pleft15" style="vertical-align: middle;">Share post to profile</td>
	
	<td style="padding: 6px !important;font-size: 14px;">
	<input id="xyz_smap_ln_share_post_profile_<?php echo $lnid;?>" name="xyz_smap_ln_share_post_profile[]" type="hidden" value="<?php echo $xyz_smap_ln_share_post_profile; ?>"/>
	
	<?php if($xyz_smap_ln_share_post_profile==0) {echo "Yes";}else {echo "No";}?>
	</td>
	</tr>
	
	<tr valign="top" id="shareprivate_<?php echo $lnid;?>">
	<td class="xyz_smap_premium_pleft15"  style="vertical-align: middle;">Share post content with</td>
	<td style="padding: 6px !important;font-size: 14px;">
	<input id="xyz_smap_ln_shareprivate_<?php echo $lnid;?>" name="xyz_smap_ln_shareprivate[]" type="hidden" value="<?php if($xyz_smap_ln_shareprivate==0) {echo "Public";} else {echo "Connections only";}?>"/>
	<?php if($xyz_smap_ln_shareprivate==0) {echo "Public";} else {echo "Connections only";}?>
	</td></tr>
	
	
	<tr valign="top" id="company_page_tr_<?php echo $lnid;?>"><td class="xyz_smap_premium_pleft15"  style="vertical-align: middle;">share post to company </td>
	<td style="padding: 6px !important;font-size: 14px;"><input id="xyz_smap_ln_company_name_<?php echo $lnid;?>" name="xyz_smap_ln_company_name" type="hidden" value="<?php echo $xyz_smap_ln_company_name;?>"/>
	<?php if($xyz_smap_ln_company_id==''){ echo "No";}else{ if($xyz_smap_ln_company_name!=''){ echo $xyz_smap_ln_company_name;} else { echo $xyz_smap_ln_company_id;}}?></td></tr>
	
	
	<tr valign="top" id="lnmf_<?php echo $lnid;?>">
		<td class="xyz_smap_premium_pleft15">Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_ln_<?php echo $lnid;?>')" onmouseout="dethide('xyz_ln_<?php echo $lnid;?>')">
						<div id="xyz_ln_<?php echo $lnid;?>" class="informationdiv"
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
						</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
					<td>
		 <select name="xyz_smap_premium_ln_info" id="xyz_smap_premium_ln_info_<?php echo $lnid;?>" onchange="xyz_smap_premium_ln_info_insert(this,<?php echo $lnid;?>)">
		<option value ="0" selected="selected">--Select--</option>
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
		</select></td> </tr>
		
		<tr id="xyz_smap_lnmessage_textarea_<?php echo $lnid;?>"><td>&nbsp;</td><td>
		<textarea id="xyz_smap_lnmessage_<?php echo $lnid;?>" name="xyz_smap_lnmessage[]"><?php echo $lmessagetopost;?></textarea>
		</td>
	</tr>
	
	</table></td></tr><!-- LN META -->
	<?php }if($piacccount>0){
	
	?>

<tr><td colspan="2" valign="top">&nbsp;</td></tr>
<tr class="xyz_smap_premium_metalist_tr"><td colspan="2" valign="top" class="xyz_smap_premium_pleft10 xyz_smap_premium_meta_acc_heading_td"><strong>Select pinterest accounts for auto publish</strong></td></tr>
	
<?php }

foreach( $entries3 as $entry ) {

	$pid=esc_html($entry->id);
	$xyz_smap_piapplication_name=esc_html($entry->xyz_smap_application_name);
	$xyz_smap_pimessage=esc_textarea($entry->xyz_smap_pimessage);
	$xyz_smap_premium_pi_default_custtype_sel=esc_html($entry->xyz_smap_premium_pi_default_custtype_sel);
	$xyz_smap_premium_pi_include_pages=esc_html($entry->xyz_smap_premium_include_pages);
	$xyz_smap_premium_pi_default_includePage=esc_html($entry->xyz_smap_premium_default_includePage);
	$xyz_smap_premium_pi_include_customposttypes=esc_html($entry->xyz_smap_premium_pi_include_customposttypes);
	$xyz_smap_premium_pi_include_posts= esc_html($entry->xyz_smap_premium_include_posts);
	$xyz_smap_premium_pi_board_ids=esc_html($entry->xyz_smap_pi_board_ids);
	$xyz_smap_premium_pi_default_cat_sel=esc_html($entry->xyz_smap_premium_pi_default_cat_sel);
	$xyz_smap_premium_pi_include_categories=esc_html($entry->xyz_smap_premium_pi_include_categories);
	$xyz_smap_premium_pi_spec_cat=$entry->xyz_smap_premium_pi_spec_cat;
	
	
	$xyz_smap_premium_pi_catlist="";
	if($xyz_smap_premium_pi_default_cat_sel==1)
	{
		$xyz_smap_premium_pi_catlist=get_option('xyz_smap_premium_include_categories');
	}
	else if($xyz_smap_premium_pi_default_cat_sel==0)
	{
		if($xyz_smap_premium_pi_include_posts==1)
		{
			$xyz_smap_premium_pi_catlist=$xyz_smap_premium_pi_include_categories;
			if($xyz_smap_premium_pi_include_categories=="Specific")
				$xyz_smap_premium_pi_catlist=$xyz_smap_premium_pi_spec_cat;
		}
	}
	if($posttype=="post")
	{
		if($xyz_smap_premium_pi_default_cat_sel==1)
		{
			if(get_option('xyz_smap_premium_include_posts')==0)
			continue;
		}
		else if($xyz_smap_premium_pi_default_cat_sel==0)
		{
			if($xyz_smap_premium_pi_include_posts==0)
				continue;
		}
	}
	if($posttype=="page")
	{
		if($xyz_smap_premium_pi_default_includePage==1)
		{
			if(get_option('xyz_smap_premium_include_pages')==0)
				continue;
		}
		else if($xyz_smap_premium_pi_default_includePage==0)
		{
			if($xyz_smap_premium_pi_include_pages==0)
				continue;
		}
	}
	if($posttype!="post" && $posttype!="page")
	{
	
		if($xyz_smap_premium_pi_default_custtype_sel==1){
			$xyz_smap_premium_include_customposttypes=get_option('xyz_smap_premium_include_customposttypes');
		
			$carr=explode(',', $xyz_smap_premium_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		}
		else if($xyz_smap_premium_pi_default_custtype_sel==0)
		{
			
			$carr=explode(',', $xyz_smap_premium_pi_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		
		}
	}
	
	if (!empty($pi_metaArray))
	{
		foreach ($pi_metaArray as $key => $val)
		{
			$ac_id_pi=substr($key, 3);
	
			if($pid==$ac_id_pi)
			{
				$piposting_permission=$val['piposting_permission'];
				$xyz_smap_pimessage=$val['message'];
			}
		}
	
	}
	?>
	<script type="text/javascript">
	catListArray["pi_"+"<?php echo $pid;?>"]="<?php echo $xyz_smap_premium_pi_catlist;?>";
	</script>
<tr id="xyz_smap_premium_pi_metabox_<?php echo $pid;?>"><td colspan="2" >

<table class="xyz_smap_premium_meta_acclist_table"><!-- PI META -->
	

<tr valign="top" >
		<td colspan="2" class="xyz_smap_premium_pleft15 xyz_smap_premium_meta_acclist_table_td"><strong><?php echo $xyz_smap_piapplication_name;?></strong>
		<input type="hidden" name="xyz_smap_pi_tableid[]" value="<?php echo $pid;?>" >
		
		</td>
	</tr>
	
	<tr><td colspan="2" valign="top">&nbsp;</td></tr>
	
	<tr valign="top">
		<td class="xyz_smap_premium_pleft15">Enable auto publish post to my pinterest account
		</td>
		<td><select id="xyz_smap_post_pipermission_<?php echo $pid;?>" name="xyz_smap_post_pipermission[]"
			onchange="displaycheck(<?php echo $pid;?>)"><option value="0"
			<?php if($piposting_permission==0)   echo 'selected';?>>
					No</option>
				<option value="1"
				<?php if($piposting_permission==1)   echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>
	<tr valign="top" id="pi_shareprivate_<?php echo $pid;?>">
	<td class="xyz_smap_premium_pleft15" style="vertical-align: middle;">Share post to board</td>
	<td style="padding: 6px !important;font-size: 14px;">
	<input id="xyz_smap_pi_shareprivate_<?php echo $pid;?>" name="xyz_smap_pi_shareprivate[]" type="hidden" value="<?php echo $xyz_smap_premium_pi_board_ids;?>" />
	<?php 
	echo "Board-ID : ".$xyz_smap_premium_pi_board_ids;
	?>
	</td></tr>
	<tr valign="top" id="pimf_<?php echo $pid;?>">
		<td class="xyz_smap_premium_pleft15">Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_pi_<?php echo $pid;?>')" onmouseout="dethide('xyz_pi_<?php echo $pid;?>')">
						<div id="xyz_pi_<?php echo $pid;?>" class="informationdiv"
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
						</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
					<td>
					<select name="xyz_smap_premium_pi_info" id="xyz_smap_premium_pi_info_<?php echo $pid;?>" onchange="xyz_smap_premium_pi_info_insert(this,<?php echo $pid;?>)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1" >{POST_TITLE}  </option>
		<option value ="2" >{PERMALINK} </option>
		<option value ="3" >{POST_EXCERPT}  </option>
		<option value ="4" >{POST_CONTENT}   </option>
		<option value ="5" >{BLOG_TITLE}   </option>
		<option value ="6" >{USER_NICENAME}   </option>
		<option value ="7" >{POST_ID}    </option>
		<option value ="8" >{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select></td> </tr>
		
		<tr id="xyz_smap_pimessage_textarea_<?php echo $pid;?>"><td>&nbsp;</td><td>
		<textarea id="xyz_smap_pimessage_<?php echo $pid;?>" name="xyz_smap_pimessage[]"><?php echo $xyz_smap_pimessage;?></textarea>
		</td>
	</tr>
	
	</table></td></tr><!-- PI META -->
	
	<?php }if($gpacccount>0){
	
	?>

<tr><td colspan="2" valign="top">&nbsp;</td></tr>
<tr class="xyz_smap_premium_metalist_tr"><td colspan="2" valign="top" class="xyz_smap_premium_pleft10 xyz_smap_premium_meta_acc_heading_td"><strong>Select google plus accounts for auto publish</strong></td></tr>
	
<?php }foreach( $entries4 as $entry ) {
	$page_flag=0;$prof_flag=0;
	$gid=esc_html($entry->id);
	$xyz_smap_gpapplication_name=esc_html($entry->xyz_smap_application_name);
	$xyz_smap_gpmessage=esc_textarea($entry->xyz_smap_gpmessage);
	$xyz_smap_gppost_method=esc_html($entry->xyz_smap_gppost_method);
	$xyz_smap_premium_gp_default_custtype_sel=esc_html($entry->xyz_smap_premium_gp_default_custtype_sel);
	$xyz_smap_premium_gp_include_pages=esc_html($entry->xyz_smap_premium_include_pages);
	$xyz_smap_premium_gp_default_includePage=esc_html($entry->xyz_smap_premium_default_includePage);
	$xyz_smap_premium_gp_include_customposttypes=esc_html($entry->xyz_smap_premium_gp_include_customposttypes);
	$xyz_smap_premium_gp_include_posts= esc_html($entry->xyz_smap_premium_include_posts);
	$xyz_smap_premium_gp_page_ids=esc_html($entry->xyz_smap_gp_pageid);
	$xyz_smap_premium_gp_default_cat_sel=esc_html($entry->xyz_smap_premium_gp_default_cat_sel);
	$xyz_smap_premium_gp_include_categories=esc_html($entry->xyz_smap_premium_gp_include_categories);
	$xyz_smap_premium_gp_spec_cat=$entry->xyz_smap_premium_gp_spec_cat;
	$xyz_smap_gp_email=$entry->xyz_smap_gp_email;
	$xyz_smap_gp_select_page_or_prof=$entry->xyz_smap_gp_select_page_or_prof;
	
	
	$xyz_smap_gp_page_or_prof_val_arr=explode(',', $xyz_smap_gp_select_page_or_prof);
	if(in_array(1, $xyz_smap_gp_page_or_prof_val_arr)==true)
		$page_flag=1;
	if(in_array(0, $xyz_smap_gp_page_or_prof_val_arr)==true)
		$prof_flag=1;
	
	$xyz_smap_premium_gp_catlist="";
	if($xyz_smap_premium_gp_default_cat_sel==1)
	{
		$xyz_smap_premium_gp_catlist=get_option('xyz_smap_premium_include_categories');
	}
	else if($xyz_smap_premium_gp_default_cat_sel==0)
	{
		if($xyz_smap_premium_gp_include_posts==1)
		{
			$xyz_smap_premium_gp_catlist=$xyz_smap_premium_gp_include_categories;
			if($xyz_smap_premium_gp_include_categories=="Specific")
				$xyz_smap_premium_gp_catlist=$xyz_smap_premium_gp_spec_cat;
		}
	}
	if($posttype=="post")
	{
		if($xyz_smap_premium_gp_default_cat_sel==1)
		{
			if(get_option('xyz_smap_premium_include_posts')==0)
			continue;
		}
		else if($xyz_smap_premium_gp_default_cat_sel==0)
		{
			if($xyz_smap_premium_gp_include_posts==0)
				continue;
		}
	}
	if($posttype=="page")
	{
		if($xyz_smap_premium_gp_default_includePage==1)
		{
			if(get_option('xyz_smap_premium_include_pages')==0)
				continue;
		}
		else if($xyz_smap_premium_gp_default_includePage==0)
		{
			if($xyz_smap_premium_gp_include_pages==0)
				continue;
		}
	}
	if($posttype!="post" && $posttype!="page")
	{
	
		if($xyz_smap_premium_gp_default_custtype_sel==1){
			$xyz_smap_premium_include_customposttypes=get_option('xyz_smap_premium_include_customposttypes');
		
			$carr=explode(',', $xyz_smap_premium_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		}
		else if($xyz_smap_premium_gp_default_custtype_sel==0)
		{
			
			$carr=explode(',', $xyz_smap_premium_gp_include_customposttypes);
			if(!in_array($posttype,$carr))
				continue;
		
		}
	}
	
	if (!empty($gp_metaArray))
	{
		foreach ($gp_metaArray as $key => $val)
		{
			$ac_id_gp=substr($key, 3);
	
			if($gid==$ac_id_gp)
			{
				$gpposting_permission= $val['gpposting_permission'];
				$xyz_smap_gppost_method= $val['xyz_smap_gppost_method'];
				$xyz_smap_gpmessage=$val['message'];
			}
		}
	
	}
	
	if (strpos($xyz_smap_gp_email, '@gmail.com') !== false)
		$profile_tag="Profile";
	else
		$profile_tag="Page-Profile";
	
	
	?>
	<script type="text/javascript">
	catListArray["gp_"+"<?php echo $gid;?>"]="<?php echo $xyz_smap_premium_gp_catlist;?>";
	</script>
	<tr id="xyz_smap_premium_gp_metabox_<?php echo $gid;?>"><td colspan="2" >
	
	<table class="xyz_smap_premium_meta_acclist_table"><!-- GP META -->
	
<tr valign="top" >
		<td colspan="2" class="xyz_smap_premium_pleft15 xyz_smap_premium_meta_acclist_table_td"><strong><?php echo $xyz_smap_gpapplication_name;?></strong>
		<input type="hidden" name="xyz_smap_gp_tableid[]" value="<?php echo $gid;?>" >
		
		</td>
	</tr>
	
	<tr><td colspan="2" valign="top">&nbsp;</td></tr>
	
	<tr valign="top">
		<td class="xyz_smap_premium_pleft15">Enable auto publish post to my google plus account
		</td>
		<td><select id="xyz_smap_post_gppermission_<?php echo $gid;?>" name="xyz_smap_post_gppermission[]"
			onchange="displaycheck(<?php echo $gid;?>)"><option value="0"
			<?php if($gpposting_permission==0)   echo 'selected';?>>
					No</option>
				<option value="1"
				<?php if($gpposting_permission==1)   echo 'selected';?>>Yes</option>
		</select>
		</td>
	</tr>	
	<tr valign="top" id="gpmd_<?php echo $gid;?>">
		<td class="xyz_smap_premium_pleft15">Posting method
		</td>
		<td>
		<select id="xyz_smap_gppost_method[]" name="xyz_smap_gppost_method[]">
		<option value="1" <?php if($xyz_smap_gppost_method==1){?>selected="selected"<?php }?>>Simple text message</option>
		<option value="2" <?php if($xyz_smap_gppost_method==2){?>selected="selected"<?php }?>>Text message with image</option>
		<option value="3" <?php if($xyz_smap_gppost_method==3){?>selected="selected"<?php }?>>Attach your blog post</option>
	
					</select>
		</td>
	</tr>
	
	<tr valign="top" id="gp_shareprivate_<?php echo $gid;?>">
	<td class="xyz_smap_premium_pleft15" style="vertical-align: middle;">Share post to</td>
	<td style="padding: 6px !important;font-size: 14px;">
	<input id="xyz_smap_gp_shareprivate_<?php echo $gid;?>" name="xyz_smap_gp_shareprivate[]" type="hidden" value="<?php if($xyz_smap_premium_gp_page_ids=="") {echo $profile_tag;} else {if($prof_flag==1 && $page_flag==1) {echo "Profile, Page-ID : ".$xyz_smap_premium_gp_page_ids;}else if($prof_flag==0 && $page_flag==1){echo "Page-ID : ".$xyz_smap_premium_gp_page_ids;}}?>"/>
	<?php if($xyz_smap_premium_gp_page_ids=="") {echo $profile_tag;} else {if($prof_flag==1 && $page_flag==1) {echo "Profile, Page-ID : ".$xyz_smap_premium_gp_page_ids;}else if($prof_flag==0 && $page_flag==1){echo "Page-ID : ".$xyz_smap_premium_gp_page_ids;}}?>
	</td></tr>
	
	
	<tr valign="top" id="gpmf_<?php echo $gid;?>">
		<td class="xyz_smap_premium_pleft15">Message format for posting <img src="<?php echo $heimg?>"
						onmouseover="detdisplay('xyz_gp_<?php echo $gid;?>')" onmouseout="dethide('xyz_gp_<?php echo $gid;?>')">
						<div id="xyz_gp_<?php echo $gid;?>" class="informationdiv"
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
						</div><br><span style="color: green;">[Leave this empty to use default value]</span></td>
					<td>
					<select name="xyz_smap_premium_gp_info" id="xyz_smap_premium_gp_info_<?php echo $gid;?>" onchange="xyz_smap_premium_gp_info_insert(this,<?php echo $gid;?>)">
		<option value ="0" selected="selected">--Select--</option>
		<option value ="1" >{POST_TITLE}  </option>
		<option value ="2" >{PERMALINK} </option>
		<option value ="3" >{POST_EXCERPT}  </option>
		<option value ="4" >{POST_CONTENT}   </option>
		<option value ="5" >{BLOG_TITLE}   </option>
		<option value ="6" >{USER_NICENAME}   </option>
		<option value ="7" >{POST_ID}    </option>
		<option value ="8" >{POST_TAGS}    </option>
		<option value ="9">{POST_CATEGORY}    </option>
		<option value ="10">{SHORTLINK}    </option>
		</select></td> </tr>
		<tr id="xyz_smap_gpmessage_textarea_<?php echo $gid;?>"><td>&nbsp;</td><td>
		<textarea id="xyz_smap_gpmessage_<?php echo $gid;?>" name="xyz_smap_gpmessage[]"><?php echo $xyz_smap_gpmessage;?></textarea>
		</td>
	</tr>
	
	
	</table></td></tr><!-- GP META -->
	
	<?php }?>
</table>
<script type="text/javascript">
				<?php 
foreach( $entries as $entry ) {
$id=$entry->id;
?>
	displaycheck(<?php echo $id;?>);<?php }
	
	foreach($entries1 as $entry ) {	
		$id=$entry->id;
	?>
	displaycheck(<?php echo $id;?>);<?php }
	foreach($entries2 as $entry ) {
		$id=$entry->id;
	?>
	displaycheck(<?php echo $id;?>);
	<?php }
foreach($entries3 as $entry ) {
		$id=$entry->id;?>
		displaycheck(<?php echo $id;?>);
		<?php }
foreach($entries4 as $entry ) {
		$id=$entry->id;?>
		displaycheck(<?php echo $id;?>);
		<?php }?>


		
		var edit_flag="<?php echo $GLOBALS['edit_flag'];?>";
		if(edit_flag==1)
			load_edit_action();
		
		function load_edit_action()
		{
			document.getElementById("xyz_smap_pre_post").value=1;
			var xyz_smap_premium_default_selection_edit="<?php echo get_option('xyz_smap_premium_default_selection_edit');?>";

			if(xyz_smap_premium_default_selection_edit=="")
				xyz_smap_premium_default_selection_edit=0;
			if(xyz_smap_premium_default_selection_edit==1 || xyz_smap_premium_default_selection_edit==2)
				return;
			
			//FB 
			<?php 
					foreach( $entries as $entry ) {
					$id=$entry->id;
					?>
					var id="<?php echo $id;?>";
					if(document.getElementById("xyz_smap_post_fbpermission_"+id))
					{
						document.getElementById("xyz_smap_post_fbpermission_"+id).value=0;
						document.getElementById("fpmd_"+id).style.display='none';	
						document.getElementById("fpmf_"+id).style.display='none';
						document.getElementById("fb_shareprivate_"+id).style.display='none';
						document.getElementById("xyz_smap_fbmessage_textarea_"+id).style.display='none';
					}

			<?php }?>
					
            //TW
			<?php 
					foreach( $entries1 as $entry ) {
					$id=$entry->id;
					?>
					var id="<?php echo $id;?>";
					if(document.getElementById("xyz_smap_twpost_permission_"+id))
					{
						document.getElementById("xyz_smap_twpost_permission_"+id).value=0;
						document.getElementById("twmf_"+id).style.display='none';
						document.getElementById("twai_"+id).style.display='none';
						document.getElementById("xyz_smap_twmessage_textarea_"+id).style.display='none';
					}

			<?php }?>

			//LN
			<?php 
					foreach( $entries2 as $entry ) {
					$id=$entry->id;
					?>
					var id="<?php echo $id;?>";
					if(document.getElementById("xyz_smap_post_lnpermission_"+id))
					{
						document.getElementById("xyz_smap_post_lnpermission_"+id).value=0;
						document.getElementById("lnimg_"+id).style.display='none';
						document.getElementById("lnmf_"+id).style.display='none';
						document.getElementById("shareprivate_"+id).style.display='none';

						document.getElementById("share_post_profile_"+id).style.display='none';
						document.getElementById("company_page_tr_"+id).style.display='none';
						
						document.getElementById("xyz_smap_lnmessage_textarea_"+id).style.display='none';
					}

			<?php }?>

			//PI
			<?php 
					foreach( $entries3 as $entry ) {
					$id=$entry->id;
					?>
					var id="<?php echo $id;?>";
					if(document.getElementById("xyz_smap_post_pipermission_"+id))
					{
						document.getElementById("xyz_smap_post_pipermission_"+id).value=0;			
						document.getElementById("pi_shareprivate_"+id).style.display='none';
						document.getElementById("pimf_"+id).style.display='none';
						document.getElementById("xyz_smap_pimessage_textarea_"+id).style.display='none';	
					}

				<?php }?>

			//GP
			<?php 
					foreach( $entries4 as $entry ) {
					$id=$entry->id;
					?>
					var id="<?php echo $id;?>";
					if(document.getElementById("xyz_smap_post_gppermission_"+id))
					{
						document.getElementById("xyz_smap_post_gppermission_"+id).value=0;
						document.getElementById("gpmd_"+id).style.display='none';				
						document.getElementById("gpmf_"+id).style.display='none';
						document.getElementById("gp_shareprivate_"+id).style.display='none';
						document.getElementById("xyz_smap_gpmessage_textarea_"+id).style.display='none';
					}

		<?php }?>
			
		}


		
		function xyz_smap_premium_fb_info_insert(inf,id){
			
		    var e = document.getElementById("xyz_smap_premium_fb_info_"+id);
		    var ins_opt = e.options[e.selectedIndex].text;
		    if(ins_opt=="0")
		    	ins_opt="";
		    var str=jQuery("textarea#xyz_smap_message_"+id).val()+ins_opt;
		    jQuery("textarea#xyz_smap_message_"+id).val(str);
		    jQuery('#xyz_smap_premium_fb_info_'+id+' :eq(0)').prop('selected', true);
		    jQuery("textarea#xyz_smap_message_"+id).focus();

		}
		function xyz_smap_premium_tw_info_insert(inf,id){
			
		    var e = document.getElementById("xyz_smap_premium_tw_info_"+id);
		    var ins_opt = e.options[e.selectedIndex].text;
		    if(ins_opt=="0")
		    	ins_opt="";
		    var str=jQuery("textarea#xyz_smap_twmessage_"+id).val()+ins_opt;
		    jQuery("textarea#xyz_smap_twmessage_"+id).val(str);
		    jQuery('#xyz_smap_premium_tw_info_'+id+' :eq(0)').prop('selected', true);
		    jQuery("textarea#xyz_smap_twmessage_"+id).focus();

		}
		function xyz_smap_premium_ln_info_insert(inf,id){
			
		    var e = document.getElementById("xyz_smap_premium_ln_info_"+id);
		    var ins_opt = e.options[e.selectedIndex].text;
		    if(ins_opt=="0")
		    	ins_opt="";
		    var str=jQuery("textarea#xyz_smap_lnmessage_"+id).val()+ins_opt;
		    jQuery("textarea#xyz_smap_lnmessage_"+id).val(str);
		    jQuery('#xyz_smap_premium_ln_info_'+id+' :eq(0)').prop('selected', true);
		    jQuery("textarea#xyz_smap_lnmessage_"+id).focus();

		}
		function xyz_smap_premium_pi_info_insert(inf,id){
			
		    var e = document.getElementById("xyz_smap_premium_pi_info_"+id);
		    var ins_opt = e.options[e.selectedIndex].text;
		    if(ins_opt=="0")
		    	ins_opt="";
		    var str=jQuery("textarea#xyz_smap_pimessage_"+id).val()+ins_opt;
		    jQuery("textarea#xyz_smap_pimessage_"+id).val(str);
		    jQuery('#xyz_smap_premium_pi_info_'+id+' :eq(0)').prop('selected', true);
		    jQuery("textarea#xyz_smap_pimessage_"+id).focus();

		}
		function xyz_smap_premium_gp_info_insert(inf,id){
			
		    var e = document.getElementById("xyz_smap_premium_gp_info_"+id);
		    var ins_opt = e.options[e.selectedIndex].text;
		    if(ins_opt=="0")
		    	ins_opt="";
		    var str=jQuery("textarea#xyz_smap_gpmessage_"+id).val()+ins_opt;
		    jQuery("textarea#xyz_smap_gpmessage_"+id).val(str);
		    jQuery('#xyz_smap_premium_gp_info_'+id+' :eq(0)').prop('selected', true);
		    jQuery("textarea#xyz_smap_gpmessage_"+id).focus();

		}


		function share_post_profile_drop_down(pass,id)
		{ 
				if(pass==0)
					jQuery("#shareprivate_"+id).show();
				else if(pass==1)
					jQuery("#shareprivate_"+id).hide();
		}

		function inArray(needle, haystack) {
		    var length = haystack.length;
		    for(var i = 0; i < length; i++) {
		        if(haystack[i] == needle) return true;
		    }
		    return false;
		}
		
		function metaboxbycategory(){
				
			var cat_list=jQuery('#cat_list').val();

			var posttype="<?php echo $posttype;?>";
			
			if(cat_list!=""){
				var cat_list_array=cat_list.split(',');
			for(var xyz_smap_key in catListArray) { 
				if(catListArray[xyz_smap_key]=="All")
				{
					continue;
				}
				else
				{
                    var test_var=catListArray[xyz_smap_key];test_var=test_var.toString();
					var catListArray_values=test_var.split(',');
					var show_flag=1;
					var acc_id=xyz_smap_key.substring(3);var acc_type=xyz_smap_key.slice(0,2);
					for(var i=0;i<catListArray_values.length;i++)
					{
						if(inArray(catListArray_values[i], cat_list_array))
						{
							show_flag=1;
							break;
						}
						else
						{
							show_flag=0;
							continue;
						}
						
					}

					if(show_flag==0 && posttype=="post")
						jQuery('#xyz_smap_premium_'+acc_type+'_metabox_'+acc_id).hide();
					else if(show_flag==1)
						jQuery('#xyz_smap_premium_'+acc_type+'_metabox_'+acc_id).show();
					
				}
				
				}
			}
			else
			{
				for(var xyz_smap_key in catListArray) {
					
					var acc_id=xyz_smap_key.substring(3);var acc_type=xyz_smap_key.slice(0,2);

					if(catListArray[xyz_smap_key]=="All")
						jQuery('#xyz_smap_premium_'+acc_type+'_metabox_'+acc_id).show();
					else if(posttype=="post")
						jQuery('#xyz_smap_premium_'+acc_type+'_metabox_'+acc_id).hide();
				}
				
			}

		}
		metaboxbycategory();

		
		
	</script>
	
	
<?php 
apply_filters('xyz_wp_smap_after_metabox',0);
}
?>