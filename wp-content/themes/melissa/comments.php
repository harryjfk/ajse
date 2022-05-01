<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 *
 * @package WordPress
 * @subpackage Melissa
 * @since Melissa 1.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<!-- comments -->
<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>

		<h2 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if (1 === $comments_number) {
					/* translators: %s: post title */
					printf(
            _x(
              'One thought on &ldquo;%s&rdquo;',
              'comments title',
              'melissa'
            ),
            get_the_title()
          );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s thought on &ldquo;%2$s&rdquo;',
							'%1$s thoughts on &ldquo;%2$s&rdquo;',
							$comments_number,
							'comments title',
							'melissa'
						),
						number_format_i18n($comments_number),
						get_the_title()
					);
				}
			?>
		</h2>

		<ol class="comment-list">
			<?php
				wp_list_comments(array(
					'style' => 'ol',
					'short_ping' => true,
					'avatar_size' => 104,
				));
			?>
		</ol><!-- .comment-list -->

		<?php
    the_comments_navigation(array(
      'prev_text' => '<i class="fa fa-angle-left"></i>'.esc_html__('Older comments', 'melissa'),
      'next_text' => esc_html__('Newer comments', 'melissa').'<i class="fa fa-angle-right"></i>'
    ));
    ?>

	<?php endif; ?>

	<?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) : ?>
		<p class="no-comments"><?php esc_html_e('Comments are closed.', 'melissa'); ?></p>
	<?php endif; ?>

	<?php
		comment_form(array(
			'title_reply_before' => '<h2 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h2>',
      'comment_notes_before' => '<p class="comment-notes">'.esc_html__('Su Correo no sera publicado. Los campos marcados con * son requeridos', 'melissa').'</p>',
      'title_reply' => '<span>'.esc_html__('Responder', 'melissa').'</span>',
      'title_reply_to' => '<span>'.esc_html__('Responder a %s', 'melissa').'</span>',
      'cancel_reply_link' => esc_html__('Cancelar Respuesta', 'melissa'),
      'label_submit' => esc_html__('Comentar', 'melissa')
		));
	?>

</div>
<!-- end comments -->
