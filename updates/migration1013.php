<?php namespace FszTeam\MegaCompany\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class Migration1013 extends Migration
{
    public function up()
    {
        Schema::table('fszteam_company_services', function($table) {
             $table->text('info');
        });
    }

    public function down()
    {
        Schema::table('fszteam_company_services', function($table) {
            $table->dropColumn('info');
        });
    }
}