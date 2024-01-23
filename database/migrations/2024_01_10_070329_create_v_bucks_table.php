<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('v_bucks', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('order_id');
            $table->string('character_name');
            $table->string('amount');
            $table->decimal('cost');
            $table->timestamp('delivered_at')->nullable();
            $table->foreignId('delivered_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('v_bucks');
    }
};
