<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsGlobalToPageFieldsAndPageContentTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_fields', function (Blueprint $table) {
            $table->boolean('is_global')->after('page_id');
        });

        Schema::table('page_content', function (Blueprint $table) {
            $table->boolean('is_global')->after('page_field_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('page_fields', function (Blueprint $table) {
            $table->dropColumn('is_global');
        });

        Schema::table('page_content', function (Blueprint $table) {
            $table->dropColumn('is_global');
        });
    }
}
