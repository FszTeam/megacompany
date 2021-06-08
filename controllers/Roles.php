<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use FszTeam\MegaCompany\Models\Role;
use Lang;

/**
 * Roles Back-end Controller
 */
class Roles extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_employees'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'roles');
    }

    /**
     * Deleted checked roles.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $roleId) {
                if (!$role = Role::find($roleId)) {
                    continue;
                }

                $role->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.roles.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.roles.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
