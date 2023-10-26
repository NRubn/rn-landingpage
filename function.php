<?php
/*
Plugin Name: RN Landingpages
Description: Landingpages-Plugin 
Version: 0.0.01 Beta 2023
Author: Ruben Norgall www.ruben-norgall.de
*/

// Füge ein Menü im WordPress-Backend hinzu
function rn_landingpages_menu() {
    add_menu_page(
        'My Landingpages',
        'My Landingpages',
        'manage_options',
        'my-landingpage-plugin',
        'landingpage_site_setting_page',
        'dashicons-car'
    );
}

add_action('admin_menu', 'rn_landingpages_menu');

// Erstelle die Backend-Seite
function landingpage_site_setting_page() {
    // Überprüfe, ob der Benutzer die erforderlichen Berechtigungen hat
    if (!current_user_can('manage_options')) {
        wp_die('Du hast keine Berechtigung, auf diese Seite zuzugreifen.');
    }
    // Verarbeite Formulardaten, wenn das Formular gesendet wird

    if (isset($_POST['landingpage_controll'])) {
        $aktiv = isset($_POST['landingpage_controll']['aktiv_option']) ? 1 : 0;
        update_option('landingpage_controll', $aktiv);
        echo '<div class="updated"><p>Einstellungen gespeichert.</p></div>';
    }

    // Lese die aktuelle Option "aktiv"
    $aktiv_option = get_option('landingpage_controll', 0);

    // Formularausgabe
    ?>
    <div class="wrap">
        <h2>Meine Landingpages Einstellungen</h2>
        <p>benutzerdefinierte Einstellungen</p>
        
        <?php
            var_dump(get_option('landingpage_controll'));
        ?>

        <form method="post">
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Aktiv</th>
                    <td>
                        <label>
                            <input type="checkbox" name="landingpage_controll[aktiv_option]" <?php checked(1, $aktiv_option); ?>>
                            Aktivieren
                        </label>
                    </td>
                </tr>
            </table>
            <input type="hidden" name="landingpage_controll[submit]" value="1">
            <?php submit_button('Einstellungen speichern'); ?>
        </form>
            
        </form>
    </div>
    <?php
}

// Füge benutzerdefinierte Einstellungen hinzu und verarbeite sie
// Du kannst hier Formularverarbeitung und Speichern von Einstellungen hinzufügen

// Zum Beispiel:
 function save_landingpages_backend_einstellungen() {
     if (isset($_POST['landingpages-menu'])) {
         update_option('landingpage_controll', $_POST['landingpages-menu']);
     }
}
add_action('admin_post_speichere_einstellungen', 'save_landingpages_backend_einstellungen');

// POST TYPE
function create_landingpage_posttype() {
    $labels = array(
        'name'               => 'Landingpages',
        'singular_name'      => 'Landingpage',
        'menu_name'          => 'Landingpages',
        'add_new'            => 'Neue Landingpage hinzufügen',
        'add_new_item'       => 'Neue Landingpage hinzufügen',
        'edit'               => 'Bearbeiten',
        'edit_item'          => 'Landingpage bearbeiten',
        'new_item'           => 'Neue Landingpage',
        'view'               => 'Anzeigen',
        'view_item'          => 'Landingpage anzeigen',
        'search_items'       => 'Landingpages durchsuchen',
        'not_found'          => 'Keine Landingpages gefunden',
        'not_found_in_trash' => 'Keine Landingpages im Papierkorb gefunden',
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'has_archive'         => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'query_var'           => true,
        'capability_type'     => 'post',
        'hierarchical'        => false,
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-money-alt',
        'supports'            => array('title', 'editor', 'thumbnail', 'excerpt', 'custom-fields'),
    );

    register_post_type('rn_landingpage', $args);
}

add_action('init', 'create_landingpage_posttype');