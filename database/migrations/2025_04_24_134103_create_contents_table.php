<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("CREATE TYPE content_type AS ENUM ('video', 'book', 'audio')");

        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('type'); 
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('url')->nullable();
            $table->timestamps();
        });

        DB::statement('ALTER TABLE contents ALTER COLUMN type TYPE content_type USING (type::content_type)');

        DB::statement("ALTER TABLE contents ALTER COLUMN type SET DEFAULT 'video'");
    }

    public function down(): void
    {
        Schema::dropIfExists('contents');
        DB::statement('DROP TYPE IF EXISTS content_type');
    }
};