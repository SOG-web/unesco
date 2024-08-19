<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin {--first_name=Admin} {--last_name=Admin} {--email=} {--password=unesco.ad}';

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
        $first_name = $this->option('first_name');
        $last_name = $this->option('last_name');
        $email = $this->option('email');
        $password = $this->option('password');

        $user = new User();

        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = 'admin';

        $user->save();

        $this->info('Admin created successfully');
        $this->info('Password: '.$password);
        $this->info('Email: '.$email);
    }
}
