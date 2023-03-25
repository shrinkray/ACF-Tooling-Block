<?php
/**
 * Block template file: rental.php
 *
 * Rental Block Template.
 *
 * @param   array $block The block settings and attributes.
 * @param   string $content The block inner HTML (empty).
 * @param   bool $is_preview True during AJAX preview.
 * @param   (int|string) $post_id The post ID this block is saved to.
 */

// The get_block_wrapper_attributes() is a requirement. Want think about whatnew attributes we might need.

$wrapper_attributes = get_block_wrapper_attributes(
    [
        'class' => 'tooling'
    ]
);
?>



<div <?= $wrapper_attributes ?>>

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
    <div <?= $wrapper_attributes; ?>>

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

                    <div class="tooling-name" ><?= $tool ?></div>


                    <div class="tooling-docs">

                        <?php if ( have_rows( 'add_docs' ) ) : ?>
                            <?php while ( have_rows( 'add_docs' ) ) : the_row();

                                $doc_name   = get_sub_field( 'manual_name' );
                                $room       = get_sub_field( 'work_space' );
                                $subfolder  = get_sub_field( 'sub_folder' );
                                $doc_file   = get_sub_field( 'doc_file' );
                                $doc_desc   = get_sub_field( 'doc_desc' );
                                $site_url   = site_url();

                                // returns the file extension
                                $extension = pathinfo($doc_file, PATHINFO_EXTENSION);

                                // if type exists, insert in path, otherwise build path without
                                $subfolder ?
                                    $path = $site_url . '/manuals/' . $room . '/' . $subfolder . '/'. $doc_file :
                                    $path = $site_url . '/manuals/' . $room . '/' . $doc_file;

                                // Build the download link based on derived info
                                ?>

                                <?php if ( $path ) : ?>
                                    <a
                                            class="tooling-btn <?= $extension ?>"
                                            role="button"
                                            href="<?= esc_url( $path ) ; ?>"
                                            title="Open <?= esc_html( $doc_desc ) ?>"
                                            aria-label="Open <?= esc_html( $doc_desc ) ?>" target="_blank" >
                                        <?= esc_html( $doc_name ) ?>
                                    </a>
                                <?php endif; ?>

                            <?php endwhile; ?>
                        <?php else : ?>

                        <?php endif; ?>
                    </div>

                    <div class="tooling-desc" >
                        <?= esc_html( $description ); ?>
                        <?=
                        $notes ?
                            '<mark><strong>Notes:&nbsp;</strong>' . esc_html( $notes ) . '</mark>' :
                            ''
                        ?>
                    </div>

                </div>
            <?php endwhile; ?>
            <?php else : ?>
                <?php // No rows found ?>
            <?php endif; // end tool builder ?>

        </div>



    </div>
