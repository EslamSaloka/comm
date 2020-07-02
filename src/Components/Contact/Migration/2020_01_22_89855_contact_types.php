<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ContactTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contact_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('public')->default(1);
            $table->timestamps();
        });

        Schema::create('contact_type_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('contact_type_id');
            $table->string('name');
            $table->string('locale');
        });

        Schema::table('contact', function (Blueprint $table) {
            $table->bigInteger('type_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contact_type');
        Schema::dropIfExists('contact_type_translations');
        Schema::table('contact', function (Blueprint $table) {
            $table->dropColumn('type_id');
        });
    }
}
