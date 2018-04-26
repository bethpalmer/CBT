<?php
if(!function_exists('xyz_trim_deep'))
{

function xyz_trim_deep($value) {
	if ( is_array($value) ) {
		$value = array_map('xyz_trim_deep', $value);
	} elseif ( is_object($value) ) {
		$vars = get_object_vars( $value );
		foreach ($vars as $key=>$data) {
			$value->{$key} = xyz_trim_deep( $data );
		}
	} else {
		$value = trim($value);
	}

	return $value;
}

}

if(!function_exists('xyz_smap_premium_plugin_get_version'))
{
	function xyz_smap_premium_plugin_get_version()
	{
		if ( ! function_exists( 'get_plugins' ) )
			require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$plugin_folder = get_plugins( '/' . plugin_basename( dirname( XYZ_SMAP_PLUGIN_FILE_PREMIUM ) ) );
		return $plugin_folder['xyz-wp-smap.php']['Version'];
	}
}

if(!function_exists('esc_textarea'))
{
	function esc_textarea($text)
	{
		$safe_text = htmlspecialchars( $text, ENT_QUOTES );
		return $safe_text;
	}
}

if(!function_exists('xyz_smap_string_limit_premium'))
{
	function xyz_smap_string_limit_premium($string, $limit) {

		$space=" ";$appendstr=" ...";
		if(mb_strlen($string) <= $limit) return $string;
		if(mb_strlen($appendstr) >= $limit) return '';
		$string = mb_substr($string, 0, $limit-mb_strlen($appendstr));
		$rpos = mb_strripos($string, $space);
		if ($rpos===false)
			return $string.$appendstr;
		else
			return mb_substr($string, 0, $rpos).$appendstr;
	}
}

if(!function_exists('xyz_smap_premium_getimage'))
{
	function xyz_smap_premium_getimage($post_ID,$description_org,$xyz_smap_premium_image_preference)
	{
		$attachmenturl="";

		$image_preference=explode(',', $xyz_smap_premium_image_preference);
		foreach ($image_preference as $key=>$val)
		{
			$post_thumbnail_id = get_post_thumbnail_id( $post_ID );
			if($val==1){

				if($post_thumbnail_id!="")
				{
					$attachmenturl=wp_get_attachment_url($post_thumbnail_id);
					$attachmentimage=wp_get_attachment_image_src( $post_thumbnail_id, full );
					return $attachmenturl;
				}
			}

			 if($val==2)
			{
				//preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/is', $description_org, $matches);
				 preg_match_all( '/< *img[^>]*src *= *["\']?([^"\']*)/is', $description_org, $matches );

				if(isset($matches[1][0])){
					$attachmenturl = $matches[1][0];
					return $attachmenturl;
				}
			}

			if($val==3)
			{
				$xyz_smap_premium_image_metakey_name=esc_html(get_option('xyz_smap_premium_image_metakey_name'));
				if($xyz_smap_premium_image_metakey_name!=""){
					$attachmenturl=get_post_meta($post_ID,$xyz_smap_premium_image_metakey_name,true);
					if(isset( $attachmenturl[0]) && $attachmenturl[0]!='')
						return $attachmenturl[0];
				}
			}

			if($val==4)
			{
			    global $xyz_wp_smap_page_datas;
				$doc = new DOMDocument();
				@$doc->loadHTML($xyz_wp_smap_page_datas);
				$xpath = new DOMXPath($doc);
				$metaContentAttributeNodes = $xpath->query("/html/head/meta[@property='og:image']/@content");
				foreach($metaContentAttributeNodes as $metaContentAttributeNode) {
					$attachmenturl=$metaContentAttributeNode->nodeValue;return $attachmenturl;
				}
			}

		}
		return $attachmenturl;

	}
}





if(!function_exists('xyz_smap_premium_links')){
	function xyz_smap_premium_links($links, $file) {
		$base = plugin_basename(XYZ_SMAP_PLUGIN_FILE_PREMIUM);
		if ($file == $base) {
			if(get_option('xyz_smap_premium_latest_version')> xyz_smap_premium_plugin_get_version())
				$links[] = '<a href="'.get_admin_url().'admin-ajax.php?action=xyz_wp_smap_premium_update_info&width=640&height=596" id="xyz_update" class="thickbox" title="XYZ WP Social Media Auto Publish">' . __('Update available') . '</a>';

			$links[] = '<a href="http://kb.xyzscripts.com/wordpress-plugins/social-media-auto-publish/"  title="FAQ">FAQ</a>';
			$links[] = '<a href="http://docs.xyzscripts.com/wordpress-plugins/social-media-auto-publish/"  title="Read Me">README</a>';
			$links[] = '<a href="http://xyzscripts.com/support/" class="xyz_support" title="Support"></a>';
			$links[] = '<a href="http://twitter.com/xyzscripts" class="xyz_twitt" title="Follow us on Twitter"></a>';
			$links[] = '<a href="https://www.facebook.com/xyzscripts" class="xyz_fbook" title="Like us on Facebook"></a>';
			$links[] = '<a href="https://plus.google.com/+Xyzscripts" class="xyz_gplus" title="+1 us on Google+"></a>';
			$links[] = '<a href="http://www.linkedin.com/company/xyzscripts" class="xyz_linkedin" title="Follow us on LinkedIn"></a>';
		}
		return $links;
	}
}
add_filter( 'plugin_row_meta','xyz_smap_premium_links',10,2);

if (!function_exists("xyzsmap_substring")) {
	function xyzsmap_substring($string, $from, $to) {
		$fstart = stripos($string, $from); $tmp = substr($string,$fstart+strlen($from));$flen = stripos($tmp, $to);  return substr($tmp,0, $flen);
	}
}

if (!function_exists("xyzsmap_chkSSL")){
	function xyzsmap_chkSSL($url){
		$ch = curl_init($url); $headers = array(); $headers[] = 'Accept: text/html, application/xhtml+xml, */*';
		$headers[] = 'Cache-Control: no-cache';$headers[] = 'Connection: Keep-Alive'; $headers[] = 'Accept-Language: en-us';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0)");
		$content = curl_exec($ch); $err = curl_errno($ch); $errmsg = curl_error($ch);
		if ($err!=0) return array('errNo'=>$err, 'errMsg'=>$errmsg);
		 else
		 	return false;
	}
}

