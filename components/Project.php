<?php namespace FszTeam\MegaCompany\Components;

use Cms\Classes\ComponentBase;
use FszTeam\MegaCompany\Models\Project as ProjectModel;

class Project extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Project Component',
            'description' => 'No description provided yet...'
        ];
    }

    public function defineProperties()
    {
        return [];
    }
    public function onRun(){
        $slug= $this->param('slug');
        $this->page['project']=ProjectModel::where('slug',$slug)->first();
    }
}
