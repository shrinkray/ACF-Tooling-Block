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
            <span class="item">Item</span>
            <span class="item">Description</span>
            <span class="item">Download</span>
            <span class="item">Location</span>
        </div>
            <?php while ( have_rows( 'tool_builder' ) ) : the_row();
                $tool = get_sub_field('tool_name');
                $description = get_sub_field('description');
                $file_name = get_sub_field('file_name');
                $title = get_sub_field('manual_name');
                $shop_area = get_sub_field('shop_area');
                $is_attachment = get_sub_field( 'add_attachment' ) == 1;
                echo $shop_area;
                $area = 'Something';
                // displays different icon based on shop location
                switch ( $shop_area )
                {
                    case '1';
                        $area = 'Wood Shop';
                    case '2';
                        $area = 'Machine Shop';
                    case '3';
                        $area = 'Fabrics';
                    case '4';
                        $area = 'Pottery';
                    case '5';
                        $area = 'Printing';
                    case '6';
                        $area = 'Laser';
                    default;
                        $area = 'Wood shop';
                        break;
                }
            ?>
            <div class="tooling-list" >
                <span class="" ><?php echo $tool ; ?></span>
                <span class="" ><?php echo $description; ?></span>

                <?php if ( $is_attachment ) : ?>
                    <?php
                    $upload_file = get_sub_field( 'upload_file' );
                    $url = $upload_file['url'];
                    $show_name = get_sub_field( 'manual_name' );
                    $type = substr($upload_file['filename'], -3); // grabs last three chars
                    $extension = strtoupper($type); // force to uppercase;
                    $size = size_format( filesize( get_attached_file( $upload_file['id'] ) ), 2 );
                   // $icon = file_get_contents("../assets/download.svg" );
                    // displays different icon based on type of document
                    
                    ?>
                    <?php if ( $upload_file ) : ?>

                    <button role="button" class="tooling-btn"  title="Download the manual: <?= $title; ?>" src="<?= esc_url( $url ); ?>"><span  class="tooling-icon" ></span>Manual</button>

                        
                    <?php endif; ?>
                <?php else : ?>
                    <span>No file</span>
                <?php endif; ?>

                <span><?= $area ?></span>
            </div>
        <?php endwhile; ?>
        <?php else : ?>
            <?php // No rows found ?>
        <?php endif; ?>
    </div>
</div><!-- .tooling -->

