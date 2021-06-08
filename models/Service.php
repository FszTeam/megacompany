<?php namespace FszTeam\MegaCompany\Models;

/**
 * Service Model
 */
class Service extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fszteam_company_services';
    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [
        'projects' => [
            'FszTeam\MegaCompany\Models\Project',
            'table' => 'fszteam_company_pivots',
        ],
        'tags' => [
            'FszTeam\MegaCompany\Models\Tag',
            'table' => 'fszteam_company_pivots',
        ],
        'categories' => [
            'FszTeam\MegaCompany\Models\Category',
            'table' => 'fszteam_company_pivots',
        ],
    ];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];
    public $attachOne = [
        'picture' => ['System\Models\File'],
    ];
    public $attachMany = [
        'pictures' => ['System\Models\File'],
        'files' => ['System\Models\File'],
    ];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->projects()->detach();
    }

}
