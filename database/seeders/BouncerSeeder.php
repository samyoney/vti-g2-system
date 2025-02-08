<?php

namespace Database\Seeders;

use App\Models\User;
use Bouncer;
use Illuminate\Database\Seeder;

class BouncerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bouncer::allow('admin')->everything();
        Bouncer::allow('regular')->to('edit-profile', User::class);
    }
}