if (!function_exists("xyzsmap_getpage")){
		function xyzsmap_getpage($url, $ref='', $ctOnly=false, $fields='', $advSettings='',$ch=false) {

		if(!$ch)
		$ch = curl_init($url);
		else
			curl_setopt($ch, CURLOPT_URL, $url);

		$ccURL = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);
		static $curl_loops = 0; static $curl_max_loops = 20; global $xyzsmap_gCookiesArr;

		$cookies = '';
		if (is_array($xyzsmap_gCookiesArr))
		foreach ($xyzsmap_gCookiesArr as $cName=>$cVal)
			$cookies .= $cName.'='.$cVal.'; ';


		if ($curl_loops++ >= $curl_max_loops){
			$curl_loops = 0; curl_close($ch);return false;
		}
		$headers = array();

		if ($fields!='')
			$field_type="POST";
		else
		$field_type="GET";


		$headers[] = 'Cache-Control: max-age=0';
		$headers[] = 'Connection: Keep-Alive';
		$headers[]='Referer: '.$url;
		$headers[]='User-Agent: Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.22 Safari/537.36';
		if($field_type=='POST')
			$headers[]='Content-Type: application/x-www-form-urlencoded';

		if (isset($advSettings['liXMLHttpRequest'])) {
			$headers[] = 'X-Requested-With: XMLHttpRequest';
		}
		if (isset($advSettings['Origin'])) {
			$headers[] = 'Origin: '.$advSettings['Origin'];
		}
		if ($field_type=='GET')
			 $headers[]='Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8';
		else
			$headers[]='Accept: */*';

		$headers[]='Accept-Encoding: deflate,sdch';
		$headers[] = 'Accept-Language: en-US,en;q=0.8';



		if(isset($advSettings['noSSLSec'])){
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0); curl_setopt ($ch, CURLOPT_SSL_VERIFYPEER, 0);
		}

		if(isset($advSettings['proxy']) && $advSettings['proxy']['host']!='' && $advSettings['proxy']['port']!==''){
			curl_setopt($ch, CURLOPT_TIMEOUT, 4);  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 4);
			curl_setopt( $ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP ); curl_setopt( $ch, CURLOPT_PROXY, $advSettings['proxy']['host'] );
			curl_setopt( $ch, CURLOPT_PROXYPORT, $advSettings['proxy']['port'] );
			if ( isset($advSettings['proxy']['up']) && $advSettings['proxy']['up']!='' ) {
				curl_setopt( $ch, CURLOPT_PROXYAUTH, CURLAUTH_ANY ); curl_setopt( $ch, CURLOPT_PROXYUSERPWD, $advSettings['proxy']['up'] );
			}
		}
		if(isset($advSettings['headers'])){
			$headers = array_merge($headers, $advSettings['headers']);
		}
		curl_setopt($ch, CURLOPT_HEADER, true);     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_COOKIE, $cookies); curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);  if (is_string($ref) && $ref!='') curl_setopt($ch, CURLOPT_REFERER, $ref);
		curl_setopt($ch, CURLOPT_USERAGENT, (( isset( $advSettings['UA']) && $advSettings['UA']!='')?$advSettings['UA']:"Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/28.0.1500.44 Safari/537.36"));
		if ($fields!=''){
			curl_setopt($ch, CURLOPT_POST, true); curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		} else { curl_setopt($ch, CURLOPT_POST, false); curl_setopt($ch, CURLOPT_POSTFIELDS, '');  curl_setopt($ch, CURLOPT_HTTPGET, true);
		}
		curl_setopt($ch, CURLOPT_TIMEOUT, 60);  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
		$content = curl_exec($ch);
		$errmsg = curl_error($ch);  if (isset($errmsg) && stripos($errmsg, 'SSL')!==false) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);  $content = curl_exec($ch);
		}
		if (strpos($content, "\n\n")!=false && strpos($content, "\n\n")<100)
			$content = substr_replace($content, "\n", strpos($content,"\n\n"), strlen("\n\n"));
		if (strpos($content, "\r\n\r\n")!=false && strpos($content, "\r\n\r\n")<100)
			$content = substr_replace($content, "\r\n", strpos($content,"\r\n\r\n"), strlen("\r\n\r\n"));
		$ndel = strpos($content, "\n\n"); $rndel = strpos($content, "\r\n\r\n");
		if ($ndel==false) $ndel = 1000000; if ($rndel==false) $rndel = 1000000; $rrDel = $rndel<$ndel?"\r\n\r\n":"\n\n";
		list($header, $content) = explode($rrDel, $content, 2);
		if ($ctOnly!==true) {
			$fullresponse = curl_getinfo($ch); $err = curl_errno($ch); $errmsg = curl_error($ch); $fullresponse['errno'] = $err;
			$fullresponse['errmsg'] = $errmsg;  $fullresponse['headers'] = $header; $fullresponse['content'] = $content;
		}
		$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE); $headers = curl_getinfo($ch);

		if (empty($headers['request_header'])) $headers['request_header'] = 'Host: None'."\n";

		$results = array(); preg_match_all('|Host: (.*)\n|U', $headers['request_header'], $results);
		$ckDomain = str_replace('.', '_', $results[1][0]);  $ckDomain = str_replace("\r", "", $ckDomain);
		$ckDomain = str_replace("\n", "", $ckDomain);


		$results = array(); $cookies = '';  preg_match_all('|Set-Cookie: (.*);|U', $header, $results); $carTmp = $results[1];
		preg_match_all('/Set-Cookie: (.*)\b/', $header, $xck); $xck = $xck[1];
		//$clCook = array();
		if (isset($advSettings['cdomain']) &&  $advSettings['cdomain']!=''){
			foreach ($carTmp as $iii=>$cTmp)
				 if (stripos($xck[$iii],'Domain=')===false || stripos($xck[$iii],'Domain=.'.$advSettings['cdomain'].';')!==false){
				$temp = explode('=',$cTmp,2); $xyzsmap_gCookiesArr[$temp[0]]=$temp[1];
			}
		}
		else {
		 	foreach ($carTmp as $cTmp){
				$temp = explode('=',$cTmp,2);
				 $xyzsmap_gCookiesArr[$temp[0]]=$temp[1];
		    }
		}

		/*foreach ($carTmp as $cTmp){
			$temp = explode('=',$cTmp,2);
		}*/

		$rURL = '';

		if ($http_code == 200 && stripos($content, 'http-equiv="refresh" content="0; url=&#39;')!==false ) {
			$http_code=301; $rURL = xyzsmap_substring($content, 'http-equiv="refresh" content="0; url=&#39;','&#39;"');
			 $xyzsmap_gCookiesArr = array();
		}
		elseif ($http_code == 200 && stripos($content, 'location.replace')!==false ) {
			$http_code=301; $rURL = xyzsmap_substring($content, 'location.replace("','"');
		}
		if ($http_code == 301 || $http_code == 302 || $http_code == 303){
			if ($rURL!='') {
				$rURL = str_replace('\x3d','=',$rURL); $rURL = str_replace('\x26','&',$rURL);
				$url = @parse_url($rURL);
			} else { $matches = array(); preg_match('/Location:(.*?)\n/', $header, $matches); $url = @parse_url(trim(array_pop($matches)));
			} $rURL = '';
			if (!$url){
				$curl_loops = 0;curl_close($ch); return ($ctOnly===true)?$content:$fullresponse;
			}
			$last_urlX = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL); $last_url = @parse_url($last_urlX);
			if (!$url['scheme']) $url['scheme'] = $last_url['scheme'];  if (!$url['host']) $url['host'] = $last_url['host'];
			if (!$url['path']) $url['path'] = $last_url['path']; if (!isset($url['query'])) $url['query'] = '';
			$new_url = $url['scheme'] . '://' . $url['host'] . $url['path'] . ($url['query']?'?'.$url['query']:'');
			 return xyzsmap_getpage($new_url, $last_urlX, $ctOnly, '', $advSettings, $ch);
		} else { $curl_loops=0;curl_close($ch); return ($ctOnly===true)?$content:$fullresponse;
		}
	}
}

if (!function_exists("xyz_folder_copy")) {
	function xyz_folder_copy($source, $dest)
	{
		if (is_file($source)) {
			return copy($source, $dest);
		}
		if (!is_dir($dest)) {
			mkdir($dest);
		}
		$dir = dir($source);
		while (false !== $entry = $dir->read()) {
			if ($entry == '.' || $entry == '..') {
				continue;
			}
			if ($dest !== "$source/$entry") {
				xyz_folder_copy("$source/$entry", "$dest/$entry");
			}
		}
		$dir->close();
		return 1;
	}
}
if (!function_exists("xyz_folder_delete")) {
	function xyz_folder_delete($path)
	{
		if (is_dir($path) === true)
		{
			$files = array_diff(scandir($path), array('.', '..'));
			foreach ($files as $file)
			{
				xyz_folder_delete(realpath($path) . '/' . $file);
			}
			return rmdir($path);
		}
		else if (is_file($path) === true)
		{
			return unlink($path);
		}
		return false;
	}
}


