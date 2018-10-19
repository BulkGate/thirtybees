<?php

require_once __DIR__.'/../../thirtybees/src/init.php';

use BulkGate\ThirtyBeesSms, BulkGate\Extensions;

/**
 * @author Lukáš Piják 2018 TOPefekt s.r.o.
 * @link https://www.bulkgate.com/
 */
class AdminBulkGateModuleNotificationsAdminController extends BulkGateController
{
    public function __construct()
    {
        parent::__construct();
        $this->meta_title = $this->_('admin_sms', 'Admin SMS');
    }

    public function renderView()
    {
        $this->ps_proxy->add('save', 'save');
        return $this->bulkGateView("ModuleNotifications", "admin", true);
    }

    public function ajaxProcessSave()
    {
        Extensions\JsonResponse::send(
            $this->ps_di->getProxy()->saveAdminNotifications(Tools::getValue('__bulkgate'))
        );
    }
}
