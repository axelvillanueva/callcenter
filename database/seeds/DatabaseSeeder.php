<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $email = env('ADMIN_EMAIL', 'admin@admin.com');
        $password = env('ADMIN_PASSWORD', 'secret');
        if (!User::where('email', $email)->exists()) {
            factory(User::class)->create([
                'email' => $email,
                'password' => bcrypt($password)
            ]);

        }
    }
}
