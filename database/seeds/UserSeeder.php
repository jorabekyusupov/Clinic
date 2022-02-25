<?php

use App\Models\Master\User\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superadmin = User::create([
            'username' => 'superadmin',
            'email' => 'superadmin@medhelper.uz',
            'person_id' => 1,
            'email_verified_at' => now(),
            'password' => bcrypt('mEdHe1per'),
            'remember_token' => Str::random(10),
        ]);

        $doctoradmin = User::create([
            'username' => 'doctoradmin',
            'email' => 'doctoradmin@medhelper.uz',
            'person_id' => 2,
            'email_verified_at' => now(),
            'password' => bcrypt('d0cTo1'),
            'remember_token' => Str::random(10),
        ]);

        $superadmin->attachRole('superadmin');
        $doctoradmin->attachRole('doctoradmin');
    }
}
