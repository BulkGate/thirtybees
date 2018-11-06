<?php
namespace BulkGate\ThirtyBeesSms;

use BulkGate\Extensions, PrestaShopBundle;

/**
 * @author Lukáš Piják 2018 TOPefekt s.r.o.
 * @link https://www.bulkgate.com/
 */
class Helpers extends Extensions\Strict
{
    public static function installModuleTab($class, $name, $parent, $icon = '')
    {
        $tab = new \Tab();

        foreach(\Language::getLanguages() as $id => $language)
        {
            if(isset($language['id_lang']))
            {
                $tab->name[$language['id_lang']] = $name;
            }
        }

        $tab->class_name = $class;
        $tab->module = _BULKGATE_SLUG_;
        $tab->id_parent = $parent;
        $tab->icon = $icon;

        $tab->save();

        return $tab->id;
    }

    public static function uninstallModuleTab($class)
    {
        $id = \Tab::getIdFromClassName($class);

        if($id !== 0)
        {
            $tab = new \Tab($id);
            $tab->delete();
            return true;
        }
        return false;
    }

    public static function generateTokens()
    {
        $output = array();

        $result = \Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('SELECT `id_tab`, `class_name`, `module` FROM `'._DB_PREFIX_.'tab` WHERE `module` = \''._BULKGATE_SLUG_.'\'', true, false);

        if (is_array($result))
        {
            foreach ($result as $row)
            {
                $output[$row['class_name']] = \Tools::getAdminToken($row['class_name'].(int)$row['id_tab'].(int)\Context::getContext()->employee->id);
            }
        }
        return $output;
    }

    public static function installMenu(Extensions\Translator $translator)
    {
        $main = Helpers::installModuleTab('BULKGATE', $translator->translate('bulkgate', 'BulkGate'), 0,  'mail_outline');

        $dashboard = Helpers::installModuleTab('AdminBulkGateDashboardDefault', $translator->translate('dashboard','Dashboard'), $main);

        Helpers::installModuleTab('AdminBulkGateSmsCampaignNew', $translator->translate('start_campaign','Start Campaign'), $main);
        Helpers::installModuleTab('AdminBulkGateSmsCampaignDefault', $translator->translate('campaigns','Campaigns'), $main);
        Helpers::installModuleTab('AdminBulkGateInboxList', $translator->translate('inbox','Inbox'), $main);
        Helpers::installModuleTab('AdminBulkGateHistoryList', $translator->translate('history','History'), $main);
        Helpers::installModuleTab('AdminBulkGateStatisticsDefault', $translator->translate('statistics','Statistics'), $main);
        Helpers::installModuleTab('AdminBulkGateBlackListDefault', $translator->translate('black_list','Black list'), $main);
        Helpers::installModuleTab('AdminBulkGateSmsPriceList', $translator->translate('price_list', 'Price list'), $main);

        Helpers::installModuleTab('AdminBulkGateTopUp', $translator->translate('buy_credit', 'Buy credit'), $main);
        Helpers::installModuleTab('AdminBulkGatePaymentList', $translator->translate('invoices', 'Invoices'), $main);
        Helpers::installModuleTab('AdminBulkGateWalletDetail', $translator->translate('payments_data', 'Payments data'), $main);

        Helpers::installModuleTab('AdminBulkGateUserProfile',  $translator->translate('user_profile', 'User profile'), $main);
        Helpers::installModuleTab('AdminBulkGateModuleNotificationsAdmin',  $translator->translate('admin_sms', 'Admin SMS'), $main);
        Helpers::installModuleTab('AdminBulkGateModuleNotificationsCustomer',  $translator->translate('customer_sms', 'Customer SMS'), $main);
        Helpers::installModuleTab('AdminBulkGateSmsSettingsDefault',  $translator->translate('sender_id_profiles', 'Sender ID Profiles'), $main);
        Helpers::installModuleTab('AdminBulkGateModuleSettingsDefault', $translator->translate('module_settings', 'Module settings'), $main);

        Helpers::installModuleTab('AdminBulkGateAboutDefault', $translator->translate('about_module','About module'), $main);

        Helpers::installModuleTab('AdminBulkGateSignIn', 'SignIn', $dashboard);
        Helpers::installModuleTab('AdminBulkGateSignUp', 'SignUp', $dashboard);
        Helpers::installModuleTab('AdminBulkGateSmsCampaignCampaign', 'SmsCampaignCampaign', $dashboard);
        Helpers::installModuleTab('AdminBulkGateSmsCampaignActive', 'SmsCampaignActive', $dashboard);
        Helpers::installModuleTab('AdminBulkGateBlackListImport', 'BlackListImport', $dashboard);
    }

    public static function uninstallMenu()
    {
        Helpers::uninstallModuleTab('BULKGATE');

        Helpers::uninstallModuleTab('AdminBulkGateDashboardDefault');

        Helpers::uninstallModuleTab('AdminBulkGateSmsCampaignNew');
        Helpers::uninstallModuleTab('AdminBulkGateSmsCampaignDefault');
        Helpers::uninstallModuleTab('AdminBulkGateInboxList');
        Helpers::uninstallModuleTab('AdminBulkGateHistoryList');
        Helpers::uninstallModuleTab('AdminBulkGateStatisticsDefault');
        Helpers::uninstallModuleTab('AdminBulkGateBlackListDefault');
        Helpers::uninstallModuleTab('AdminBulkGateSmsPriceList');

        Helpers::uninstallModuleTab('AdminBulkGateTopUp');
        Helpers::uninstallModuleTab('AdminBulkGatePaymentList');
        Helpers::uninstallModuleTab('AdminBulkGateWalletDetail');

        Helpers::uninstallModuleTab('AdminBulkGateUserProfile');
        Helpers::uninstallModuleTab('AdminBulkGateModuleNotificationsAdmin');
        Helpers::uninstallModuleTab('AdminBulkGateModuleNotificationsCustomer');
        Helpers::uninstallModuleTab('AdminBulkGateSmsSettingsDefault');
        Helpers::uninstallModuleTab('AdminBulkGateModuleSettingsDefault');

        Helpers::uninstallModuleTab('AdminBulkGateAboutDefault');

        Helpers::uninstallModuleTab('AdminBulkGateSignIn');
        Helpers::uninstallModuleTab('AdminBulkGateSignUp');
        Helpers::uninstallModuleTab('AdminBulkGateSmsCampaignCampaign');
        Helpers::uninstallModuleTab('AdminBulkGateSmsCampaignActive');
        Helpers::uninstallModuleTab('AdminBulkGateBlackListImport');
    }

    public static function getOrderPhoneNumber($order_id)
    {
        $phone_number = null; $iso = null;

        $order = new \Order($order_id);
        $address_delivery = new \Address($order->id_address_delivery);

        $phone_number = $address_delivery->phone_mobile ?: $address_delivery->phone;

        $country = new \Country($address_delivery->id_country);

        $iso = strtolower($country->iso_code);

        if(empty(trim($phone_number)))
        {
            $address_invoice = new \Address($order->id_address_invoice);

            $phone_number = $address_invoice->phone_mobile ?: $address_invoice->phone;

            $country_invoice = new \Country($address_invoice->id_country);

            $iso = strtolower($country_invoice->iso_code);
        }

        return array($phone_number, $iso);
    }
}