if (!function_exists("xyzsmap_build_http_query")) {
	function xyzsmap_build_http_query( $query ){
		$query_array = array(); foreach( $query as $key => $key_value ){
			$query_array[] = $key . '=' . urlencode( $key_value );
		} return implode( '&', $query_array );
	}
}
if (!function_exists("xyzsmap_rndString")) {
	function xyzsmap_rndString($lngth){
		$str='';$chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";$size=strlen($chars);for($i=0;$i<$lngth;$i++){
			$str .= $chars[rand(0,$size-1)];
		} return $str;
	}
}
if (!function_exists("xyzsmap_process_json")) {
	function xyzsmap_process_json($gson){
		$json = substr($gson, 5);
		$json = str_replace(',{',',{"',$json);
		$json = str_replace(':[','":[',$json);
		$json = str_replace(',{""',',{"',$json);
		$json = str_replace('"":[','":[',$json);
		$json = str_replace('[,','["",',$json);
		$json = str_replace(',,',',"",',$json);
		$json = str_replace(',,',',"",',$json); return $json;
	}
}

if (!function_exists("xyz_smap_remove_chars")){ function xyz_smap_remove_chars($fn){$sch = array("?", "[", "]", "/", "\\", "=", "<", ">", ":", ";", ",", "'", "\"", "&", "$", "#", "*", "(", ")", "|", "~", "`", "!", "{", "}");
return trim(preg_replace('/[\s-]+/', '-', str_replace($sch, '', $fn)), '.-_');
}}
if (!function_exists("xyz_smap_get_img_name")){ function xyz_smap_get_img_name($fn, $cType){ $iex = array(".png", ".jpg", ".gif", ".jpeg"); $map = array('image/gif'=>'.gif','image/jpeg'=>'.jpg','image/png'=>'.png');
$fn = str_replace($iex, '', $fn); if (isset($map[$cType])){return $fn.$map[$cType];} else return $fn.".jpg";
}}

/* Local time Insert */
if(!function_exists('xyz_local_date_time_create')){
	function xyz_local_date_time_create($timestamp){
		return $timestamp - ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS );
	}
}

/* Local time formating */
if(!function_exists('xyzsmap_local_date_time')){
	function xyzsmap_local_date_time($format,$timestamp){
		return date($format, $timestamp + ( get_option( 'gmt_offset' ) * HOUR_IN_SECONDS ));
	}
}

if (!function_exists("xyz_smap_premium_add_hash_tag")) {

	function xyz_smap_premium_add_hash_tag($str,$search)
	{
		$str = str_replace(array("\r\n","\n\r","\r"), "\n", $str);
		$str1=explode(' ', $str);

		foreach ($str1 as $key=>$val)
		{

			$str2=explode("\n", $val);
			foreach ($str2 as $key2=>$val2)
			{
				$str2[$key2]=xyz_smap_premium_str_split_search(',',$val2,$search);
				$str2[$key2]=xyz_smap_premium_str_split_search('.',$str2[$key2],$search);
				$str2[$key2]=xyz_smap_premium_str_split_search(';',$str2[$key2],$search);
			}

			$str2=implode("\n",$str2);

			$str1[$key]=$str2;
		}

		$str1=implode(' ',$str1);
		return $str1;
	}

}

if (!function_exists("xyz_smap_premium_str_split_search")) {

	function xyz_smap_premium_str_split_search($ch,$str,$search)
	{
		$str1=explode($ch, $str);
		foreach ($str1 as $key=>$value)
		{


			if(ctype_alnum($value)){

				if(xyz_smap_premium_in_arrayi($value, $search))
				{
					$str1[$key]="#".$value;
				}

			}
		}
		$str1=implode($ch, $str1);return $str1;
	}

}

if (!function_exists("xyz_smap_premium_in_arrayi")) {

	function xyz_smap_premium_in_arrayi($needle, $haystack)//case insensitive
	{
		foreach ($haystack as $value)
		{
			if (strtolower($value) == strtolower($needle))
				return true;
		}
		return false;
	}

}


