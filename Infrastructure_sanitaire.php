<?php 
/**
 * Plugin Name
 *
 * @package           PluginPackage
 * @author            TIC-ABC
 * @copyright         2020 TIC ABC
 * @license           GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name:       infrastructure sanitaire plugin
 * Plugin URI:        https://developper.buidigit.com
 * Description:       Grâce à ce plugin vous pourriez ajouter n'importe où sur votre plateforme web des cartes map situants des hopitaux et des pharmacies à proximité du client qui consulte votre carte 
 * Version:           1.1.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            TIC-ABC
 * Author URI:        https://developper.buidigit.com
 * Text Domain:       plugin-slug
 * License:           GPL v2 or later
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */
require_once( plugin_dir_path(__FILE__) . '/google_map/Tp-GkeyAndApi.php');	
function afficherTexte() {

$monTexte = "Texte provenant de mon shortcode";

}

add_shortcode('nomShortcode', 'afficherTexte');
function fonction_shortcode_carte_sanitaire($width,$height) {
    $show_map=[];
    if (empty($width)) {
        $width='50%';
        $show_map[0]=$width;
    }
    if (empty($height)) {
        $height='50%';
        $show_map[1]=$height;
    }
    show_map_if_user_give_location();
    $show_map=[];
    if (empty($width)) {
        $width='50%';
        $show_map[0]=$width;
    }
    if (empty($height)) {
        $height='50%';
        $show_map[1]=$height;
    }
    return show_map_if_user_give_location();

}

add_shortcode('carte_sanitaire','fonction_shortcode_carte_sanitaire');
