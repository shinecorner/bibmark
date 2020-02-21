<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCharityCampaignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charity_campaign', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('charity_id');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->string('logo_width')->nullable();
            $table->decimal('budget')->nullable();
            $table->string('hashtags')->nullable();            
            $table->boolean('status')->default(false);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('charity_id')->references('id')->on('charities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('charity_campaign');
    }
}
