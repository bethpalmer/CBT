<?php
/**
 * The template for displaying Comments.
 */
?>


<?php if ( post_password_required() ) : ?>
	<p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'extensio' ); ?></p>
<?php
		/* Stop the rest of comments.php from being processed,
		 * but don't kill the script entirely -- we still have
		 * to fully load the template.
		 */
		return;
	endif;
?>

<?php
	// You can start editing here -- including this comment!
?>

<?php if ( have_comments() ) : ?>
	<section class="comments" id="comments">
		<div class="headline">
			<div class="case">
				<h2><?php printf( _n( '1 Comment', '%1$s comments', get_comments_number(), 'extensio' ), number_format_i18n( get_comments_number() ) ); ?></h2>
				<a href="#the_comment_list" class="add-comments"><?php _e('add yours',''); ?></a>
			</div>
		</div>


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( "<span class='meta-nav'>&larr;</span> Older Comments", "extensio" ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( "Newer Comments <span class='meta-nav'>&rarr;</span>", "extensio" ) ); ?></div>
			</div> <!-- .navigation -->
<?php endif; // check for comment navigation ?>

		<!-- comments-list -->
		<ul class="comments-list">
				<?php
					wp_list_comments( array( 'callback' => 'extensio_comment' ) );
				?>
		</ul>
	</section>


<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<div class="navigation">
				<div class="nav-previous"><?php previous_comments_link( __( "<span class='meta-nav'>&larr;</span> Older Comments", "extensio" ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( __( "Newer Comments <span class='meta-nav'>&rarr;</span>", "extensio" ) ); ?></div>
			</div><!-- .navigation -->
<?php endif; // check for comment navigation ?>

<?php else : // or, if we don't have comments:

	/* If there are no comments and comments are closed,
	 * let's leave a little note, shall we?
	 */
	 $needed_comment_form = 0;
	 if ($needed_comment_form == 1) comment_form(); 
	 
	if ( ! comments_open() ) :
?>
	<p class="nocomments"><?php _e( 'Comments are closed.', 'extensio' ); ?></p>
<?php endif; // end ! comments_open() ?>

<?php endif; // end have_comments() ?>

<?php comment_form_theme(); ?>