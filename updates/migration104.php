<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration104 extends Migration
{
    
    public $models = [
        'employee',
        'gallery',
        'project',
        'role',
        'service',
        'testimonial',
        'tag',
        'link'
    ];
    public function up()
    {
        Schema::create('fszteam_company_pivots', function ($table) {
            $table->engine = 'InnoDB';
            foreach ($this->models as $model) {
                $table->integer($model . '_id')->unsigned()->nullable()->index();
            }
        });
    }

    public function down()
    {
         Schema::drop('fszteam_company_pivots');
    }
}