if (!function_exists("xyz_smap_premium_facebook_publish")) {

	function xyz_smap_premium_facebook_publish($useracces_token,$appsecret,$appid,$fbstatus,$description,$content_title,$content_desc,$xyz_smap_pages_ids,$user_page_id, $name, $message, $caption,$link, $excerpt, $user_nicename, $post_ID, $post_tags, $POST_CATEGORY,$search,$attachmenturl,$posting_method,$shortlink,$reg_exUrl,$xyz_smap_premium_fb_pref_link_sel)
	{
			$descriptionfb_li=xyz_smap_string_limit_premium($description, 10000);
		
			$utf="UTF-8";
				
				if($xyz_smap_pages_ids=="")
					$xyz_smap_pages_ids=-1;
				$xyz_smap_pages_ids1=explode(",",$xyz_smap_pages_ids);
				$fb_publish_status=array();$fb_publish_status_array=array();
// 				$fb_publish_status[$page_id."/albums"]="";
// 				$disp_type="feed";
				$fb_publish_status['status_msg']="";
				
				foreach ($xyz_smap_pages_ids1 as $key=>$value)
				{
					if($value!=-1)
					{
						$value1=explode("-",$value);
						$acces_token=$value1[1];$page_id=$value1[0];
					}
					else
					{
						$acces_token=$useracces_token;$page_id=$user_page_id;
					}

					
					$fb=new Facebook\Facebook(array(
							'app_id'  => $appid,
							'app_secret' => $appsecret,
							'default_graph_version' => XYZ_SMAP_FB_API_VERSION,
  							'cookie' => true
					));
					//$fb=new SMAPFacebook();
					$message1=xyz_smap_premium_split_replace('{POST_TITLE}', $name, $message);
					$message2=str_replace('{BLOG_TITLE}', $caption,$message1);
					$message3=str_replace('{PERMALINK}', $link, $message2);
					$message4=xyz_smap_premium_split_replace('{POST_EXCERPT}', $excerpt, $message3);
					$message5=xyz_smap_premium_split_replace('{POST_CONTENT}', $description, $message4);
					$message5=str_replace('{USER_NICENAME}', $user_nicename, $message5);
					$message5=str_replace('{POST_ID}', $post_ID, $message5);
					$message5=str_replace('{POST_TAGS}', $post_tags, $message5);
					$message5=str_replace('{POST_CATEGORY}', $POST_CATEGORY, $message5);
					$message5=str_replace('{SHORTLINK}', $shortlink, $message5);
					
					$message5=str_replace("&nbsp;","",$message5);
					
					
					$message5=xyz_smap_premium_add_hash_tag($message5,$search);
									
					$disp_type="feed";
					
					$fb_image_url=get_option('xyz_smap_fb_image_url');
					
					if($attachmenturl!="")
						$fb_image_url=$attachmenturl;
					
					
					$content_desc=xyz_smap_string_limit_premium($content_desc, 10000);
					
					if($content_title=="")
						$content_title=$name;
					if(get_option('xyz_smap_premium_utf_decode')==1)
						$content_title=utf8_decode($content_title);
// 					if(strcmp(get_option('blog_charset'),$utf)==0)
// 						$content_title=utf8_decode($content_title);
					if($content_desc=="")
						$content_desc=$descriptionfb_li;
					if(get_option('xyz_smap_premium_utf_decode')==1)
						$content_desc=utf8_decode($content_desc);
// 					if(strcmp(get_option('blog_charset'),$utf)==0)
// 						$content_desc=utf8_decode($content_desc);
					
					$url_fb=array();
					preg_match($reg_exUrl, $message5, $url_fb);              //link from content
					
					if($posting_method==1) //attach
					{
						
						$attachment = array('message' => $message5,
								'access_token' => $acces_token,
								'link' => $link,
								'name' => $content_title,
								'caption' => $caption,
								'description' => $content_desc,
								'actions' => json_encode(array('name' => $content_title,
										'link' => $link)),
								'picture' => $fb_image_url

						);
					}
					else if($posting_method==2)  //share link
					{
						$attachment = array('message' => $message5,
								'access_token' => $acces_token,
								'link' => $link,
								'name' => $content_title,
								'caption' => $caption,
								'description' => $content_desc,
								'picture' => $fb_image_url


						);
					}
					else if($posting_method==3) //simple text message
					{
						
						$attachment = array('message' => $message5,
								'access_token' => $acces_token
									
						);
							
					}
					else if($posting_method==4 || $posting_method==5) //text message with image 4 - app album, 5-timeline
					{
						
						
						if($fb_image_url!="")
						{
					
							if($posting_method==5)
							{
									try{
								$albums = $fb->get("/$page_id/albums", array('access_token'  => $acces_token));
								
								$fb_publish_status['status_msg'].="<span style=\"color:green\">".$page_id."/albums : Success.</span>";
									
							}
								catch (Exception $e)
								{
									$fb_publish_status['status_msg'].="<span style=\"color:red\">".$page_id."/albums : ".$e->getMessage().".</span>";
								}
									
								foreach ($albums["data"] as $album) {
									if ($album["type"] == "wall") {
										$timeline_album = $album; break;
									}
								}
								if (isset($timeline_album) && isset($timeline_album["id"])) $page_id = $timeline_album["id"];
							}
					
					
							$disp_type="photos";
							$attachment = array('message' => $message5,
									'access_token' => $acces_token,
									'url' => $fb_image_url
					
							);
						}
						else
						{
							$attachment = array('message' => $message5,
									'access_token' => $acces_token
					
							);
						}
							
					}
					
				   if($posting_method==1 || $posting_method==2)
					{
						if($xyz_smap_premium_fb_pref_link_sel==1)
						{
						if(count($url_fb)>0)
							$attachment=xyz_wp_smap_facebook_attachment_metas($attachment,$url_fb[0]);
						}
					    else if($xyz_smap_premium_fb_pref_link_sel==0)
					    {
					    	$attachment=xyz_wp_smap_facebook_attachment_metas($attachment,$link);
					    }
				   }
					
					try{
					$result = $fb->post('/'.$page_id.'/'.$disp_type.'/', $attachment);
					
					$fb_publish_status['status_msg'].="<span style=\"color:green\">".$page_id."/".$disp_type." : Success.</span>";
				}
					catch (Exception $e)
					{
						$fb_publish_status['status_msg'].="<span style=\"color:red\">".$page_id."/".$disp_type." : ".$e->getMessage().".</span>";
					}
					
				}
				
				if(isset($fb_publish_status['status_msg']))
					$fb_publish_status_array=$fb_publish_status['status_msg'];
				
				
				
				
			if(count($fb_publish_status_array)>0)
				$fb_publish_status_insert=serialize($fb_publish_status_array);
			else
				$fb_publish_status_insert=1;
				
			return $fb_publish_status_insert;
			
		
	}

}




if (!function_exists("xyz_smap_premium_twitter_publish")) {

	function xyz_smap_premium_twitter_publish($taccess_token,$taccess_token_secret,$tappid,$tappsecret,$twstatus,$attachmenturl,$post_twitter_image_permission,$messagetopost,$description,$name, $caption,$link, $excerpt, $user_nicename, $post_ID, $post_tags,$POST_CATEGORY,$search,$shortlink,$reg_exUrl)
	{
		
		
		if($attachmenturl!="" || get_option('xyz_smap_tw_image_url')!="")
			$image_found=1;
		else
			$image_found=0;
		
		$img_status="";
		if($post_twitter_image_permission==1)
		{
		
			$img=array();
		
			$tw_image_url=get_option('xyz_smap_tw_image_url');
		
			if($attachmenturl!="")
				$tw_image_url=$attachmenturl;
		
			if($tw_image_url!="")
				$img = wp_remote_get($tw_image_url);
		
		
			if(is_array($img))
			{
		
				if (isset($img['body']) && trim($img['body'])!='')
				{
					$image_found = 1;
					if (($img['headers']['content-length']) && trim($img['headers']['content-length'])!='')
					{
						$img_size=$img['headers']['content-length']/(1024*1024);
						if($img_size>3){
							$image_found=0;$img_status="Image skipped(greater than 3MB)";
						}
					}
		
					$img = $img['body'];
		
				}
				else
					$image_found = 0;
			}
		
		}
		///Twitter upload image end/////
		
		$messagetopost=str_replace("&nbsp;","",$messagetopost);
		
		
		// 				preg_match_all("/{(.+?)}/i",$messagetopost,$matches);
		// 				$matches1=$matches[1];
		$substring="";$islink=0;$issubstr=0;
		
		$substring=xyz_smap_premium_split_replace('{POST_TITLE}', $name, $messagetopost);
		$substring=str_replace('{BLOG_TITLE}', $caption,$substring);
		$substring=str_replace('{PERMALINK}', $link, $substring);
		$substring=xyz_smap_premium_split_replace('{POST_EXCERPT}', $excerpt, $substring);
		$substring=xyz_smap_premium_split_replace('{POST_CONTENT}', $description, $substring);
		$substring=str_replace('{USER_NICENAME}', $user_nicename, $substring);
		$substring=str_replace('{POST_ID}', $post_ID, $substring);
		$substring=str_replace('{POST_TAGS}', $post_tags, $substring);
		$substring=str_replace('{POST_CATEGORY}', $POST_CATEGORY, $substring);
		$substring=str_replace('{SHORTLINK}', $shortlink, $substring);
		
		preg_match_all($reg_exUrl,$substring,$matches); // @ is same as /
		if(is_array($matches) && isset($matches[0]))
		{
			$matches=$matches[0];
			$final_str='';
			$len=0;
			$tw_max_len=140;
			if($image_found==1)
				$tw_max_len=140-24;
			
			foreach ($matches as $key=>$val)
			{
				if(substr($val,0,5)=="https")
					$url_max_len=23;//23 for https and 22 for http
				else
					$url_max_len=22;//23 for https and 22 for http
		
				$messagepart=mb_substr($substring, 0, mb_strpos($substring, $val));
				if(mb_strlen($messagepart)>($tw_max_len-$len))
				{
					$final_str.=mb_substr($messagepart,0,$tw_max_len-$len-3)."...";
					$len+=($tw_max_len-$len);
					break;
				}
				else
				{
					$final_str.=$messagepart;
					$len+=mb_strlen($messagepart);
				}
		
				$cur_url_len=mb_strlen($val);
				if(mb_strlen($val)>$url_max_len)
					$cur_url_len=$url_max_len;
				$substring=mb_substr($substring, mb_strpos($substring, $val)+strlen($val));
				if($cur_url_len>($tw_max_len-$len))
				{
					$final_str.="...";
					$len+=3;
					break;
				}
				else
				{
					$final_str.=$val;
					$len+=$cur_url_len;
				}		
			}
			if(mb_strlen($substring)>0 && $tw_max_len>$len)
			{
				if(mb_strlen($substring)>($tw_max_len-$len))
				{
					$final_str.=mb_substr($substring,0,$tw_max_len-$len-3)."...";
				}
				else
				{
					$final_str.=$substring;
				}
			}
		
			$substring=$final_str;
		}
		
		$tw_publish_status=array();
		$tw_publish_status_array=array();
		$substring=xyz_smap_premium_add_hash_tag($substring,$search);
		
		$twobj = new SMAPTwitterOAuth(array( 'consumer_key' => $tappid, 'consumer_secret' => $tappsecret, 'user_token' => $taccess_token, 'user_secret' => $taccess_token_secret,'curl_ssl_verifypeer'   => false));
		
		if($image_found==1 && $post_twitter_image_permission==1)
		{
			$resultfrtw = $twobj -> request('POST', 'https://api.twitter.com/1.1/statuses/update_with_media.json', array( 'media[]' => $img, 'status' => $substring), true, true);
		
			if($resultfrtw!=200){
				if($twobj->response['response']!="")
					$tw_publish_status["statuses/update_with_media"]="<span style=\"color:red\">statuses/update_with_media : ".print_r($twobj->response['response'], true)."</span>";
				else
					$tw_publish_status["statuses/update_with_media"]="<span style=\"color:red\">statuses/update_with_media : ".$resultfrtw."</span>";
			}
			else 
				$tw_publish_status["statuses/update_with_media"]="<span style=\"color:green\">statuses/update_with_media : Success.</span>";
		
		}
		else
		{
			$resultfrtw = $twobj->request('POST', $twobj->url('1.1/statuses/update'), array('status' =>$substring));
		
			if($resultfrtw!=200){
				if($twobj->response['response']!="")
					$tw_publish_status["statuses/update"]="<span style=\"color:red\">statuses/update : ".print_r($twobj->response['response'], true)."</span>";
				else
					$tw_publish_status["statuses/update"]="<span style=\"color:red\">statuses/update : ".$resultfrtw."</span>";
			}
			else if($img_status!="")
				$tw_publish_status["statuses/update_with_media"]="<span style=\"color:red\">statuses/update_with_media : ".$img_status."</span>";
			else
				$tw_publish_status["statuses/update"]="<span style=\"color:green\">statuses/update_with_media : Success.</span>";
			
		
		}
		
		if(isset($tw_publish_status["statuses/update_with_media"]))
			$tw_publish_status_array=$tw_publish_status["statuses/update_with_media"];
		if(isset($tw_publish_status["statuses/update"]))
			$tw_publish_status_array=$tw_publish_status["statuses/update"];
		
		if(count($tw_publish_status_array)>0)
			$tw_publish_status_insert=serialize($tw_publish_status_array);
		else
			$tw_publish_status_insert=1;

		return $tw_publish_status_insert;
	}
}

