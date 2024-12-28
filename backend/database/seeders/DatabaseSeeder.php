<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\AdminUser;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
          User::factory(1)->create([
              'name'=>'Admin',
              'email'=>'admin@admin.ru',
              'password'=>bcrypt('12345'),
              'role'=>1
          ]);
    }
}
