<?php

/**
 * Class which does all the heavy lifting on the product category screen
 */
class CBFS_Back
{

    /**
     * Initialize class functions
     *
     * @return void
     */
    public static function init()
    {
        // css and js
        add_action('admin_head', [__CLASS__, 'sbfs_scripts']);

        // product category custom meta
        add_filter('product_cat_add_form_fields', [__CLASS__, 'sbfs_add_cat_form_fields']);
        add_filter('product_cat_edit_form_fields', [__CLASS__, 'sbfs_add_cat_form_fields']);

        // save shipping meta
        add_action('edited_product_cat', [__CLASS__, 'sbfs_save_prod_cat_settings']);
        add_action('create_product_cat', [__CLASS__, 'sbfs_save_prod_cat_settings']);

    }

    /**
     * Backend JS and CSS
     *
     * @return void
     */
    private static function sbfs_scripts()
    {
    }

    /**
     * Add extra product category add screen
     *
     * @return array $columns
     */
    public static function sbfs_add_cat_form_fields()
    { ?>
        <div class="form-field">
            <label for="sbfs_free_shipping">
                <input type="checkbox" name="sbfs_free_shipping" id="sbfs_free_shipping">
                <?php pll_e('Offer free shipping for this category'); ?>
            </label>
            <p class="description"><?php pll_e('Check this box to offer free shipping for this product category.'); ?></p>
        </div>
    <?php }

    /**
     * Add extra product category edit screen
     *
     * @return array $columns
     */
    public static function sbfs_add_cat_edit_form_fields($term)
    {
        // get term id
        $term_id = $term->term_id;

        // retrieve existing values
        $free_shipping_val = get_term_meta($term_id, 'sbfs_free_shipping', true);

    ?>
        <div class="form-field">
            <label for="sbfs_free_shipping">
                <input type="checkbox" name="sbfs_free_shipping" id="sbfs_free_shipping">
                <?php pll_e('Offer free shipping for this category'); ?>
            </label>
            <p class="description"><?php pll_e('Check this box to offer free shipping for this product category.'); ?></p>
        </div>
<?php }

    /**
     * Save product cat free shipping data
     *
     * @return array $terms
     */
    public static function sbfs_save_prod_cat_settings($term_id)
    {
        // get submitted val
        $free_ship_val = filter_input(INPUT_POST, 'sbfs_free_shipping');

        // save submitted val
        update_term_meta($term_id, 'sbfs_free_shipping', $free_ship_val);
    }
}

CBFS_Back::init();
