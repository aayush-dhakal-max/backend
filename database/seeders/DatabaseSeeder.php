<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; 
use App\Models\User;
use App\Models\Category;
use App\Models\Post;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name'     => 'Admin User',
                'password' => Hash::make('password'), 
                'type'     => 'admin',
            ]
        );

        $user = User::updateOrCreate(
            ['email' => 'user@example.com'],
            [
                'name'     => 'User',
                'password' => Hash::make('password'),
                'type'     => 'user',
            ]
        );
        $categories = Category::factory(5)->create();
        Post::factory(10)->create([
            'user_id'     => $admin->id,
        ])->each(function (Post $post) use ($categories) {
            $post->category_id = $categories->random()->id;
            $post->save();
        });

    }
}
