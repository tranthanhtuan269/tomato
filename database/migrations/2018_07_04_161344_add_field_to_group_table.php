<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldToGroupTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->string('source_language')->after('name')->nullable();
            $table->string('target_language')->after('source_language')->nullable();
            $table->unsignedInteger('parent')->after('target_language')->default(0);
            $table->unsignedInteger('target')->after('parent')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('groups', function (Blueprint $table) {
            $table->dropColumn('source_language');
            $table->dropColumn('target_language');
            $table->dropColumn('parent');
            $table->dropColumn('target');
        });
    }
}
