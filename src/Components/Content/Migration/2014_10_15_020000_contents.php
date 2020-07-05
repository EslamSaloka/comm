<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Contents extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create(
                'contents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        }
        );

        Schema::create(
                'contents_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('content_id');
            $table->string('page_title')->nullable();
            $table->string('page_slug')->nullable();
            $table->string('header_image')->nullable();
            $table->longText('header_text')->nullable();
            $table->longText('content')->nullable();
            $table->longText('footer_text')->nullable();
            $table->string('footer_image')->nullable();
            $table->string('locale');
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('contents');
        Schema::dropIfExists('contents_translations');
    }

}
