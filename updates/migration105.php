<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration105 extends Migration
{
    public function up()
    {
         Schema::create('fszteam_company_projects', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('customer');
            $table->string('slug',100)->index();
            $table->string('url');
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
         Schema::drop('fszteam_company_projects');
    }
}