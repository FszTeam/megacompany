<?php namespace FszTeam\MegaCompany\Components;

use FszTeam\MegaCompany\Models\Employee as EmployeeModel;
use Cms\Classes\ComponentBase;

class Employee extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Employee Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onRun(){
        $slug= $this->param('slug');
        $this->page['employee']=EmployeeModel::where('slug',$slug)->first();
        $this->addCss('/plugins/fszteam/megacompany/assets/employees/css/employee.css');
        $this->addCss('/plugins/fszteam/megacompany/assets/employees/js/employee.js');
    }
}
