/*
Plugin Name: RN Landingpages
Description: Landingpages-Plugin 
Version: 0.0.01 Beta 2023
Author: Ruben Norgall www.ruben-norgall.de
*/

// Hier kannst du Funktionen und Hooks hinzufügen

// Eine einfache Funktion, die "Hello, WordPress!" ausgibt
function hello_wordpress() {
    echo "Hello, WordPress!";
}

// Hook, um die Funktion in den Seiteninhalt einzufügen
add_action('the_content', 'hello_wordpress');
