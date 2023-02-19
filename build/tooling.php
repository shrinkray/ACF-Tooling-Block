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
            <?php while ( have_rows( 'tool_builder' ) ) : the_row();
                $tool = get_sub_field('tool_name');
                $description = get_sub_field('description');
                $file_name = get_sub_field('file_name');
                $title = get_sub_field('manual_name');
                $shop_area = get_sub_field('shop_area');
                $is_attachment = get_sub_field( 'add_attachment' ) == 1;
            ?>
            <div class="" style="width: 100%; display: inline-grid; grid-template-columns: 1fr 1fr 1fr 1fr; border-bottom: 1px solid red;">
                <span class="" style="white-space: wrap;"><?php echo $tool ; ?></span>
                <span class="" style="white-space: wrap;"><?php echo $description; ?></span>

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
                    <?php if ( $upload_file ) : ?>
                        <span>

                                <a href="<?= esc_url( $url ); ?>" title="Download the manual: <?= $title; ?>">
                                    <?php

                                    ?>
                                    <img alt="download icon" src="../build/assets/download.svg"/>
                                </a>

                        </span>
                        <span><?= $area ?></span>
                    <?php endif; ?>
                <?php else : ?>
                    <span style="justify-self: flex-end;">No file</span>
                    <span><?= $area ?></span>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
        <?php else : ?>
            <?php // No rows found ?>
        <?php endif; ?>
    </div>
</div><!-- .tooling -->

