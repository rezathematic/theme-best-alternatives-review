<?php
get_header();
?>
<div class="col-sm-12">
    <h3>Add New Post</h3>
    <form class="form-horizontal" name="form" method="post" enctype="multipart/form-data">
        <div class="col-md-12">
            <label class="control-label">Title</label>
            <input id="post_title" type="text" class="form-control" name="post_title" />
            <br>
            <label class="control-label">slug</label>
            <input id="post_slug" type="text" class="form-control" name="post_slug" />
            <br>
            <label class="control-label">heading one</label>
            <input id="post_h1" type="text" class="form-control" name="post_h1" />
        </div>
        <?php
        $content   = '';
        $editor_id = 'mycustomeditor';

        wp_editor($content, $editor_id);
        ?>
        <div class="col-md-12">
            <label class="control-label">Categories</label>
            <?php
            $args = array(
                'show_option_none' => __('Select category', 'textdomain'),
                'show_count'       => 0,
                'orderby'          => 'name',
                'echo'             => 0,
            );
            ?>

            <?php $select  = wp_dropdown_categories($args); ?>
            <?php echo $select; ?>
        </div>

        <div class="col-md-12">
            <input id="submit" type="submit" class="btn btn-primary" value="submit" name="submit" />
        </div>
    </form>
</div>
<?php
$postTitle = $_POST['post_title'];
$postSlug = $_POST['post_slug'];
$postH1 = $_POST['post_h1'];
$postContent = $_POST['mycustomeditor'];
$submit = $_POST['submit'];

if (isset($submit)) {

    global $user_ID, $wpdb;

    $query = $wpdb->prepare(
        'SELECT ID FROM ' . $wpdb->posts . '
        WHERE post_title = %s
        AND post_type = \'top-picks\'',
        $postTitle
    );
    $wpdb->query($query);

    if ($wpdb->num_rows) {
        $post_id = $wpdb->get_var($query);
        $meta = get_post_meta($post_id, 'p_h1', TRUE);
        // $meta++;
        // update_post_meta($post_id, 'p_name', $meta);
        // update_post_meta($post_id, 'post_content', $postContent);
        wp_update_post(array(
            'ID' => $post_id,
            'post_content' => $postContent,
            'meta_input' => array(
                'p_h1' => $postH1,
            )
        ));
    } else {
        $new_post = array(
            'post_title' => $postTitle,
            'post_name' => $postSlug,
            'post_content' => $postContent,
            'post_status' => 'publish',
            'post_date' => date('Y-m-d H:i:s'),
            'post_author' => '1',
            'post_type' => 'top-picks',
            'meta_input' => array(
                'p_h1' => $postH1,
            )
            // 'post_category' => array(0)
        );

        $post_id = wp_insert_post($new_post);
        // add_post_meta($post_id, 'times', '1');
    }
}
?>
<?php
get_footer();
?>