if (!function_exists("xyz_smap_premium_linkedin_publish")) {

	function xyz_smap_premium_linkedin_publish($lnappikey,$lnapisecret,$lnstatus,$description,$content_title,$content_desc,$caption,$name,$lmessagetopost,$link,$excerpt,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$attachmenturl,$post_ln_image_permission,$xyz_smap_application_lnarray,$xyz_smap_ln_share_post_profile,$xyz_smap_ln_shareprivate,$xyz_smap_ln_company_id,$xyz_smap_authorization_flag,$shortlink,$reg_exUrl,$xyz_smap_premium_ln_pref_link_sel)
	{
		
		$contentln=array();
		$utf="UTF-8";
		//$description=str_replace("&nbsp;", "", $description);
		
		$description_li=xyz_smap_string_limit_premium($description, 362);
		$caption_li=xyz_smap_string_limit_premium($caption, 200);
		$name_li=xyz_smap_string_limit_premium($name, 200);
		
		$message1=xyz_smap_premium_split_replace('{POST_TITLE}', $name, $lmessagetopost);
		$message2=str_replace('{BLOG_TITLE}', $caption,$message1);
		$message3=str_replace('{PERMALINK}', $link, $message2);
		$message4=xyz_smap_premium_split_replace('{POST_EXCERPT}', $excerpt, $message3);
		$message5=xyz_smap_premium_split_replace('{POST_CONTENT}', $description, $message4);
		$message5=str_replace('{USER_NICENAME}', $user_nicename, $message5);
		$message5=str_replace('{POST_ID}', $post_ID, $message5);
		$message5=str_replace('{POST_TAGS}', $post_tags, $message5);
		$message5=str_replace('{POST_CATEGORY}', $POST_CATEGORY, $message5);
		$message5=str_replace('{SHORTLINK}', $shortlink, $message5);
		
		$message5=str_replace("&nbsp;","",$message5);
		
		//$message5=xyz_smap_string_limit_premium($message5, 700);
		
		$content_title=xyz_smap_string_limit_premium($content_title, 200);
		$content_desc=xyz_smap_string_limit_premium($content_desc, 362);
		if($content_title=="")
			$content_title=$name_li;
		if(get_option('xyz_smap_premium_utf_decode')==1)
			$content_title=utf8_decode($content_title);
// 		if(strcmp(get_option('blog_charset'),$utf)==0)
// 			$content_title=utf8_decode($content_title);
		if($content_desc=="")
			$content_desc=$description_li;
		if(get_option('xyz_smap_premium_utf_decode')==1)
			$content_desc=utf8_decode($content_desc);
// 		if(strcmp(get_option('blog_charset'),$utf)==0)
// 			$content_desc=utf8_decode($content_desc);
		
		$contentln['comment'] =$message5;
		$contentln['content']['title'] = $content_title;
		$contentln['content']['submitted-url'] = $link;
		
		$ln_image_url=get_option('xyz_smap_ln_image_url');
		
		if($attachmenturl!="")
			$ln_image_url=$attachmenturl;
		
		if($ln_image_url!="" && $post_ln_image_permission==1)
			$contentln['content']['submitted-image-url'] = $ln_image_url;
		$contentln['content']['description'] = $content_desc;
		
		$url_ln=array();
		preg_match($reg_exUrl, $message5, $url_ln);
		
		$ln_acc_tok_arr=json_decode($xyz_smap_application_lnarray);
		
// 		$ln_acc_tok_expires=$ln_acc_tok_arr->expires_in;
		
		
		$xyz_smap_application_lnarray=$ln_acc_tok_arr->access_token;
		$ln_publish_status=array();
		$ln_publish_status_prof=array();$ln_publish_status_comp=array();
		if($xyz_smap_ln_share_post_profile==0) //profile
		{
			if($xyz_smap_ln_shareprivate==1)
			{
				$contentln['visibility']['code']='connections-only';
			}
			else
			{
				$contentln['visibility']['code']='anyone';
			}
		
			$ObjLinkedin = new SMAPLinkedInOAuth2($xyz_smap_application_lnarray);
		
			if($xyz_smap_premium_ln_pref_link_sel==1)
			{
				if(count($url_ln)>0)
					$contentln=xyz_wp_smap_linkedin_attachment_metas($contentln,$url_ln[0]);
			}
		
		
		
			try
			{
				$arrResponse = $ObjLinkedin->shareStatus($contentln);
				if ( isset($arrResponse['errorCode']) && isset($arrResponse['message']) && ($arrResponse['message']!='') ) {//as per old api ; need to confirm which is correct
					$ln_publish_status_prof["new"]="<span style=\"color:red\"> Profile : ".$arrResponse['message'].".</span>";
				}
// 				else 
// 				{
// 					$ln_publish_status_prof["new"]="<span style=\"color:green\">Profile : Success.</span>";
// 				}
					
				else if(isset($response2['error']) && $response2['error']!="")//as per new api ; need to confirm which is correct
				{
					$ln_publish_status_prof["new"]="<span style=\"color:red\"> Profile : ".$response2['error'].".</span>";
				}
				else 
				{
					$ln_publish_status_prof["new"]="<span style=\"color:green\">Profile : Success.</span>";
				}
		
			}
			catch (Exception $e)
			{
				$ln_publish_status_prof["new"]="<span style=\"color:red\"> Profile:".$e->getMessage().".</span>";
			}
		}
		if($xyz_smap_ln_company_id!='') //Company
		{
			$ObjLinkedin = new SMAPLinkedInOAuth2($xyz_smap_application_lnarray);
				if($xyz_smap_premium_ln_pref_link_sel==1)
				{
					if(count($url_ln)>0)
						$contentln=xyz_wp_smap_linkedin_attachment_metas($contentln,$url_ln[0]);
				}
				
				$xyz_smap_ln_company_id_array=explode(",", $xyz_smap_ln_company_id);
				
				if(count($xyz_smap_ln_company_id_array)>0)
				{
					$ln_publish_status_comp["new"]="";
					for($i=0;$i<count($xyz_smap_ln_company_id_array);$i++)
					{
						try
						{
							$response2 = $ObjLinkedin->postToCompany($xyz_smap_ln_company_id_array[$i],$contentln);
							if ( isset($response2['errorCode']) && isset($response2['message']) && ($response2['message']!='') )
							{
								$ln_publish_status_comp["new"].="<span style=\"color:red\"> CompanyID : ".$xyz_smap_ln_company_id_array[$i]."-".$response2['message'].".</span>";
							}
							else 
							{
								$ln_publish_status_comp["new"].="<span style=\"color:green\"> CompanyID : ".$xyz_smap_ln_company_id_array[$i]."-"."Success.</span>";
							}
						}
						catch(Exception $e)
						{
							$ln_publish_status_comp["new"].="<span style=\"color:red\"> CompanyID : ".$xyz_smap_ln_company_id_array[$i]."-".$e->getMessage().".</span>";
						}
					}
				}
		}
// 		if($xyz_smap_ln_share_post==2) //Group
// 		{
		
			/*GROUP LOGIC COMMENTED TEMPORARILY UNTIL API IS AVAILABLE FOR TESTING */
			/*
			 * if($xyz_smap_premium_ln_pref_link_sel==1)
			 {
			if(count($url_ln)>0)
				$contentln=xyz_wp_smap_linkedin_attachment_metas($contentln,$url_ln[0]);
			}
			try{
			$response2 = $OBJ_linkedin->postToGroup($contentln,$xyz_smap_ln_group_id);
			}
			catch(Exception $e)
			{
			$ln_publish_status["new"]=$e->getMessage();
			}
			if(isset($response2['error']) && $response2['error']!="")
				$ln_publish_status["new"]=$response2['error'];
		
			*/
// 		}
	
		$ln_publish_status_prof_str='';
		$ln_publish_status_comp_str='';
		
		if(isset($ln_publish_status_prof["new"]))
			$ln_publish_status_prof_str=$ln_publish_status_prof["new"];
		if(isset($ln_publish_status_comp["new"]))
			$ln_publish_status_comp_str=$ln_publish_status_comp["new"];
		
		$ln_publish_status=$ln_publish_status_prof_str.$ln_publish_status_comp_str;
		
// 		if(count($ln_publish_status)>0)
			$ln_publish_status_insert=serialize($ln_publish_status);
// 		else
// 			$ln_publish_status_insert=1;
		
			
		return $ln_publish_status_insert;
		
		
	}
}


