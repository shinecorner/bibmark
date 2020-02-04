<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('sponsor_id');
            $table->string('name');
            $table->string('logo')->nullable();
            $table->decimal('budget')->nullable();
            $table->string('hashtags')->nullable();
            $table->string('exclude_companies')->nullable();
            $table->string('age_range')->nullable();
            $table->string('exclude_sponsor_organization')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('sponsor_id')->references('id')->on('sponsors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
