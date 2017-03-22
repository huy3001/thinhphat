<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'elitemasters'); ?></p>
    <?php return;
}
?>


<div id="comments">
    <?php

    #Required for nested reply function that moves reply inline with JS
    if (is_singular()) wp_enqueue_script('comment-reply');

    if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
        die ('Please do not load this page directly. Thanks!');

    if (have_comments()) : ?>
        <h4><?php echo esc_html__('Comments', 'elitemasters'); ?> <span class="color">(<?php echo comments_number('0', '1', '%') . ''; ?>)</span></h4>
        <ol class="commentlist">
            <?php wp_list_comments('type=comment&callback=gt3_theme_comment'); ?>
        </ol>

        <div class="dn"><?php paginate_comments_links(); ?></div>

        <?php if ('open' == $post->comment_status) : ?>

        <?php else : // comments are closed ?>

        <?php endif; ?>
    <?php endif; ?>



    <?php if ('open' == $post->comment_status) :

        $comment_form = array(
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<label class="label-name"></label><input type="text" placeholder="' . esc_html__('Name *', 'elitemasters') . '" title="' . esc_html__('Name *', 'elitemasters') . '" id="author" name="author" class="form_field">',
                'email' => '<label class="label-email"></label><input type="text" placeholder="' . esc_html__('Email *', 'elitemasters') . '" title="' . esc_html__('Email *', 'elitemasters') . '" id="email" name="email" class="form_field">',
                'url' => '<label class="label-web"></label><input type="text" placeholder="' . esc_html__('URL', 'elitemasters') . '" title="' . esc_html__('URL', 'elitemasters') . '" id="web" name="url" class="form_field">'
            )),
            'comment_field' => '<label class="label-message"></label><textarea name="comment" cols="45" rows="5" placeholder="' . esc_html__('Write Your Comment Here...', 'elitemasters') . '" id="comment-message" class="form_field"></textarea>',
            'comment_form_before' => '',
            'comment_form_after' => '',
            'must_log_in' => esc_html__('You must be logged in to post a comment.', 'elitemasters'),
            'title_reply' => esc_html__('Leave a Comment!', 'elitemasters'),
            'label_submit' => esc_html__('Add a Comment', 'elitemasters'),
            'logged_in_as' => '<p class="logged-in-as">' . esc_html__('Logged in as', 'elitemasters') . ' <a href="' . admin_url('profile.php') . '">' . $user_identity . '</a>. <a href="' . wp_logout_url(apply_filters('the_permalink', get_permalink())) . '">' . esc_html__('Log out?', 'elitemasters') . '</a></p>',
        );
        comment_form($comment_form, $post->ID);

    else : // Comments are closed
        ?>
        <p><?php esc_html_e('Sorry, the comment form is closed at this time.', 'elitemasters') ?></p>
    <?php endif; ?>
</div>