if (!function_exists("xyz_smap_premium_pinteret_publish")) {

	function xyz_smap_premium_pinteret_publish($xyz_smap_pi_email,$xyz_smap_pi_password,$xyz_smap_pi_board_ids,$pistatus,$name,$caption,$pmessagetopost,$link,$excerpt,$description,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$search,$pi_image_url,$shortlink,$reg_exUrl)
	{
				$message1=xyz_smap_premium_split_replace('{POST_TITLE}', $name, $pmessagetopost);
				$message2=str_replace('{BLOG_TITLE}', $caption,$message1);
				$message3=str_replace('{PERMALINK}', $link, $message2);
				$message4=xyz_smap_premium_split_replace('{POST_EXCERPT}', $excerpt, $message3);
				$message5=xyz_smap_premium_split_replace('{POST_CONTENT}', $description, $message4);
				$message5=str_replace('{USER_NICENAME}', $user_nicename, $message5);
				$message5=str_replace('{POST_ID}', $post_ID, $message5);
				$message5=str_replace('{POST_TAGS}', $post_tags, $message5);
				$message5=str_replace('{POST_CATEGORY}', $POST_CATEGORY, $message5);
				$message5=str_replace('{SHORTLINK}', $shortlink, $message5);
				
				$message5=str_replace("&nbsp;","",$message5);
		
				$message5=xyz_smap_premium_add_hash_tag($message5,$search);
				
				$loginError = xyzsmap_logtopinterest($xyz_smap_pi_email, $xyz_smap_pi_password);				
				$pi_publish_status=array();$pi_publish_status['post']='';$pi_publish_status_array=array();
				if (!$loginError)
				{
					$board_ids=explode(",",$xyz_smap_pi_board_ids);
										
					for($j=0;$j<count($board_ids);$j++)
					{
						$pi_res=xyzsmap_post_to_pinterest($message5, $pi_image_url, $link, $board_ids[$j]);
						if(!is_array($pi_res))
							$pi_publish_status['post'].="<span style=\"color:red\">Board ID : ".$board_ids[$j]."-".$pi_res.".</span>";
						else 
							$pi_publish_status['post'].="<span style=\"color:green\">Board ID : ".$board_ids[$j]."-Success.</span>";
							
					}
				} 				
				else
				{
					$pi_publish_status['post'].="<span style=\"color:red\">".$loginError.".</span>";
				}
				$pi_publish_status_array=$pi_publish_status['post'];
				if(count($pi_publish_status_array)>0)
					$pi_publish_status_insert=serialize($pi_publish_status_array);
				else
					$pi_publish_status_insert=1;
		return $pi_publish_status_insert;
					
			
		
			}
}



