<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddAllFksTable extends Migration {

	/**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // IMPORTANT NOTE: Make sure this is the last migration being called.
        // Execute creation of foreign keys by all migrations which use Fk. \m/ :).
        foreach (Fk::$foreignKeys as $foreignKey) {
            Schema::table($foreignKey['table'], function (Blueprint $table) use ($foreignKey) {
                $table->foreign($foreignKey['column'], $foreignKey['key_name'])
                ->references($foreignKey['primary_key'])
                ->on($foreignKey['reference_table'])
                ->onDelete($foreignKey['on_delete'])
                ->onUpdate($foreignKey['on_update']);
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }

}
