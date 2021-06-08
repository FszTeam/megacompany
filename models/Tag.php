<?php namespace FszTeam\MegaCompany\Models;

/**
 * Tag Model
 */
class Tag extends Model
{
    use \October\Rain\Database\Traits\Sluggable;

    /**
     * @var array Generate slugs for these attributes.
     */
    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'fszteam_company_tags';
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
        'services' => [
            'FszTeam\MegaCompany\Models\Service',
            'table' => 'fszteam_company_pivots',
        ],
        'galleries' => [
            'FszTeam\MegaCompany\Models\Gallery',
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
    ];

    public function afterDelete()
    {
        parent::afterDelete();
        $this->projects()->detach();
        $this->services()->detach();
        $this->galleries()->detach();
    }

}