if (!function_exists("xyz_smap_premium_gplus_publish")) {

	function xyz_smap_premium_gplus_publish($xyz_smap_gp_email,$xyz_smap_gp_password,$xyz_smap_gppost_method,$gpstatus,$gmessagetopost,$name,$caption,$link,$excerpt,$description,$user_nicename,$post_ID,$post_tags,$POST_CATEGORY,$search,$xyz_smap_gp_pageid,$attachmenturl,$xyz_smap_gp_select_page_or_prof,$shortlink,$reg_exUrl)
	{
				require_once( ABSPATH . 'wp-content/plugins/xyz-wp-smap/api/googleplus.php'  );
				
				$message1=xyz_smap_premium_split_replace('{POST_TITLE}', $name, $gmessagetopost);
				$message2=str_replace('{BLOG_TITLE}', $caption,$message1);
				$message3=str_replace('{PERMALINK}', $link, $message2);
				$message4=xyz_smap_premium_split_replace('{POST_EXCERPT}', $excerpt, $message3);
				$message5=xyz_smap_premium_split_replace('{POST_CONTENT}', $description, $message4);
				$message5=str_replace('{USER_NICENAME}', $user_nicename, $message5);
				$message5=str_replace('{POST_ID}', $post_ID, $message5);
				$message5=str_replace('{POST_TAGS}', $post_tags, $message5);
				$message5=str_replace('{POST_CATEGORY}', $POST_CATEGORY, $message5);
				$message5=str_replace('{SHORTLINK}', $shortlink, $message5);
				
				$message5=str_replace("&nbsp;","",$message5);
		
				//$message5=xyz_smap_string_limit_premium($message5, 500);
			
				$message5=xyz_smap_premium_add_hash_tag($message5,$search);
				
		
				$loginError = xyzsmap_connectToGooglePlus($xyz_smap_gp_email, $xyz_smap_gp_password);
				$gp_publish_status=array();
				if (!$loginError)
				{
					
					$page_flag=0;$prof_flag=0;
					
					$xyz_smap_gp_page_or_prof_val_arr=explode(',', $xyz_smap_gp_select_page_or_prof);
					if(in_array(1, $xyz_smap_gp_page_or_prof_val_arr)==true)
						$page_flag=1;
					if(in_array(0, $xyz_smap_gp_page_or_prof_val_arr)==true)
						$prof_flag=1;
					if(strpos($xyz_smap_gp_email, '@gmail.com') !== false)
						$profile_tag="Profile";
					else 
						$profile_tag="Page-Profile";
					
					
				  if($xyz_smap_gppost_method==1) //simple
					{
						
						if (strpos($xyz_smap_gp_email, '@gmail.com') !== false && $xyz_smap_gp_pageid!='') {			//publish post to page via profile login
							
							try {
									xyzsmap_postToGooglePlus($message5, '', $xyz_smap_gp_pageid);
									$gp_publish_status["post"].="<span style=\"color:green\"> Page ID :".$xyz_smap_gp_pageid."- Success.</span>";
									
							}
							catch (Exception $e)
							{
								$gp_publish_status["post"].="<span style=\"color:red\"> Page ID : ".$xyz_smap_gp_pageid."- ".$e->getMessage().".</span>";					
							}
							
						}
						if($xyz_smap_gp_select_page_or_prof!=1)
						{
							
							try {
								if($prof_flag==1)
								{
									xyzsmap_postToGooglePlus($message5, '','');
								$gp_publish_status["post"].="<span style=\"color:green\">".$profile_tag." : Success.</span>";
								}
							}
							catch (Exception $e)
							{
								$gp_publish_status["post"].="<span style=\"color:red\">".$profile_tag." : ".$e->getMessage().".</span>";
							}
						
						}
						
					}
					
					else if($xyz_smap_gppost_method==2)//image
					{
	
						$gp_image_url=get_option('xyz_smap_gp_image_url');
						
						if($attachmenturl!="")
							$gp_image_url=$attachmenturl;
						
						
						$lnk = array('img'=>$gp_image_url);
						if (strpos($xyz_smap_gp_email, '@gmail.com') !== false && $xyz_smap_gp_pageid!='') {
						
							try {
								xyzsmap_postToGooglePlus($message5, $lnk, $xyz_smap_gp_pageid);
								$gp_publish_status["post"].="<span style=\"color:green\"> Page ID :".$xyz_smap_gp_pageid."- Success.</span>";
								
							}
							catch (Exception $e)
							{
								$gp_publish_status["post"].="<span style=\"color:red\"> Page ID : ".$xyz_smap_gp_pageid."- ".$e->getMessage().".</span>";
							}
						}
						if($xyz_smap_gp_select_page_or_prof!=1)
						{
							try {
								if($prof_flag==1)
									xyzsmap_postToGooglePlus($message5, $lnk,'');
								$gp_publish_status["post"].="<span style=\"color:green\">".$profile_tag." : Success.</span>";
								
							}
							catch (Exception $e)
							{
								$gp_publish_status["post"].="<span style=\"color:red\">".$profile_tag." : ".$e->getMessage().".</span>";
								
							}
						}
					}
					
					else if($xyz_smap_gppost_method==3)//blog post
					{
						$lnk = xyzsmap_getGoogleUrlInfo($link);
						if (strpos($xyz_smap_gp_email, '@gmail.com') !== false && $xyz_smap_gp_pageid!='') {
						
							try {
								xyzsmap_postToGooglePlus($message5, $lnk, $xyz_smap_gp_pageid);
								$gp_publish_status["post"].="<span style=\"color:green\"> Page ID :".$xyz_smap_gp_pageid."- Success.</span>";
								
							}
							catch (Exception $e)
							{
								$gp_publish_status["post"].="<span style=\"color:red\"> Page ID : ".$xyz_smap_gp_pageid."- ".$e->getMessage().".</span>";
							}
						}
						if($xyz_smap_gp_select_page_or_prof!=1)
						{
							try {
								if($prof_flag==1)
									xyzsmap_postToGooglePlus($message5, $lnk,'');
								$gp_publish_status["post"].="<span style=\"color:green\">".$profile_tag." : Success.</span>";
								
							}
							catch (Exception $e)
							{
								$gp_publish_status["post"].="<span style=\"color:red\">".$profile_tag." : ".$e->getMessage().".</span>";
								
							}
						}
					}
					
				}
				else
				{
					$gp_publish_status["post"]="<span style=\"color:red\">".$loginError.".</span>";
				}
		
				$gp_publish_status_array=$gp_publish_status["post"];
				
				if(count($gp_publish_status_array)>0)
					$gp_publish_status_insert=serialize($gp_publish_status_array);
				else
					$gp_publish_status_insert=1;
						
		return $gp_publish_status_insert;
																
			}
}
if (!function_exists("xyz_wp_smap_facebook_attachment_metas")) {
	function xyz_wp_smap_facebook_attachment_metas($attachment,$url)
	{
		$content_title='';$content_desc='';$content_img='';$utf="UTF-8";
		$aprv_me_data=wp_remote_get($url);
		if( is_array($aprv_me_data) ) {
			$aprv_me_data = $aprv_me_data['body']; // use the content
		}
		else {
			$aprv_me_data='';
		}
		
		$og_datas = new DOMDocument();
		@$og_datas->loadHTML($aprv_me_data);
		$xpath = new DOMXPath($og_datas);
		if(isset($attachment['name']))
		{
			$ogmetaContentAttributeNodes_tit = $xpath->query("/html/head/meta[@property='og:title']/@content");

			foreach($ogmetaContentAttributeNodes_tit as $ogmetaContentAttributeNode_tit) {
				$content_title=$ogmetaContentAttributeNode_tit->nodeValue;

			}
			if(get_option('xyz_smap_premium_utf_decode')==1)
				$content_title=utf8_decode($content_title);
// 			if(strcmp(get_option('blog_charset'),$utf)==0)
// 				$content_title=utf8_decode($content_title);
			if($content_title!='')
				$attachment['name']=$content_title;
		}
		if(isset($attachment['actions']))
		{
			if(isset($attachment['actions']['name']))
			{
				$ogmetaContentAttributeNodes_tit = $xpath->query("/html/head/meta[@property='og:title']/@content");

				foreach($ogmetaContentAttributeNodes_tit as $ogmetaContentAttributeNode_tit) {
					$content_title=$ogmetaContentAttributeNode_tit->nodeValue;

				}
				if(get_option('xyz_smap_premium_utf_decode')==1)
					$content_title=utf8_decode($content_title);
// 				if(strcmp(get_option('blog_charset'),$utf)==0)
// 					$content_title=utf8_decode($content_title);
				if($content_title!='')
					$attachment['actions']['name']=$content_title;
			}
			if(isset($attachment['actions']['link']))
			{
				$attachment['actions']['link']=$url;
			}
		}
		if(isset($attachment['description']))
		{
			$ogmetaContentAttributeNodes_desc = $xpath->query("/html/head/meta[@property='og:description']/@content");
			foreach($ogmetaContentAttributeNodes_desc as $ogmetaContentAttributeNode_desc) {
				$content_desc=$ogmetaContentAttributeNode_desc->nodeValue;
			}
			if(get_option('xyz_smap_premium_utf_decode')==1)
				$content_desc=utf8_decode($content_desc);
// 			if(strcmp(get_option('blog_charset'),$utf)==0)
// 				$content_desc=utf8_decode($content_desc);
			if($content_desc!='')
				$attachment['description']=$content_desc;
		}
		/*if(isset($attachment['picture']))
		{
			$ogmetaContentAttributeNodes_img = $xpath->query("/html/head/meta[@property='og:image']/@content");
			foreach($ogmetaContentAttributeNodes_img as $ogmetaContentAttributeNode_img) {
				$content_img=$ogmetaContentAttributeNode_img->nodeValue;
			}
			if($content_img!='')
				$attachment['picture']=$content_img;
		}*/

		if(isset($attachment['link']))
			$attachment['link']=$url;

		return $attachment;
	}
}
if (!function_exists("xyz_wp_smap_linkedin_attachment_metas")) {
	function xyz_wp_smap_linkedin_attachment_metas($contentln,$url)
	{
		$content_title='';$content_desc='';$utf="UTF-8";$content_img='';
		$aprv_me_data=wp_remote_get($url);
		if( is_array($aprv_me_data) ) {
  		$aprv_me_data = $aprv_me_data['body']; // use the content
		}
		else {
			$aprv_me_data='';
		}
		$og_datas = new DOMDocument();
		@$og_datas->loadHTML($aprv_me_data);
		$xpath = new DOMXPath($og_datas);
		if(isset($contentln['content']['title']))
		{
			$ogmetaContentAttributeNodes_tit = $xpath->query("/html/head/meta[@property='og:title']/@content");
			foreach($ogmetaContentAttributeNodes_tit as $ogmetaContentAttributeNode_tit) {
				$content_title=$ogmetaContentAttributeNode_tit->nodeValue;
			}
			if(get_option('xyz_smap_premium_utf_decode')==1)
				$content_title=utf8_decode($content_title);
// 			if(strcmp(get_option('blog_charset'),$utf)==0)
// 				$content_title=utf8_decode($content_title);
			if($content_title!='')
				$contentln['content']['title']=$content_title;
		}
		if(isset($contentln['content']['description']))
		{
			$ogmetaContentAttributeNodes_desc = $xpath->query("/html/head/meta[@property='og:description']/@content");
			foreach($ogmetaContentAttributeNodes_desc as $ogmetaContentAttributeNode_desc) {
				$content_desc=$ogmetaContentAttributeNode_desc->nodeValue;
			}
			if(get_option('xyz_smap_premium_utf_decode')==1)
				$content_desc=utf8_decode($content_desc);
// 			if(strcmp(get_option('blog_charset'),$utf)==0)
// 				$content_desc=utf8_decode($content_desc);
			if($content_desc!='')
				$contentln['content']['description']=$content_desc;
		}
		/*if(isset($contentln['content']['submitted-image-url']))
		{
			$ogmetaContentAttributeNodes_img = $xpath->query("/html/head/meta[@property='og:image']/@content");
			foreach($ogmetaContentAttributeNodes_img as $ogmetaContentAttributeNode_img) {
				$content_img=$ogmetaContentAttributeNode_img->nodeValue;
			}
			if($content_img!='')
				$contentln['content']['submitted-image-url']=$content_img;
		}*/
		if(isset($contentln['content']['submitted-url']))
			$contentln['content']['submitted-url']=$url;

		return $contentln;
	}
}

