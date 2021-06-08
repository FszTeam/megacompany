<?php namespace FszTeam\MegaCompany\Components;

use Cms\Classes\ComponentBase;
use FszTeam\MegaCompany\Models\Service as ServiceModel;

class Service extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Service Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onRun(){
        $slug= $this->param('slug');
        $this->page['service']=ServiceModel::where('slug',$slug)->first();
    }

}
