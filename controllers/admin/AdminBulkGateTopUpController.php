<?php

require_once __DIR__.'/../../thirtybees/src/init.php';

use BulkGate\ThirtyBeesSms, BulkGate\Extensions;

/**
 * @author Lukáš Piják 2018 TOPefekt s.r.o.
 * @link https://www.bulkgate.com/
 */
class AdminBulkGateTopUpController extends BulkGateController
{
    public function __construct()
    {
        parent::__construct();
        $this->meta_title = $this->_('top_up', 'Top up');
    }

    public function renderView()
    {
        if(_BULKGATE_DEMO_)
        {
            \Tools::redirectAdmin($this->context->link->getAdminLink('AdminBulkGateDashboardDefault'));
        }
        return $this->bulkGateView("Top", "up", true);
    }
}
