<?php

namespace App\Console;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateSharpUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dianelog:create_sharp_user {name} {email} {password?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Sharp user, and return its generated password';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $password = $this->argument("password")
            ? trim($this->argument("password"))
            : Str::random(8);

        $user = new User();
        $user->name = $this->argument("name");
        $user->email = $this->argument("email");
        $user->password = $password;
        $user->save();

        $this->info("User {$this->argument("name")} created. Password: [{$password}]");
    }
}
