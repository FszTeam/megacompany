<?php namespace FszTeam\MegaCompany\Components;

use Cms\Classes\ComponentBase;
use FszTeam\MegaCompany\Models\MegaCompany as Settings;
use October\Rain\Database\Model;

class GoogleMap extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name'        => 'GoogleMap Component',
            'description' => 'GoogleMap Component for Page / Layout'
        ];
    }

    public function defineProperties()
    {
        return [

            'width' => [
                'title'             => 'Width',
                'default'           => '100%',
                'description'       => 'It can be use px or %',
                'type'              => 'string',
            ],
            'height' => [
                'title'             => 'Height',
                'default'           => '350px',
                'description'       => 'It can be use px or %',
                'type'              => 'string',
            ],
            'mapTypeId' => [
                'title'             => 'Map Type',
                'default'           => 'ROADMAP',
                'type'              => 'dropdown',
                'options'           => ['ROADMAP'=>'Roadmap', 'SATELLITE'=>'Satellite', 'HYBRID'=>'Hybrid', 'TERRAIN'=>'Terrain']
            ],
            'showMarker' => [
                'title'             => 'Show Marker',
                'default'           => 'true',
                'type'              => 'checkbox',
            ],
            
        ];
    }

    public function onRun()
    {
        $settings = Settings::instance();
        $megacompany = new Model();
        $megacompany->name = $settings->name;
        $megacompany->timing = $settings->timing;
        $megacompany->logo = $settings->logo;
        $megacompany->story = $settings->story;
        $megacompany->phone = $settings->phone;
        $megacompany->fax = $settings->fax;
        $megacompany->email = $settings->email;
        $megacompany->address = $settings->address;
        $megacompany->latitude = $settings->latitude;
        $megacompany->longitude = $settings->longitude;
        $megacompany->apiKey = $settings->apiKey;
        $megacompany->zoom = $settings->zoom;
        
        $this->page['map'] = $megacompany;
    }
}