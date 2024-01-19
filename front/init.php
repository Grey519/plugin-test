<?php
function shortcode_form_template()
{
    $html ="";
    ob_start();
    $html = require_once(PLUGIN_DIR . 'front/form-template.php');
    return ob_get_clean();
}

add_shortcode('form-template', 'shortcode_form_template');

require_once PLUGIN_DIR . 'front/form-hundle.php';