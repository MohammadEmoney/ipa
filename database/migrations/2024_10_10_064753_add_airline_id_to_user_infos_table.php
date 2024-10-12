<?php

use App\Models\Airline;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::table('user_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('airline_id')->nullable()->after('situation');
            $table->foreign('airline_id')->references('id')->on('airlines')->nullOnDelete();
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_infos', function (Blueprint $table) {
            $table->dropForeign('user_infos_airline_id');
            $table->dropColumn('airline_id');
        });
    }
};
