<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('wine_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wine_id');
            $table->string('image');
            $table->foreign('wine_id')
                ->references('id')->on('wines')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
