<?php

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
        DB::statement('ALTER TABLE circulars ENGINE=InnoDB;');
        DB::statement('ALTER TABLE critics ENGINE=InnoDB;');
        DB::statement('ALTER TABLE otp_codes ENGINE=InnoDB;');
        DB::statement('ALTER TABLE comments ENGINE=InnoDB;');
        DB::statement('ALTER TABLE transactions ENGINE=InnoDB;');
        DB::statement('ALTER TABLE notifications ENGINE=InnoDB;');
        DB::statement('ALTER TABLE orders ENGINE=InnoDB;');
        DB::statement('ALTER TABLE airlines ENGINE=InnoDB;');
        DB::statement('ALTER TABLE documents ENGINE=InnoDB;');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('innodb', function (Blueprint $table) {
            //
        });
    }
};
