<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    protected $signature = 'app:make-admin {email : Email of the user to promote}';

    protected $description = 'Promote an existing user to the admin role';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $user = User::where('email', $this->argument('email'))->first();

        if (! $user) {
            $this->error("No user found with email [{$this->argument('email')}].");

            return self::FAILURE;
        }

        $user->forceFill(['role' => 'admin'])->save();

        $this->info("{$user->name} ({$user->email}) is now an admin.");

        return self::SUCCESS;
    }
}
