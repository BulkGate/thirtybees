<?php

require_once __DIR__.'/../../thirtybees/src/init.php';

use BulkGate\ThirtyBeesSms, BulkGate\Extensions;

/**
 * @author Lukáš Piják 2018 TOPefekt s.r.o.
 * @link https://www.bulkgate.com/
 */
class AdminBulkGateStatisticsDefaultController extends BulkGateController
{
    public function __construct()
    {
        parent::__construct();
        $this->meta_title = $this->_('statistics', 'Statistics');
    }

    public function renderView()
    {
        return $this->bulkGateView("Statistics", "default", true);
    }
}
