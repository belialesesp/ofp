<?php
/**
 * Let's Connect Block
 * Note: ACF fields managed via ACF UI.
 * Has admin_head CSS to hide the ACF accordion field.
 */
class OFP_Block_Lets_Connect extends OFP_Block_Base {
    protected string $name        = 'lets-connect';
    protected string $title       = "Let's Connect";
    protected string $description = "Block to show a Let's Connect.";
    protected string $icon        = 'share';
    protected array  $keywords    = [ 'social', 'connect', 'links' ];

    public function admin_styles(): void {
        $screen = get_current_screen();
        if ( ! $screen || ( ! $screen->is_block_editor() && $screen->base !== 'post' ) ) {
            return;
        }
        ?>
        <style>
            div.acf-field.acf-field-accordion[data-key="field_lcb_accordion"],
            .acf-field[data-key="field_lcb_accordion"] { display: none !important; }
        </style>
        <?php
    }
}