<?php

/**
 * Class which does all the heavy lifting on the frontend
 */
class CBFS_Front
{

    /**
     * Constructor
     */
    public function __construct()
    {
        // display free shipping icon on product page
        add_action('woocommerce_single_product_summary', [__CLASS__, 'cbfs_display']);
    }

    /**
     * Display free shipping icon for relevant products
     *
     * @return void
     */
    public static function cbfs_display()
    {
        // get product id
        $product_id = get_the_ID();

        // get term ids
        $terms_ids = wp_get_post_terms($product_id, 'product_cat', ['fields' => 'ids', 'parent' => '0']);

        // build free shipping data array using loop
        $fs_data = [];

        foreach ($terms_ids as $term_id) :
            $fs_data[] = get_term_meta($term_id, 'sbfs_free_shipping', true);
        endforeach;

        // if 'yes' found in $fs_data, display free shipping icon
        if (in_array('yes', $fs_data)) { ?>
            <div class="free-ship-info">
                <span>
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 612 612" style="enable-background:new 0 0 24 24;display:inline-block;vertical-align: middle;margin-right:5px;margin-bottom:3px" xml:space="preserve">
                        <path d="M612,327.56v-21.606c0-10.533-4.213-20.628-11.701-28.037L484.107,162.958c-7.384-7.306-17.352-11.403-27.739-11.403
      h-58.622v-21.988c0-16.336-13.243-29.58-29.58-29.58H29.58C13.243,99.987,0,113.23,0,129.567V327.56H612z M432.551,190.303
      c0-2.563,2.071-4.634,4.635-4.634h21.396c1.184,0,2.366,0.494,3.253,1.282l91.006,86.865c3.057,2.86,0.986,7.987-3.154,7.987
      h-112.5c-2.563,0-4.635-2.07-4.635-4.634V190.303z M612,343.903v65.486c0,16.336-13.243,29.578-29.579,29.578h-31.65
      c-5.719-39.242-39.539-69.412-80.357-69.412c-40.721,0-74.54,30.17-80.259,69.412h-160.42
      c-5.718-39.242-39.538-69.412-80.259-69.412c-40.721,0-74.541,30.17-80.259,69.412H29.58C13.243,438.968,0,425.726,0,409.39
      v-65.486H612z M470.456,389.313c-33.883,0-61.351,27.467-61.351,61.35s27.469,61.35,61.351,61.35s61.35-27.467,61.35-61.35
      S504.339,389.313,470.456,389.313z M470.456,481.339c-16.941,0-30.675-13.734-30.675-30.676s13.732-30.674,30.675-30.674
      c16.941,0,30.676,13.732,30.676,30.674S487.397,481.339,470.456,481.339z M149.464,389.313c-33.883,0-61.35,27.467-61.35,61.35
      s27.468,61.35,61.35,61.35s61.35-27.467,61.35-61.35S183.346,389.313,149.464,389.313z M149.464,481.339
      c-16.941,0-30.676-13.734-30.676-30.676s13.734-30.674,30.676-30.674c16.941,0,30.675,13.732,30.675,30.674
      S166.405,481.339,149.464,481.339z" />
                    </svg>
                    <span class="free-shipping-icon"><?php pll_e('Free Shipping'); ?>'</span>
                </span>
            </div>
<?php }
    }
}

new CBFS_Front;
