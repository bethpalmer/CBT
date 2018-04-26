<?php
/*
Template Name: Contact 2nd
*/
//==============
//CONFIGURATION
//==============
global $shortname;
$to = get_option($shortname.'_contact_email');

if ($_POST) {
	//User info (DO NOT EDIT!)
	$name = stripslashes($_POST['username']); //sender's name
	$email = stripslashes($_POST['email']); //sender's email

	//The subject
	$subject = stripslashes($_POST['subject']); // the subject	//$message = stripslashes($_POST['message']); //sender's email

	//The message you will receive in your mailbox
	//Each parts are commented to help you understand what it does exaclty.
	//YOU DON'T NEED TO EDIT IT BELOW BUT IF YOU DO, DO IT WITH CAUTION!
	$msg  = __('From:','extensio')." $name \r\n";  //add sender's name to the message
	$msg .= __('Email:','extensio')." $email \r\n";  //add sender's email to the message
	$msg .= __('Subject:','extensio')." $subject \r\n\r\n"; //add subject to the message (optional! It will be displayed in the header anyway)
	$msg .= __('---Message---','extensio')." \r\n".stripslashes($_POST['message'])."\r\n\r\n";  //the message itself

	//Extras: User info (Optional!)
	//Delete this part if you don't need it
	//Display user information such as Ip address and browsers information...
	$msg .= __('---User information---','extensio')." \r\n"; //Title
	$msg .= __('User IP:','extensio')." ".$_SERVER["REMOTE_ADDR"]."\r\n"; //Sender's IP
	$msg .= __('Browser info:','extensio')." ".$_SERVER["HTTP_USER_AGENT"]."\r\n"; //User agent
	$msg .= __('User come from:','extensio')." ".$_SERVER["HTTP_REFERER"]; //Referrer
	// END Extras
	
}

$reCaptcha_error = '';

//get reCAPTCHA settings
if ( (get_option($shortname.'_recaptcha_enabled') == 'true') && get_option($shortname.'_recaptcha_publickey') && get_option($shortname.'_recaptcha_privatekey')) {
    if ( !function_exists('_recaptcha_qsencode') ) {
		require_once('functions/recaptchalib.php');
    }
    $publickey = get_option($shortname.'_recaptcha_publickey');
    $privatekey = get_option($shortname.'_recaptcha_privatekey');	
}

get_header();
?>

				<!-- main -->
				<div id="main">
					<section class="intro gallery">
						<?php if (get_option($shortname."_google_map")) { ?>
						<div class="gallery-holder" id="holder-iframe">
							<iframe width="990" height="475" src="<?php echo get_option($shortname."_google_map"); ?>" style="margin:0 0 0 0; padding:0; border:0px;"></iframe>
						</div>
						<?php } else { 
							if (get_post_meta($post->ID, $shortname.'_custom_page_heading',true)) { 
									echo get_post_meta($post->ID, $shortname.'_custom_page_heading',true);
								} else the_title();
							}
						?>
					</section>
					<div class="main-holder">
						<section class="col" id="content">
							<!-- article -->
							<article class="article-alt">
								<div class="txt">
								
									<?php if (have_posts()) : ?>
									<?php while (have_posts()) : the_post(); ?>
										<?php the_content(); ?>
									<?php endwhile; ?>
									<?php endif; ?>
								</div>
							</article>

						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Contact Form") ) : ?>
							<?php
								if ($_SERVER['REQUEST_METHOD'] != 'POST'){
									$self = $_SERVER['PHP_SELF'];
							?>
							<!-- contact-form -->
							<form method="post" class="comments-form" id="main_comment_form" action="#msgConfirmation">
								<fieldset>
									<div class="headline">
										<h2><?php _e('Send us a message','extensio'); ?></h2>
									</div>
									<div class="row">
										<label for="name"><?php _e('Your Name','extensio'); ?> <span>(*)</span></label>
										<input type="text" id="username" name="username" value="" class="text validate[required]" >
									</div>
									<div class="row">
										<label for="email"><?php _e('Your Email','extensio'); ?> <span>(*)</span></label>
										<input type="text" id="email" name="email" value="" class="text validate[required,custom[email]]" >
									</div>
									<div class="row">
										<label for="subject"><?php _e('Your Subject','extensio'); ?></label>
										<input type="text" id="subject" name="subject" value="" class="text" >
									</div>									
									<div class="row">
										<label for="message"><?php _e('Your Message','extensio'); ?> <span>(*)</span></label>
										<textarea class="w_focus validate[required]" id="message" name="message" cols="30" rows="10"></textarea>
									</div>
									<?php
										if ( (get_option($shortname.'_recaptcha_enabled') == 'true') && (get_option($shortname.'_recaptcha_publickey')) && (get_option($shortname.'_recaptcha_privatekey')) ) : 
									?>
										<script type="text/javascript">var RecaptchaOptions = {theme : '<?php echo get_option($shortname.'_recaptcha_theme'); ?>', lang : '<?php echo get_option($shortname.'_recaptcha_lang'); ?>'};</script>
										<div class="row">
											
									<?php
											echo recaptcha_get_html( $publickey, $reCaptcha_error ); 
									?>
										</div>
									<?php
										endif; 
									?>									
									<span class="submit"><?php _e('Send Email','extensio'); ?><input type="submit" value="<?php _e('Send Email','extensio'); ?>" ></span>
								</fieldset>
							</form>
						<?php
								} else {
									
									if ( get_option($shortname.'_recaptcha_enabled') == 'true' ) {
										
										if ( !function_exists('_recaptcha_qsencode') ) {
											require_once('../functions/recaptchalib.php');
										}
										
										$publickey = get_option($shortname.'_recaptcha_publickey');
										$privatekey = get_option($shortname.'_recaptcha_privatekey');

										$resp = null;
										$error = null;
										$resp = recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$_POST["recaptcha_challenge_field"],
											$_POST["recaptcha_response_field"]
										);
										
										if ( !$resp->is_valid ) {
											$reCaptcha_error = $resp->error;
										}
										
									}
										
									if ($reCaptcha_error) {
										echo "<div class='message-box red' id='msgConfirmation'>".__("<strong>Wrong reCAPTCHA word!</strong><br />Please click Back in the browser and enter a valid reCAPTCHA.","extensio").'</div>';
									} else {
										if  (mail($to, $subject, $msg, "From: $email\r\nReply-To: $email\r\nReturn-Path: $email\r\n")) {							
											//Message sent!
											//The message that will be displayed when the user click the sumbit button
											echo nl2br("
											<div class='message-box green' id='msgConfirmation'><strong>".__('Congratulations!','extensio')."</strong><br />".__('Thank you. Your message is sent. I will get back to you as soon as possible.','extensio')."</div>");
										} else {
											// Display error message if the message failed to send
											echo "<div class='message-box red' id='msgConfirmation'><strong>".__('Error!','extensio')."</strong><br />".__('Sorry, your message failed to send. Try later.','extensio')."</span>";
										}										
									}
								}
							?>
						<?php endif; ?>
							
						</section>
						<!-- sidebar -->
						<aside class="col" id="sidebar">

							<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar("Contact Sidebar") ) : ?>
							<?php endif; ?>

							<?php 
								$custom = get_post_custom($post->ID);
								$current_sidebar = $custom["current_sidebar"][0];	
								
								if ($current_sidebar) {
									if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($current_sidebar) ) :
									endif;
								}
							?>

						</aside>						
					</div>
				</div>
				<!--/ main -->

<?php get_footer(); ?>