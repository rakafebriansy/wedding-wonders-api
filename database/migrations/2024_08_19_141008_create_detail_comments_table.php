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
        Schema::create('detail_comments', function (Blueprint $table) {
            $table->id('detail_comment_id'); 
            $table->unsignedBigInteger('wedding_id'); 
            $table->unsignedBigInteger('comment_id'); 

            $table->foreign('wedding_id')->references('wedding_id')->on('weddings')->onDelete('cascade');

            $table->foreign('comment_id')->references('comment_id')->on('comments')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_comments');
    }
};
