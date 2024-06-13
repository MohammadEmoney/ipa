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
        Schema::create('layouts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('layout_group_id')->constrained()->cascadeOnDelete();
            $table->string('type'); // Menu, Slider , ...
            $table->text('data')->nullable(); // newest, most visit, top favorites, ...
            $table->string('title');
            $table->text('description')->nullable();
            $table->enum('release_type',\App\Enums\EnumLayoutReleaseType::All())->default(\App\Enums\EnumLayoutReleaseType::DRAFT);
            $table->timestamp('start_date_release')->nullable();
            $table->timestamp('end_date_release')->nullable();
            $table->integer('priority')->nullable();
            $table->string('icon')->nullable();
            $table->string('tag')->nullable();
            $table->string('lang');
            $table->unsignedInteger('count_list')->nullable();
            $table->boolean('is_active')->default(1);
            $table->nestedSet();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layouts');
    }
};
