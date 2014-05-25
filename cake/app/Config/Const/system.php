<?php

if(env('HTTP_HOST') == 'api.cospradar.padule.me') {
    define('DB_USER', 'root');
    define('DB_PASSWORD', '');
} else {
    define('DB_USER', 'mokyu');
    define('DB_PASSWORD', '');
    Configure::write('debug', 2);

}