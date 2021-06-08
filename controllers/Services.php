<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use FszTeam\MegaCompany\Models\Service;
use Lang;

/**
 * Services Back-end Controller
 */
class Services extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_services'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'services');
    }

    /**
     * Deleted checked services.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $serviceId) {
                if (!$service = Service::find($serviceId)) {
                    continue;
                }

                $service->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.services.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.services.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
