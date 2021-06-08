<?php namespace FszTeam\MegaCompany\Components;

use Cms\Classes\ComponentBase;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Schema;
use FszTeam\MegaCompany\Models\Tag;
use FszTeam\MegaCompany\Models\Role;

class Component extends ComponentBase
{

    public $item;
    public $list;
    public $table;

    public function componentDetails()
    {
    }

    public function defineProperties()
    {
        return [
            'itemId' => [
                'title' => 'fszteam.megacompany::lang.labels.item_id',
                'description' => 'fszteam.megacompany::lang.descriptions.item_id',
                'default' => '{{ :model }}',
            ],
            'modelIdentifier' => [
                'title' => 'fszteam.megacompany::lang.misc.model_identifier',
                'description' => 'fszteam.megacompany::lang.descriptions.model_identifier',
                'type' => 'dropdown',
                'options' => ['id' => 'id', 'slug' => 'slug'],
                'default' => 'id',
            ],
            'maxItems' => [
                'title' => 'fszteam.megacompany::lang.labels.max_items',
                'description' => 'fszteam.megacompany::lang.descriptions.max_items',
                'default' => 36,
                'type' => 'string',
                'validationPattern' => '^[0-9]+$',
            ],
            'orderBy' => [
                'title' => 'fszteam.megacompany::lang.labels.order_by',
                'description' => 'fszteam.megacompany::lang.descriptions.order_by',
                'type' => 'dropdown',
                'default' => 'id',
                'group' => 'fszteam.megacompany::lang.labels.order',
            ],
            'sort' => [
                'title' => 'fszteam.megacompany::lang.labels.sort',
                'description' => 'fszteam.megacompany::lang.descriptions.sort',
                'type' => 'dropdown',
                'default' => 'desc',
                'group' => 'fszteam.megacompany::lang.labels.order',
            ],
            'paginate' => [
                'title' => 'fszteam.megacompany::lang.labels.paginate',
                'description' => 'fszteam.megacompany::lang.descriptions.paginate',
                'type' => 'checkbox',
                'default' => false,
                'group' => 'fszteam.megacompany::lang.labels.paginate',
            ],
            'page' => [
                'title' => 'fszteam.megacompany::lang.labels.page',
                'description' => 'fszteam.megacompany::lang.descriptions.page',
                'type' => 'string',
                'default' => '1',
                'validationPattern' => '^[0-9]+$',
                'group' => 'fszteam.megacompany::lang.labels.paginate',
            ],
            'perPage' => [
                'title' => 'fszteam.megacompany::lang.labels.per_page',
                'description' => 'fszteam.megacompany::lang.descriptions.per_page',
                'type' => 'string',
                'default' => '12',
                'validationPattern' => '^[0-9]+$',
                'group' => 'fszteam.megacompany::lang.labels.paginate',
            ],
        ];
    }

    public function getSortOptions()
    {
        return [
            'desc' => Lang::get('fszteam.megacompany::lang.labels.descending'),
            'asc' => Lang::get('fszteam.megacompany::lang.labels.ascending'),
        ];
    }

    public function getOrderByOptions()
    {
        $schema = Schema::getColumnListing($this->table);
        foreach ($schema as $column) {
            $options[$column] = ucwords(str_replace('_', ' ', $column));
        }
        return $options;
    }

}
