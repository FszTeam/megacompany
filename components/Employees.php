<?php namespace FszTeam\MegaCompany\Components;
use Cms\Classes\Page;
use FszTeam\MegaCompany\Models\Employee;
use Illuminate\Support\Facades\Lang;
use FszTeam\MegaCompany\Models\Role;
use Redirect;

class Employees extends Component
{
    public $table = 'fszteam_company_employees';
    public $profilePage;

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.employees.name',
            'description' => 'fszteam.megacompany::lang.components.employees.description',
        ];
    }

    public function onRun()
    {
        $this->profilePage = $this->page['profilePage'] = $this->property('profilePage');
        //$this->page['employee'] = $this->employee();
        $this->page['employees'] = $this->employees();
                // Page links
    }

    public function employee()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Employee::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture')
                ->first();
        }
    }

    public function employees()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;

            $employees = Employee::published()->with('picture');

            if ($this->property('filterRole')) {
                $id_attribute = $this->property('roleIdentifier', 'id');
                $employees->whereHas('roles', function ($query) use ($id_attribute) {
                    $query->where($id_attribute, '=', $this->property('filterRole'));
                })->with('roles');
            }

            $employees = $employees->orderBy(
                $this->property('orderBy', 'id'),
                $this->property('sort', 'desc'))->take($this->property('maxItems'));

            $employees_list = $this->list = $this->property('paginate') ?
                $employees->paginate($this->property('perPage'), $this->property('page')) :
                $employees->get();
                
            $employees_list->each(function($post) {
                $post->setUrl($this->profilePage, $this->controller);

            });
    
            return $employees_list;    
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();
        $properties['roleIdentifier'] = [
            'title' => 'fszteam.megacompany::lang.roles.role_identifier',
            'description' => 'fszteam.megacompany::lang.descriptions.role_identifier',
            'type' => 'dropdown',
            'options' => ['id' => 'id', 'slug' => 'slug'],
            'default' => 'id',
            'group' => 'fszteam.megacompany::lang.labels.filters',
        ];
        $properties['profilePage'] = [
            'title' => 'Profile Page',
            'description' => 'Profile Page',
            'type' => 'dropdown',
            'default'     => 'profile',
            'group' => 'fszteam.megacompany::lang.labels.links',
        ];
        $properties['filterRole'] = [
            'title' => 'fszteam.megacompany::lang.roles.menu_label',
            'description' => 'fszteam.megacompany::lang.descriptions.filter_roles',
            'type' => 'dropdown',
            'group' => 'fszteam.megacompany::lang.labels.filters',
        ];
        return $properties;
    }

    public function getProfilePageOptions()
    {
        return Page::sortBy('baseFileName')->lists('baseFileName', 'baseFileName');
    }

    public function getFilterRoleOptions()
    {
        $options = [Lang::get('fszteam.megacompany::lang.labels.show_all')];
        $roles = Role::has('employees')->get();
        $id_attribute = $this->property('roleIdentifier', 'id');
        $options += $roles->lists('name', $id_attribute);

        return $options;
    }
}
