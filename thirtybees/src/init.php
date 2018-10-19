<?php
/**
 * @author Lukáš Piják 2018 TOPefekt s.r.o.
 * @link https://www.bulkgate.com/
 */

define('_BULKGATE_DIR_', __DIR__.'/../../');

define('_BULKGATE_NAME_', 'BulkGate');
define('_BULKGATE_AUTHOR_', 'TOPefekt s.r.o.');
define('_BULKGATE_AUTHOR_URL_', 'https://www.bulkgate.com/');
define('_BULKGATE_PS_MIN_VERSION_', '1.0.0.0');
define('_BULKGATE_SLUG_', 'bulkgate_thirtybees');
define('_BULKGATE_VERSION_', '1.0.0');
define('_BULKGATE_DEMO_', false);

if(!file_exists(_BULKGATE_DIR_.'/extensions/src/_extension.php'))
{
    echo 'BulkGate: BulkGate extensions (https://github.com/BulkGate/extensions) must be installed.';
    exit;
}

require_once _BULKGATE_DIR_.'/extensions/src/_extension.php';
require_once __DIR__.'/_extension.php';

file_exists(_BULKGATE_DIR_.'/extensions/src/debug.php') && require_once _BULKGATE_DIR_.'/extensions/src/debug.php';

require_once _BULKGATE_DIR_.'/controllers/admin/BulkGateController.php';