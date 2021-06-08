<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration103 extends Migration
{
    public function up()
    {
        Schema::create('fszteam_company_roles', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->date('published_at');
            $table->string('slug',100)->index();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
         Schema::drop('fszteam_company_roles');
    }
}