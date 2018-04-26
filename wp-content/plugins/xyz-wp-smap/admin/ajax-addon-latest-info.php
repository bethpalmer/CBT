<?php
add_action('wp_ajax_ajax_addon_update', 'xyz_wp_smap_ajax_addon_update');
function xyz_wp_smap_ajax_addon_update()
{
if(isset($_GET['code']))
 	 $addon_code=$_GET['code'];
if(isset($_GET['ver']))
	 $version=$_GET['ver'];

			//$url = "http://xyzscripts.com/product/changelog/XYZADMSTD";
$url = "http://xyzscripts.com/product/changelog_addon/".$addon_code;
				$update_data=wp_remote_get($url);

					if(is_array($update_data))
						{
							$update_data=$update_data['body'];
	
							preg_match_all('/<version no="(.+?)">(.+?)<\/version>/is', $update_data,$matches);
					        		$latest_ver=$matches[1][0];
	
									$update_str='';
										foreach ($matches[0] as $k => $v)
										{

											if($matches[1][$k]==$version)
												break;
							 						$update_str.=$v;
										}
				               				$items=$update_str;
						}

?>
				<br>
					 Latest version out there is : <b>	<?php	echo $latest_ver; ?></b>.
					 You are using version<b><?php echo $version; ?></b> of this addon.
					 <input  id="UpdateButton" type="button" name="UpdateButton" value="Get latest version" 
					 style="color:#FFFFFF;cursor:pointer;border-radius:4px;border:1px solid #1A87B9;margin-left:6px; margin-bottom:10px;background-color:#1A87B9;" 
					 onClick='top.window.location.href="<?php echo admin_url('admin.php?page=social-media-auto-publish-addons&action=update-addons&code='.$addon_code);?>"'>
					 <br>
					  Please find the changelog below.
					<br><br>

		<?php



		    $items=preg_replace("/<version(.+?)>/is", "<b>Version $1</b><br><br>", $items);
				$items=str_replace("</version>", "<br>", $items);
					$items=str_replace("<item>", "<b> * </b>", $items);
						$items=str_replace("</item>", "<br>", $items);
	
							echo $items;die;



}
//echo file_get_contents("http://xyzscripts.com/product/changelog/XYZADMSTD");




