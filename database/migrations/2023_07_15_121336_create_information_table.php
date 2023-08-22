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
        Schema::create('information', function (Blueprint $table) {
            $table->id();
            $table->text('site_name');
            $table->string('site_url');
            $table->foreignId('site_id')
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
                
            $table->timestamps();
            $table->softDeletes();
            //cascade
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('_information');
    }
};
