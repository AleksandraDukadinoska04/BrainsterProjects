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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('title_id');
            $table->string('theme');
            $table->string('img')->nullable()->default('https://www.firstlinepharma.co.uk/wp-content/uploads/2020/02/Firstline-Pharma-MHRA-.png');
            $table->text('description')->nullable();
            $table->text('objective')->nullable();
            $table->string('location');
            $table->date('date');
            $table->enum('status', ['active', 'completed'])->default('active');
            $table->timestamps();
            $table->softDeletes();


            $table->foreign('title_id')->references('id')->on('event_titles')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