/* function to support L-1, W-2 formats. */
if (!function_exists("xyz_smap_premium_split_replace"))
{
	function xyz_smap_premium_split_replace($search, $replace, $subject)//case insensitive
	{
		if(!stristr($subject,$search))
		{
			$search_tmp=str_replace("}", "", $search);
			preg_match_all("@(".preg_quote($search_tmp)."\:)(l|w)\-(\d+)}@i",$subject,$matches); // @ is same as /
			if(is_array($matches) && isset($matches[0]))
			{
				foreach ($matches[0] as $k=>$v)
				{
					$limit=$matches[3][$k];
					if(strcasecmp($matches[2][$k],"l")==0)//lines
					{
						$replace_arr = preg_split( "/(\.|;|\!)/", $replace ,0,PREG_SPLIT_DELIM_CAPTURE );
						if(is_array($replace_arr) && count($replace_arr)>0)
						{
							$replace_new=implode(array_slice($replace_arr,0,(2*$limit)));
							$subject=str_replace($matches[0][$k], $replace_new, $subject);
						}
					}
					if(strcasecmp($matches[2][$k],"w")==0)//words
					{
						$replace_arr=explode(" ",$replace);
						if(is_array($replace_arr) && count($replace_arr)>0)
						{
							$replace_new=implode(" ",array_slice($replace_arr,0,$limit));
							$subject=str_replace($matches[0][$k], $replace_new, $subject);
						}
					}
				}
			}
		}
		else
			$subject=str_replace($search, $replace, $subject);
		return $subject;
	}
}
if (!function_exists("xyz_smap_get_table")) {
	function xyz_smap_get_table($type)
	{
		$table="";
		if($type==1)
		{
			$table="xyz_smap_fb_details";
		}
		else if($type==2)
		{
			$table="xyz_smap_tw_details";
		}
		else if($type==3)
		{
			$table="xyz_smap_ln_details";
		}
		else if($type==4)
		{
			$table="xyz_smap_pi_details";
		}	
		else if($type==5)
		{
			$table="xyz_smap_gp_details";
		}
		return $table;
	}
}

if (!function_exists("smap_free_to_premium_import")) {
	function smap_free_to_premium_import($media)
	{
		
	$xyz_smap_include_pages=get_option('xyz_'.$media.'_include_pages');
	$xyz_smap_include_posts=get_option('xyz_'.$media.'_include_posts');
	$xyz_smap_include_categories=get_option('xyz_'.$media.'_include_categories');
	$xyz_smap_include_customposttypes=get_option('xyz_'.$media.'_include_customposttypes');
	$xyz_smap_apply_filters=get_option('xyz_'.$media.'_std_apply_filters');
	$xyz_smap_peer_verification=esc_html(get_option('xyz_'.$media.'_peer_verification'));
	$xyz_smap_default_selection_edit=esc_html(get_option('xyz_'.$media.'_default_selection_edit'));
	$xyz_smap_premium_utf_decode=get_option('xyz_'.$media.'_utf_decode_enable');
	
	add_option('xyz_smap_premium_include_pages', $xyz_smap_include_pages);
	add_option('xyz_smap_premium_include_posts', $xyz_smap_include_posts);
	add_option('xyz_smap_premium_include_categories', $xyz_smap_include_categories);
	add_option('xyz_smap_premium_include_customposttypes', $xyz_smap_include_customposttypes);
	add_option('xyz_smap_premium_peer_verification', $xyz_smap_peer_verification);
	add_option('xyz_smap_premium_default_selection_edit',$xyz_smap_default_selection_edit);
	add_option('xyz_smap_apply_filters',$xyz_smap_apply_filters);
	add_option("xyz_smap_premium_utf_decode", $xyz_smap_premium_utf_decode);
	}
	
}



?>
