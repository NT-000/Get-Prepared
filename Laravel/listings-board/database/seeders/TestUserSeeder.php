<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): array
    {
        $user1 = User::create([
            'name' => 'John Doe',
            'email' => 'test@test.com',
            'email_verified_at' => Carbon::now(),
            'avatar' => 'avatars/testUser1.png',
            'password' => Hash::make('12345678'),
        ],
        );

        $user2 = User::create(
            [
                'name' => 'Jane Doe',
                'email' => 'jane@test.com',
                'email_verified_at' => Carbon::now(),
                'avatar' => 'avatars/testUser2.png',
                'password' => Hash::make('12345678'),
            ]);
        return [$user1, $user2];
    }
}
