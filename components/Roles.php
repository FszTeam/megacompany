<?php namespace FszTeam\MegaCompany\Components;

use FszTeam\MegaCompany\Models\Role;

class Roles extends Component
{
    public $table = 'fszteam_company_roles';

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.roles.name',
            'description' => 'fszteam.megacompany::lang.components.roles.description',
        ];
    }

    public function onRun()
    {
        $this->page['role'] = $this->role();
        $this->page['roles'] = $this->roles();
    }

    public function role()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Role::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('employees')
                ->first();
        }
    }

    public function roles()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;
            $roles = Role::published()
                ->with('employees')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $roles->paginate($this->property('perPage'), $this->property('page')) :
                $roles->get();
        }
    }
}
