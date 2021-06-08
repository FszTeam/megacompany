<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1012 extends Migration
{
    public function up()
    {
        Schema::table('fszteam_company_pivots', function($table) {
             $table->integer('category_id')->unsigned()->nullable()->index();
        });
    }

    public function down()
    {
        Schema::table('fszteam_company_pivots', function($table) {
            $table->dropColumn('category_id');
        });
    }
}