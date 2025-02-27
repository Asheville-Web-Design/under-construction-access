<?php
/*
Plugin Name: Under Construction Access
Plugin URI: https://hchad.com
Description: Blocks access to the site and requires a password to view pages.
Version: 1.0
Author: Chris White
Author URI: https://hchad.com
*/

if (!session_id()) {
    session_start();
}

function uc_restrict_access() {
    if (is_user_logged_in()) {
        return;
    }
    
    if (!isset($_SESSION['uc_access_granted']) || $_SESSION['uc_access_granted'] !== true) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uc_password'])) {
            if ($_POST['uc_password'] === 'viewdev') {
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
                body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
                .container { max-width: 400px; margin: auto; }
                .container {
    display: flex
;
    flex-direction: column;
    align-items: center;
    align-content: center;
}
form {
    display: flex
;
    flex-direction: row;
    column-gap: 20px;
}
button {
    padding: 10px 30px;
    cursor: pointer;
}
input {
    padding: 10px;
}
            </style>
        </head>
        <body>
            <div class="container">
                <h1>This Site Is Currently Under Construction</h1>
                <form method="post">
                    <input type="password" name="uc_password" placeholder="Enter Password" required>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </body>
        </html>';
        exit;
    }
}
add_action('template_redirect', 'uc_restrict_access');
