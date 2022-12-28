<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('trackable-jobs.tables.tracked_jobs', 'tracked_jobs'), function (Blueprint $table) {
            $table->id();
            $table->string('trackable_id')->nullable();
            $table->string('trackable_type')->nullable();
            $table->index([
                'trackable_id',
                'trackable_type',
            ]);
            $table->string('name');
            $table->string('status')->default('queued');
            $table->longText('output')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('finished_at')->nullable();
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
        Schema::dropIfExists('tracked_jobs');
    }
};
