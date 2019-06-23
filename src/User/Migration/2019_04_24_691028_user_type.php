<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserType extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('users', function (Blueprint $table) {
            $table->string('type')->default('user');
            $table->string('mobile')->unique();
            $table->integer('actived_code')->nullable();
            $table->boolean('status')->default(1);
            $table->string('api_token')->nullable();
            $table->string('notifcation_status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        // Schema::table(
        //         'users', function (Blueprint $table) {
        //     $table->dropColumn(
        //             [
        //                 'mobile',
        //                 'type',
        //                 'actived_code',
        //                 'status',
        //             ]
        //     );
        // }
        // );
    }

}
