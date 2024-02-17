<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vines', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('style');
            $table->string('sort');
            $table->unsignedBigInteger('price');
            $table->unsignedInteger('stock_qty');
            $table->timestamps();
        });
    }
};
