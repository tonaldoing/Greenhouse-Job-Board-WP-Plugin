<?php

// Register settings
function greenhouse_register_settings() {
    add_option('greenhouse_show_search', 'yes');
    add_option('greenhouse_board_token');
    
    register_setting('greenhouse_options_group', 'greenhouse_show_search');
    register_setting('greenhouse_options_group', 'greenhouse_board_token');
}
add_action('admin_init', 'greenhouse_register_settings');

// Add the admin menu
function greenhouse_add_admin_menu() {
    add_menu_page(
        'Job Board',
        'Job Board',
        'manage_options',
        'greenhouse-settings',
        'greenhouse_settings_page',
        'dashicons-businessperson',
    );
}
add_action('admin_menu', 'greenhouse_add_admin_menu');

// Handle cache clearing action
function greenhouse_clear_cache() {
    if (isset($_POST['clear_cache'])) {
        delete_transient('greenhouse_jobs');
        echo '<div class="updated"><p>Greenhouse jobs cache cleared successfully!</p></div>';
    }
}

// Admin settings page content
function greenhouse_settings_page() {
    ?>
    <div class="wrap">
        <h1>Greenhouse Plugin Settings</h1>

        <!-- Form to update settings -->
        <form method="post" action="options.php">
            <?php
            // Output security fields for the settings group
            settings_fields('greenhouse_options_group');
            ?>
            <table class="form-table">
                <tr>
                    <th scope="row">Job Board Token</th>
                    <td><input type="text" name="greenhouse_board_token" value="<?php echo esc_attr(get_option('greenhouse_board_token')); ?>" /></td>
                </tr>
                <tr>
                    <th scope="row">Display search bar</th>
                    <td>
                        <select name="greenhouse_show_search">
                            <option value="yes" <?php selected(get_option('greenhouse_show_search'), 'yes'); ?>>Yes</option>
                            <option value="no" <?php selected(get_option('greenhouse_show_search'), 'no'); ?>>No</option>
                        </select>
                    </td>
                </tr>
            </table>

            <?php
            // Output save settings button
            submit_button();
            ?>
        </form>
    </div>
    <?php
    greenhouse_clear_cache();
}
