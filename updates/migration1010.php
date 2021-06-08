<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1010 extends Migration
{
    public function up()
    {
     
       Schema::create('fszteam_company_links', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('icon');
            $table->string('url');
            $table->string('slug',100)->index();
            $table->text('description');
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
       
    }

    public function down()
    {
        Schema::drop('fszteam_company_links');
    }
}