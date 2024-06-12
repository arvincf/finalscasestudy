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
            "name" => "Doctor",
            "email" => "a@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make("Abcd12345"),
            "userType" => "doctor"
        ]);

        User::create([
            "name" => "Patient",
            "email" => "b@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make("Bibi1234"),
            "userType" => "patient"
        ]);

        User::create([
            "name" => "Admin",
            "email" => "c@gmail.com",
            "email_verified_at" => now(),
            "password" => Hash::make("Admin1234"),
            "userType" => "admin"
        ]);
    }
}
