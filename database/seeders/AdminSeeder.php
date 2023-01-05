<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = now();

        User::create( [
            "nickname"          => "Admin",
            "email"             => "super@admin.com",
            "password"          => bcrypt( "password.test" ),
            "sex"               => "M",
            "is_admin"          => 1,
            "ip"                => "127.0.0.1",
            "email_verified_at" => $time,
            "approved_at"       => $time,
        ] );
    }
}
