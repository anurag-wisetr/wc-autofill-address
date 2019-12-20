<div class="wrap woocommerce">
    <?php do_action( 'admin_notices' ); ?>
    <h2>Settings</h2>
    <form action="options.php" method="post">
        <?php 	settings_fields('waa_autofill_settings');
                do_settings_sections('waa_autofill_settings');
        ?>
        <table class="form-table">
            <tbody>
                <tr valign="top">
                    <th scope="row" class="titledesc">
                        <label for="api_key">Google Map API Key</label>
                    </th>
                    <td class="forminp forminp-text">
                        <input name="waa_google_map_api_key" type="text"  class="regular-text" value="<?php echo !empty(get_option('waa_google_map_api_key'))?get_option('waa_google_map_api_key'):'';?>">
                    </td>
                </tr>
                <tr>
                    <td>
                        <?php submit_button(); ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>