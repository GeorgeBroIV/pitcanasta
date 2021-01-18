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
            $table->id();$table->foreignId('users_id')->nullable();
            $table->string('name')->unique();
            $table->string('avatar')->nullable();
            $table->smallInteger('rating')->nullable();
            $table->boolean('visible')->default(1)->nullable();
            $table->boolean('active')->default(1);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();
            $table->softDeletes();

            $table->foreignId('deleted_by')->nullable();
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
