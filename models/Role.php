<?php namespace FszTeam\MegaCompany\Models;

/**
 * Role Model
 */
class Role extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fszteam_company_roles';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'employees' => [
            'FszTeam\MegaCompany\Models\Employee',
            'table' => 'fszteam_company_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [];
    public $attachMany = [];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->employees()->detach();
    }

    public function getEmployeesOptions()
    {
        $options = [];
        $employees = Employee::orderBy('last_name', 'asc')->orderBy('first_name', 'asc')->get();
        foreach ($employees as $employee) {
            $options[$employee->id] = $employee->name;
        }
        return $options;
    }

}
