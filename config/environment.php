<?php

/**
 * Set environment specific settings here.
 */

switch (APP_ENV) {
    case 'production':
        ini_set('display_errors', 0);
        break;
    case 'test':
        ini_set('display_errors', 1);
        break;
    case 'development':
    default:
        ini_set('display_errors', 1);
        break;
}

?>
