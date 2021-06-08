<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration102 extends Migration
{
    public function up()
    {
        Schema::create('fszteam_company_employees', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->text('description');
            $table->string('quote');
            $table->string('email');
            $table->string('phone');
            $table->string('slug',100)->index();
            $table->date('born_at')->nullable();
            $table->text('social_media')->nullable();
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
         Schema::drop('fszteam_company_employees');
    }
}