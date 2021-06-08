<?php namespace FszTeam\MegaCompany\Components;

use FszTeam\MegaCompany\Models\Tag;

class Tags extends Component
{
    public $table = 'fszteam_company_tags';

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.tags.name',
            'description' => 'fszteam.megacompany::lang.components.tags.description'
        ];
    }

    public function onRun()
    {
        $this->page['tag'] = $this->tag();
        $this->page['tags'] = $this->tags();
    }

    public function tag()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Tag::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture', 'pictures')
                ->first();
        }
    }

    public function tags()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;
            $tags = Tag::published()
                ->with('picture', 'pictures')
                ->orderBy($this->property('orderBy', 'id'), $this->property('sort', 'desc'))
                ->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $tags->paginate($this->property('perPage'), $this->property('page')) :
                $tags->get();
        }
    }

}
