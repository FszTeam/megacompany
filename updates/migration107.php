<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;
use October\Rain\Database\Schema\Blueprint;


class Migration107 extends Migration
{
    public function up()
    {
        Schema::create('fszteam_company_tags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('slug',100)->index();
            $table->string('icon');
            $table->date('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('fszteam_company_tags');
    }
}