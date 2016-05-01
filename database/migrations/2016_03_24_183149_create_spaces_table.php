<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('manager_id');
            $table->string('organization');
            $table->foreign('manager_id')->references('id')->on('users');
            $table->foreign('organization')->references('slug')->on('organizations');
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('geo_location');
            $table->string('email');
            $table->string('phone_number');
            $table->string('logo');
            $table->text('excerpt');
            $table->text('description');
            $table->string('website');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('instagram');
            $table->string('in_return_key');
            $table->integer('in_return');
            $table->string('status');
            $table->json('working_week_days');
            $table->string('working_hours_days');
            $table->string('space_type');
            $table->json('space_equipment');
            $table->text('agreement_text');
            $table->integer('capacity');
            $table->string('smoking');
            $table->json('min_type_for_reservation');
            $table->json('max_type_for_reservation');
            $table->json('min_time_before_reservation');
            $table->json('max_time_before_reservation');
            $table->json('min_time_before_usage_to_edit');
            $table->json('min_to_cancel');
            $table->json('change_fees');
            $table->json('cancel_fees');
            $table->json('max_to_confirm');
            $table->json('reset_time');
            $table->json('max_event_per_time');
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
        Schema::drop('spaces');
    }
}