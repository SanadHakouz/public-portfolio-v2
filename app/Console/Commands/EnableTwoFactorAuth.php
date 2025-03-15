<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class EnableTwoFactorAuth extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:enable-2fa {email?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable two-factor authentication for a user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'admin@example.com'; // Default to admin email

        $user = User::where('email', $email)->first();

        if (!$user) {
            $this->error("User with email {$email} not found.");
            return 1;
        }

        $user->enableTwoFactorAuth();

        $this->info("Two-factor authentication has been enabled for {$email}.");

        return 0;
    }
}
