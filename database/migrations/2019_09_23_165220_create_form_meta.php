<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormMeta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_metas', function (Blueprint $table) {
            $table->integer('form_id');
            $table->string('field_id');
            $table->string('field_name');
            $table->string('field_type');
            $table->text('field_value')->nullable();;
            $table->text('field_placeholder')->nullable();;
            $table->text('field_description')->nullable();;
            $table->text('field_source')->nullable();;
            $table->string('field_required');
            $table->integer('field_order');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_meta');
    }
}
