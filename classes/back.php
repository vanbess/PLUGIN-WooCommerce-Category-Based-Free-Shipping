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
        add_filter('product_cat_edit_form_fields', [__CLASS__, 'sbfs_add_cat_edit_form_fields']);

        // save shipping meta
        add_action('edited_product_cat', [__CLASS__, 'sbfs_save_prod_cat_settings']);
        add_action('create_product_cat', [__CLASS__, 'sbfs_save_prod_cat_settings']);
    }

    /**
     * Add extra product category add screen
     *
     * @return array $columns
     */
    public static function sbfs_add_cat_form_fields()
    { ?>
        <tr class="form-field form-required">
            <th scope="row"><label for="name"><?php pll_e('Free Shipping'); ?></label></th>
            <td>
                <label for="sbfs_free_shipping"><?php pll_e('Offer free shipping for this category?'); ?></label>
                <select id="sbfs_free_shipping" name="sbfs_free_shipping" value="yes">
                    <option value="">Please select...</option>
                    <option value="yes"><?php pll_e('Yes'); ?></option>
                    <option value="no"><?php pll_e('No'); ?></option>
                </select>
                <p class="description"><?php pll_e('Specify whether or not free shipping should be offered on products in this category.'); ?></p>
            </td>
        </tr>
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
        <tr class="form-field form-required">
            <th scope="row"><label for="name"><?php pll_e('Free Shipping'); ?></label></th>
            <td>
                <label for="sbfs_free_shipping"><?php pll_e('Offer free shipping for this category?'); ?></label>
                <select id="sbfs_free_shipping" name="sbfs_free_shipping" curr_val="<?php print $free_shipping_val; ?>">
                    <option value="">Please select...</option>
                    <option value="yes"><?php pll_e('Yes'); ?></option>
                    <option value="no"><?php pll_e('No'); ?></option>
                </select>
                <p class="description"><?php pll_e('Specify whether or not free shipping should be offered on products in this category.'); ?></p>
            </td>
        </tr>

        <script>
            jQuery(function($) {
                var fs_select = $('#sbfs_free_shipping');
                var fs_curr = fs_select.attr('curr_val');
                fs_select.val(fs_curr);
            });
        </script>
<?php }

    /**
     * Save product cat free shipping data
     *
     * @return array $terms
     */
    public static function sbfs_save_prod_cat_settings($term_id)
    {
        // get submitted val
        $free_ship_val = $_POST['sbfs_free_shipping'];

        // save submitted val
        update_term_meta($term_id, 'sbfs_free_shipping', $free_ship_val);
    }
}

CBFS_Back::init();
