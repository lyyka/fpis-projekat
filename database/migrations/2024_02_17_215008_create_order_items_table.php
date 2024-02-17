<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('wine_id');
            $table->unsignedSmallInteger('qty')->default(1);

            $table->unique(['order_id', 'wine_id']);

            $table->foreign('order_id')
                ->references('id')->on('orders')
                ->cascadeOnDelete();

            $table->foreign('wine_id')
                ->references('id')->on('wines')
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }
};
