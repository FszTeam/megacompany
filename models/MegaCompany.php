<?php namespace FszTeam\MegaCompany\Models;

use October\Rain\Database\Model as BaseModel;
use BackendMenu;

/**
 * Settings Model
 */
class MegaCompany extends BaseModel
{
    public $implement = [
        'System.Behaviors.SettingsModel',
        '@RainLab.Translate.Behaviors.TranslatableModel',
    ];

    public $translatable = ['story', 'slogan'];

    public $settingsCode = 'fszteam_company_settings';

    public $settingsFields = 'fields.yaml';

    public $attachOne = [
        'logo' => ['System\Models\File'],
    ];

    public function getContactOptions()
    {
        $options = [];
        $data = Employee::orderBy('last_name')->get();

        foreach ($data as $record) {
            $options[$record->id] = $record->name;
        }

        return $options;
    }
}
