<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $time = now();

        $data = [
            [
                "nickname"          => "Admin",
                "email"             => "mateus@costamateus.com.br",
                "password"          => bcrypt( "admin" ),
                "sex"               => "M",
                "is_admin"          => 1,
                "ip"                => "127.0.0.1",
                "email_verified_at" => $time,
                "approved_at"       => $time,
            ],[
                "nickname"          => "lkemns",
                "email"             => "costa.mack95@gmail.com",
                "password"          => bcrypt( "1234" ),
                "sex"               => "M",
                "is_admin"          => 0,
                "ip"                => "127.0.0.1",
                "email_verified_at" => $time,
                "approved_at"       => $time,
            ],[
                "nickname"          => "IHersir",
                "email"             => "filipeanfer@gmail.com",
                "password"          => bcrypt( "1234" ),
                "sex"               => "M",
                "is_admin"          => 0,
                "ip"                => "127.0.0.1",
                "email_verified_at" => $time,
                "approved_at"       => $time,
            ]
        ];

        foreach( $data as $user ) User::create( $user );
    }
}
