<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vine_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vine_id');
            $table->string('image');
            $table->foreign('vine_id')
                ->references('id')->on('vines')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }
};
