<?php namespace FszTeam\MegaCompany\Models;

/**
 * Employee Model
 */
class Employee extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => ['first_name', 'last_name']];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fszteam_company_employees';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'roles' => [
            'FszTeam\MegaCompany\Models\Role',
            'table' => 'fszteam_company_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [];

    protected $appends = ['name', 'duties'];
    protected $jsonable = ['social_media'];

    public function getRolesOptions()
    {
        return Role::all()->lists('name', 'id');
    }

    public function afterDelete()
    {
        parent::afterDelete();
        $this->roles()->detach();
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getDutiesAttribute()
    {
        return implode(', ', $this->roles()->orderBy('name', 'asc')->lists('name', 'id'));
    }
    
        /**
     * Sets the "url" attribute with a URL to this object
     * @param string $pageName
     * @param Cms\Classes\Controller $controller
     */
    public function setUrl($pageName, $controller)
    {
        $params = [
            'slug' => $this->slug
        ];
        return  $this->url = $controller->pageUrl($pageName, $params);
    }
}
