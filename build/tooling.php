<?php
/**
 * tooling block.
 */


// Create id attribute allowing for custom "anchor" value.
$id = 'tool-list-' . $block['id'];
if ( ! empty($block['anchor'] ) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$classes = 'block-tool-list';
if ( ! empty( $block['className'] ) ) {
    $classes .= ' ' . $block['className'];
}
if ( ! empty( $block['align'] ) ) {
    $classes .= ' align' . $block['align'];
}
?>

<style type="text/css">
    <?php echo '#' . $id; ?> {
    /* Add styles that use ACF values here */
    }
</style>

<?php
$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'tooling'
    ]
);
?>

<?php
/**
 * Tooling Builder
 * This block code displays information about tools in the shop.
 */
?>
<div <?php echo $wrapper_attributes; ?>>

    <div id="<?php echo esc_attr( $id ); ?>" class="<?php echo esc_attr( $classes ); ?>">
        <?php if ( have_rows( 'tool_builder' ) ) :

            ?>
        <div class="tooling-header">
            <span class="heading-tool">Item</span>
            <span class="heading-docs">View Docs</span>
            <span class="heading-desc">Description</span>
        </div>
            <?php while ( have_rows( 'tool_builder' ) ) : the_row();
                $tool = get_sub_field('tool_name');
                $description = get_sub_field('description');
                $file_name = get_sub_field('file_name');
                $title = get_sub_field('manual_name');
                $shop_area = get_sub_field('shop_area');
                $is_attachment = get_sub_field( 'add_attachment' ) == 1;


            $labels_checked_options = get_sub_field( 'labels' );
			?>


            <div class="tooling-list" >
<!--             Show Tool name   -->
                <div class="tooling-name" ><?php echo $tool ; ?></div>

<!--             Download Docs Column -->
                <div class="tooling-docs">
                <?php if ( $is_attachment ) : ?>
                    <?php
                    $doc_type = get_sub_field( 'doc_type' );
                    $upload_file = get_sub_field( 'upload_file' );
                    $url = $upload_file['url'];
                    $show_name = get_sub_field( 'manual_name' );
                    $type = substr($upload_file['filename'], -3); // grabs last three chars
                    $extension = strtoupper($type); // force to uppercase;
                    $size = size_format( filesize( get_attached_file( $upload_file['id'] ) ), 2 );

                    ?>
                    <?php if ( $upload_file ) : ?>

                    <a role="button" 
                            class="tooling-btn" 
                            title="Download the manual: <?= $title; ?>" 
                            href="<?= esc_url( $url ); ?>"> 

                        <?= $doc_type ?>
                    </a>

                    <?php endif; ?>
                <?php else : ?>
                    No Doc
                <?php endif; ?>
                </div>
<!--                Display Description -->
                <div class="tooling-desc" ><?php echo $description; ?></div>

            </div>
        <?php endwhile; ?>
        <?php else : ?>
            <?php // No rows found ?>
        <?php endif; ?>
    </div>
</div><!-- .tooling -->

