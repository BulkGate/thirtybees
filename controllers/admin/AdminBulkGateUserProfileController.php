<?php

require_once __DIR__.'/../../thirtybees/src/init.php';

use BulkGate\ThirtyBeesSms, BulkGate\Extensions;

/**
 * @author Lukáš Piják 2018 TOPefekt s.r.o.
 * @link https://www.bulkgate.com/
 */
class AdminBulkGateUserProfileController extends BulkGateController
{
    public function __construct()
    {
        parent::__construct();
        $this->meta_title = $this->_('user_profile', 'User profile');
    }

    public function renderView()
    {
        return $this->bulkGateView("User", "profile", false);
    }
}
