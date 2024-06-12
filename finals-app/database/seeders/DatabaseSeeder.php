<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            "name" => "Faustino",
            "email" => "a@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make("a"),
            "userType" => "doctor"
        ]);
    }
}
