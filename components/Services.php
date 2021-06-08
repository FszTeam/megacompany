<?php namespace FszTeam\MegaCompany\Components;

use FszTeam\MegaCompany\Models\Service;
use Illuminate\Support\Facades\Lang;
use FszTeam\MegaCompany\Models\Tag;

class Services extends Component
{

    public $table = 'fszteam_company_services';

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.services.name',
            'description' => 'fszteam.megacompany::lang.components.services.description',
        ];
    }

    public function onRun()
    {
        $this->page['service'] = $this->service();
        $this->page['services'] = $this->services();
        
        $this->addCss('/plugins/fszteam/megacompany/assets/services/css/servicetab.css');
    }

    public function service()
    {
        if (!empty($this->property('itemId'))) {
            if ($this->item) return $this->item;
            return $this->item = Service::where($this->property('modelIdentifier', 'id'), $this->property('itemId'))
                ->with('picture', 'pictures', 'files')
                ->first();
        }
    }

    public function services()
    {
        if (empty($this->property('itemId'))) {
            if ($this->list) return $this->list;

            $services = Service::published()->with('picture', 'pictures', 'files');

            if ($this->property('filterTag')) {
                $id_attribute = $this->property('tagIdentifier', 'id');
                $services->whereHas('tags', function ($query) use ($id_attribute) {
                    $query->where($id_attribute, '=', $this->property('filterTag'));
                })->with('tags');
            }

            $services = $services->orderBy(
                $this->property('orderBy', 'id'),
                $this->property('sort', 'desc'))->take($this->property('maxItems'));

            return $this->list = $this->property('paginate') ?
                $services->paginate($this->property('perPage'), $this->property('page')) :
                $services->get();
        }
    }

    public function defineProperties()
    {
        $properties = parent::defineProperties();
        $properties['tagIdentifier'] = [
            'title' => 'fszteam.megacompany::lang.tags.tag_identifier',
            'description' => 'fszteam.megacompany::lang.descriptions.tag_identifier',
            'type' => 'dropdown',
            'options' => ['id' => 'id', 'slug' => 'slug'],
            'default' => 'id',
            'group' => 'fszteam.megacompany::lang.labels.filters',
        ];
        $properties['filterTag'] = [
            'title' => 'fszteam.megacompany::lang.tags.menu_label',
            'description' => 'fszteam.megacompany::lang.descriptions.filter_tags',
            'type' => 'dropdown',
            'group' => 'fszteam.megacompany::lang.labels.filters',
        ];
        return $properties;
    }

    public function getFilterTagOptions()
    {
        $options = [Lang::get('fszteam.megacompany::lang.labels.show_all')];
        $tags = Tag::has('services')->get();
        $id_attribute = $this->property('tagIdentifier', 'id');
        $options += $tags->lists('name', $id_attribute);

        return $options;
    }
}
