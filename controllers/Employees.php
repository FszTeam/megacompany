<?php namespace FszTeam\MegaCompany\Controllers;

use BackendMenu;
use Flash;
use FszTeam\MegaCompany\Models\Employee;
use Lang;

/**
 * Employees Back-end Controller
 */
class Employees extends Controller
{

    public $requiredPermissions = ['fszteam.megacompany.access_employees'];

    public function __construct()
    {
        parent::__construct();

        BackendMenu::setContext('FszTeam.MegaCompany', 'megacompany', 'employees');
    }

    /**
     * Deleted checked employees.
     */
    public function index_onDelete()
    {
        if (($checkedIds = post('checked')) && is_array($checkedIds) && count($checkedIds)) {

            foreach ($checkedIds as $employeeId) {
                if (!$employee = Employee::find($employeeId)) {
                    continue;
                }

                $employee->delete();
            }

            Flash::success(Lang::get('fszteam.megacompany::lang.employees.delete_selected_success'));
        } else {
            Flash::error(Lang::get('fszteam.megacompany::lang.employees.delete_selected_empty'));
        }

        return $this->listRefresh();
    }
}
