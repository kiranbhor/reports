<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ReportsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports__reportmasters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('module_id', 255)->nullable();
            $table->text('query')->nullable();
            $table->string('type', 255)->nullable();
            $table->string('template_file_id', 45)->nullable();
            $table->string('frequency', 45)->nullable();
            $table->string('is_mnth_gnrtn', 45)->nullable();
            $table->string('export_formats', 255)->nullable();
            $table->string('code', 45)->nullable();
                $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('reports__reportmodules', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->integer('order')->nullable();
            $table->string('css_class')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('reports__reportparameters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->unsignedInteger('report_id')->refernces('id')->on('reports__reportmasters')->nullable();
            $table->boolean('is_data_field')->nullable();
            $table->text('query')->nullable();
            $table->string('seq_no', 255)->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('reports__reportlogs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('report_id')->unsigned()->nullable();
            $table->foreign('report_id')->references('id')->on('reports__reportmasters');
            $table->integer('file_id')->unsigned()->nullable();
            $table->string('status')->nullable()->default("P");
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->text('data')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports__reportmasters');
        Schema::dropIfExists('reports__reportmodules');
        Schema::dropIfExists('reports__reportparameters');
    }
}

