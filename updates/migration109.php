<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration109 extends Migration
{
    public function up()
    {
         Schema::create('fszteam_company_testimonials', function ($table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->text('content');
            $table->string('source');
            $table->string('url');
            $table->date('published_at')->nullable();
            $table->nullableTimestamps();
        });
    }

    public function down()
    {
        Schema::drop('fszteam_company_testimonials');
    }
}