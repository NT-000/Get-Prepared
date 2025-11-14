<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('job_listings')->truncate(); // gets rid of all the data
        Schema::table('job_listings', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->integer('salary');
            $table->string('tags')->nullable();
            $table->enum('job_type', ['Full-time', 'Part-time', 'Temporary', 'Voluntary'])->default('Full-time');
            $table->boolean('remote')->default(false);
            $table->text('requirements')->nullable();
            $table->string('benefits')->nullable();
            $table->string('city');
            $table->text('country')->nullable();
            $table->string('address')->nullable();
            $table->string('zipcode')->nullable();
            $table->string('contact_email');
            $table->string('contact_phone')->nullable();
            $table->string('company_website')->nullable();
            $table->string('company_name');
            $table->text('company_description')->nullable();
            $table->string('company_logo')->nullable();

            //foreign key constraint
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_listings', function (Blueprint $table) {

            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropColumn(['salary', 'tags', 'job_type', 'remote', 'requirements',
                'benefits', 'city', 'country', 'address', 'zipcode', 'contact_email', 'contact_phone',
                'company_website', 'company_name', 'company_description', 'company_logo']);
        });
    }
};
