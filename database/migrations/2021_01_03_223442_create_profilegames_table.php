<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilegamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profilegames', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('avatar')->nullable();
            $table->integer('rating');
            $table->boolean('visible')->default(true);
            $table->boolean('active')->default(true);
            $table->text('notes')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->foreignId('deleted_by')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('profilegames');
    }
}
