<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('username')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('alternate_phone', 20)->nullable();
            $table->dateTime('date_of_birth')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('city_id')->nullable();
            $table->string('post_code', 15)->nullable();
            $table->string('address', 250)->nullable();
            $table->text('about_yourself')->nullable();
            $table->string('billing_address', 250)->nullable();
            $table->string('alternate_billing_address', 250)->nullable();
            $table->string('profile_picture', 200)->nullable();
            $table->string('background_banner', 250)->nullable();
            $table->string('facebook_link', 250)->nullable();
            $table->string('twitter_link', 250)->nullable();
            $table->string('linkedin_link', 250)->nullable();
            $table->string('instagram_link', 250)->nullable();
            $table->string('youtube_link', 250)->nullable();
            $table->string('website', 200)->nullable();
            $table->text('qr_code')->nullable();
            $table->string('slack_channel')->nullable();
            $table->string('resume_pdf', 300)->nullable()->comment('Uploaded PDF Resume');
            $table->string('designation')->nullable()->comment('Designation is dynamically letest updated');
            $table->integer('profile_completion')->nullable()->comment('Profile complete progress percentage');
            $table->integer('total_rating')->default(0);
            $table->integer('total_review')->default(0);
            $table->float('average_rating', 3, 2)->default(0);
            $table->integer('total_questions')->default(0);
            $table->integer('total_answers')->default(0);
            $table->integer('total_score')->default(0);
            $table->integer('total_connection')->default(0);
            $table->integer('total_views')->default('0');
            $table->tinyInteger('status')->nullable();
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
