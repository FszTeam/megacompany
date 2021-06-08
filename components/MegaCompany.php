<?php namespace FszTeam\MegaCompany\Components;

use Cms\Classes\ComponentBase;
use FszTeam\MegaCompany\Models\MegaCompany as Settings;
use FszTeam\MegaCompany\Models\Employee;
use October\Rain\Database\Model;

class MegaCompany extends ComponentBase
{

    public function componentDetails()
    {
        return [
            'name' => 'fszteam.megacompany::lang.components.megacompany.name',
            'description' => 'fszteam.megacompany::lang.components.megacompany.description',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $settings = Settings::instance();
        $megacompany = new Model();
        $megacompany->name = $settings->name;
        $megacompany->timing = $settings->timing;
        $megacompany->logo = $settings->logo;
        $megacompany->story = $settings->story;
        $megacompany->about_us = $settings->about_us;
        $megacompany->phone = $settings->phone;
        $megacompany->fax = $settings->fax;
        $megacompany->email = $settings->email;
        $megacompany->address = $settings->address;
        $megacompany->social_media = $settings->social_media;
        $megacompany->maps = $settings->maps;
        $megacompany->contact = $this->contact();
        $megacompany->street_name = $settings->street_name;
        $megacompany->street_number = $settings->street_number;
        $megacompany->zip = $settings->zip;
        $megacompany->city = $settings->city;
        $this->page['megacompany'] = $megacompany;
    }

    public function contact()
    {
        if ($employee = Employee::find(Settings::get('contact'))) {
            return $employee;
        }
        return Employee::orderBy('id', 'asc')->first();
    }

}
