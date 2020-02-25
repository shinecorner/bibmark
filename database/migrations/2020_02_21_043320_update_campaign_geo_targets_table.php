<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateCampaignGeoTargetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('campaign_geo_targets', function (Blueprint $table) {
            $table->morphs('target');
            $table->boolean('status');
        });
        Schema::table('geo_target_details', function (Blueprint $table) {
            $table->unsignedBigInteger('geo_target_id')->after('id');
            $table->foreign('geo_target_id')->references('id')->on('campaign_geo_targets')->onDelete('cascade');
            $table->string('zipcode')->after('geo_target_id');
            $table->integer('radius')->after('zipcode');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('campaign_geo_targets', function (Blueprint $table) {
            $table->dropMorphs('target');
        });
        Schema::table('geo_target_details', function (Blueprint $table) {
            $table->dropColumn(['geo_target_id', 'zipcode', 'radius']);
        });    
    }
}
