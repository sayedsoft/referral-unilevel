<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Referral extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            // define foreign key
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')->on('users')
                  ->onDelete('cascade');
            $table->unsignedBigInteger('referral_id');
            $table->foreign('referral_id')
                  ->references('id')->on('users');
            $table->string('referral_code')->default($this->randString(5));
            $table->unsignedBigInteger('team_count')->default(0);
            $table->timestamps();
        });
    }

     // just a random string generator
    public function randString($length){
        $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //

    }
}
