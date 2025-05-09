<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('authors_contents', function (Blueprint $table) {
            $table->foreignId('author_id')->constrained()->onDelete('cascade'); 
            $table->foreignId('content_id')->constrained()->onDelete('cascade'); 
            $table->primary(['author_id', 'content_id']); 
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors_contents');
    }
};