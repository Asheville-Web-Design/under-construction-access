<?php
/*
Plugin Name: Under Construction Access
Plugin URI: https://ashevillewebdesign.com
Description: Blocks access to the site and requires a password to view pages.
Version: 1.1
Author: Chris White
Author URI: https://ashevillewebdesign.com
*/

if (!session_id()) {
    session_start();
}

// Add settings page
function uc_settings_page() {
    add_submenu_page(
        'tools.php',
        'Under Construction Settings',
        'Under Construction',
        'manage_options',
        'uc-settings',
        'uc_settings_page_html'
    );
}
add_action('admin_menu', 'uc_settings_page');

// Register settings
function uc_register_settings() {
    register_setting('uc_options_group', 'uc_h1_text');
    register_setting('uc_options_group', 'uc_password');
    register_setting('uc_options_group', 'uc_dev_icon');
    register_setting('uc_options_group', 'uc_dev_credit');
    register_setting('uc_options_group', 'uc_dev_url');
}
add_action('admin_init', 'uc_register_settings');

// Settings page HTML
function uc_settings_page_html() {
    ?>
    <div class="wrap">
        <h1>Under Construction Settings</h1>
        <form method="post" action="options.php">
            <?php settings_fields('uc_options_group'); ?>
            <?php do_settings_sections('uc-options-group'); ?>
            <table class="form-table">
                <tr>
                    <th><label for="uc_h1_text">Heading Text</label></th>
                    <td><input type="text" id="uc_h1_text" name="uc_h1_text" value="<?php echo esc_attr(get_option('uc_h1_text', 'This Site Is Currently Under Construction')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="uc_password">Access Password</label></th>
                    <td><input type="text" id="uc_password" name="uc_password" value="<?php echo esc_attr(get_option('uc_password', 'viewdev')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="uc_dev_icon">Developer Icon URL</label></th>
                    <td><input type="text" id="uc_dev_icon" name="uc_dev_icon" value="<?php echo esc_attr(get_option('uc_dev_icon', '')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="uc_dev_credit">Developer Credit</label></th>
                    <td><input type="text" id="uc_dev_credit" name="uc_dev_credit" value="<?php echo esc_attr(get_option('uc_dev_credit', '')); ?>" class="regular-text"></td>
                </tr>
                <tr>
                    <th><label for="uc_dev_url">Developer URL</label></th>
                    <td><input type="text" id="uc_dev_url" name="uc_dev_url" value="<?php echo esc_attr(get_option('uc_dev_url', '')); ?>" class="regular-text"></td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}

// Restrict access unless logged in or session granted
function uc_restrict_access() {
    if (is_user_logged_in() || is_admin() || preg_match('/wp-admin|wp-login.php/', $_SERVER['REQUEST_URI'])) {
        return;
    }
    
    $stored_password = get_option('uc_password', 'viewdev');
    $h1_text = get_option('uc_h1_text', 'This Site Is Currently Under Construction');
    $dev_icon = get_option('uc_dev_icon', '');
    $dev_credit = get_option('uc_dev_credit', '');
    $dev_url = get_option('uc_dev_url', '');
    
    if (!isset($_SESSION['uc_access_granted']) || $_SESSION['uc_access_granted'] !== true) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uc_password'])) {
            if ($_POST['uc_password'] === $stored_password) {
                $_SESSION['uc_access_granted'] = true;
                wp_redirect(home_url());
                exit;
            }
        }

        echo '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Under Construction</title>
            <style>
                h1 { margin-bottom: 0px; }
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                .container { max-width: 400px; margin: auto;row-gap: 35px; display: flex; flex-direction: column; align-items: center; background: #f9f9f9; border: 1px solid #f2f2f2; border-radius: 30px;}
                form { display: flex; flex-direction: row; column-gap: 0px; margin: 30px 0px; }
                button { padding: 10px 30px;cursor: pointer;background: #000;color: #fff;border: 0px;border-top-right-radius: 20px;border-bottom-right-radius: 20px;text-transform: uppercase; }
                input { padding: 10px;border-radius: 0px !important; border: 1px solid; }
                .credits a { text-decoration: none; color: inherit; }
                .credits img { vertical-align: middle; margin-right: 5px; max-width: 30px ;height: auto; }
                .credits { font-size: 14px; display: flex; flex-direction: row; align-content: center; width: 100%; background: #2e2e2e; color: #fff; justify-content: center; align-items: center; padding: 10px 0px; border-bottom-left-radius: 30px; border-bottom-right-radius: 30px; }
            </style>
        </head>
        <body>
            <div class="container">
                <h1>' . esc_html($h1_text) . '</h1>
                <form method="post">
                    <input type="password" name="uc_password" placeholder="Enter Password" required>
                    <button type="submit">Submit</button>
                </form>';
                
                if (!empty($dev_credit)) {
                    echo '<div class="credits">';
                    if (!empty($dev_icon)) {
                        echo '<a href="' . esc_url($dev_url) . '" target="_blank"><img src="' . esc_url($dev_icon) . '" alt="Web Design by ' . esc_html($dev_credit) . '"></a> ';
                    }
                    if (!empty($dev_credit)) {
                        echo '<a href="' . esc_url($dev_url) . '" target="_blank">' . esc_html($dev_credit) . '</a>';
                    }
                    echo '</div>';
                }
        echo '</div></body></html>';
        exit;
    }
}
add_action('template_redirect', 'uc_restrict_access');
