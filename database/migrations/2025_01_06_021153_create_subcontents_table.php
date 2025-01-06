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
        Schema::create('subcontents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId("content_id")->constrained("contents")->onDelete("cascade")->onUpdate("cascade");
            $table->foreignId("topic_id")->constrained("topics")->onDelete("cascade")->onUpdate("cascade");
            $table->char("title", 50)->unique();
            $table->string("youtube_link1")->nullable();
            $table->string("youtube_link2")->nullable();
            $table->string("content");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subcontents');
    }
};
