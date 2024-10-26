<?php

namespace App\Console\Commands;

use App\Enums\EnumUserType;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateUsersType extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-users-type';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::all();

        DB::beginTransaction();

        foreach($users as $user)
            $user->update(['type' => EnumUserType::PILOT]);

        DB::commit();
    }
}
