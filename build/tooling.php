<?php /**
 * Block template file: tooling.php
 *
 * Tooling Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
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

<style>
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
            <span class="heading-tool">Tool</span>
            <span class="heading-docs">Docs & Technical Specs</span>
            <span class="heading-desc">Use & Notes</span>
        </div>
            <?php while ( have_rows( 'tool_builder' ) ) : the_row();
                $tool = get_sub_field('tool_name');
                $description = get_sub_field('description');
                $notes = get_sub_field( 'notes' );
			?>


            <div class="tooling-list" >
<!--             Show Tool name   -->
                <div class="tooling-name" ><?php echo $tool ; ?></div>

<!--             Download Docs Column -->
                <div class="tooling-docs">

                    <?php if ( have_rows( 'add_docs' ) ) : ?>
                        <?php while ( have_rows( 'add_docs' ) ) : the_row();

                        $doc_name = get_sub_field( 'manual_name' );
                        $room     = get_sub_field( 'work_space' );
                        $type     = get_sub_field( 'sub_folder' );
                        $doc_file = get_sub_field( 'doc_file' );
                        $alt_file = get_sub_field( 'alt_file' );
                        $is_pdf   = get_sub_field( 'is_pdf' );
                        $doc_desc = get_sub_field( 'doc_desc' );
                        $site_url = site_url();

                        // if attached file is a pdf, we add extension, otherwise it's something else
                        $is_pdf ?
                            $doc_file = $doc_file . '.pdf' :
                            $doc_file = $alt_file;

                        // if type exists, insert in path, otherwise build path without
                        $type ?
                            $path = $site_url . '/manuals/' . $room . '/' . $type . '/'. $doc_file :
                            $path = $site_url . '/manuals/' . $room . '/' . $doc_file;


                        ?>

                            <?php if ( $path ) : ?>
                                <a
                                        class="tooling-btn pdf-tag"
                                        role="button"
                                        href="<?= esc_url( $path ) ; ?>"
                                        title="download <?= esc_html( $doc_desc ) ?>"
                                        aria-label="download <?= esc_html( $doc_desc ) ?>"><?= esc_html( $doc_name ) ?>
                                </a>
                            <?php endif; ?>

                        <?php endwhile; ?>
                    <?php else : ?>
                        <span class="" >
                            - -
                        </span>
                    <?php endif; ?>

                </div>
<!--                Display Description -->
                <div class="tooling-desc" >
                    <?= esc_html( $description ); ?>
                    <mark><?= $notes ? '<strong>Notes:&nbsp;</strong>' . esc_html( $notes ) : '' ?></mark>
                </div>

            </div>
        <?php endwhile; ?>
        <?php else : ?>
            <?php // No rows found ?>
        <?php endif; ?> <!-- end tool builder -->

</div><!-- .tooling -->

