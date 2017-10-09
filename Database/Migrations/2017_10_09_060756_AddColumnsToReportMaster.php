<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToReportMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reports__reportmasters', function (Blueprint $table) {
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('sub_footer')->nullable();
            $table->string('footer')->nullable();
            $table->string('sub_title_style')->nullable();
            $table->string('title_style')->nullable();
            $table->string('sub_footer_style')->nullable();
            $table->string('footer_style')->nullable();
            $table->string('viewname')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reports__reportmasters', function (Blueprint $table) {

        });
    }
}
