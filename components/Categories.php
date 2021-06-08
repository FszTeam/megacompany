<?php namespace FszTeam\MegaCompany\Components;

use FszTeam\MegaCompany\Models\Category;

class Categories extends Component
{
    public $table = 'fszteam_company_categories';

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.categories.name',
            'description' => 'fszteam.megacompany::lang.components.categories.description'
        ];
    }

    public function onRun()
    {
        $this->page['category'] = $this->category();
        $this->page['categories'] = $this->categories();
    }

    public function category()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Category::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture', 'pictures')
                ->first();
        }
    }

    public function categories()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;
            $categories = Category::published()
                ->with('picture', 'pictures')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $categories->paginate($this->property('perPage'), $this->property('page')) :
                $categories->get();
        }
    }

}
