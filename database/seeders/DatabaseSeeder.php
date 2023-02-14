<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Photo;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeder for User table
        $user=User::factory()->create([
            'name'=>'Kalaiwani',
            'username' => 'Kalaiwani',
            'email' => 'Kalaiwani@gmail.com',
            'mobile' => '+60123456789',
            'password' => bcrypt('password')
        ]);

        // Seeder for Category table
        Category::factory()->create([
            'name' => 'Books',
            'slug' => 'books'
        ]);
        Category::create([
            'name' => 'Clothes',
            'slug' => 'clothes'
        ]);
        Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture'
        ]);
        Category::create([
            'name' => 'Electrical Goods',
            'slug' => 'electrical'
        ]);

        // Seeder for Post table
        $post1 = Post::create([
            'uuid' => Str::uuid(),
            'user_id' => 1,
            'category_id' => 4,
            'title' => 'Dyson v12',
            'price' => '1888',
            'body' => "Description Dyson V12 Detect Slim is Dyson's lightest intelligent cordless vacuum with laser illumination. It is engineered with the power, intelligence, versatility, and run time to deep clean your whole home in a lightweight, compact format."
        ]);

        $post2 =Post::create([
            'uuid' => Str::uuid(),
            'user_id' => 1,
            'category_id' => 3,
            'title' => 'Razer Gaming Chair',
            'price' => '988',
            'body' => 'Iskur Gaming Chair w/ Ergonomic Lumbar Support System. Multi-Layered Synthetic Leather; High-Density Foam Cushions; Engineered to Carry; Memory Foam Head Cushion. Multi-Layered Synthetic Leather. High-Density Foam Cushions. Engineered to Carry. Memory Foam Head Cushion'
        ]);

        // Seeder for Photo table
        $photo_uuid_1_1 = Str::uuid();
        $photo_uuid_1_2 = Str::uuid();
        $photo_uuid_1_3 = Str::uuid();
        $photo_uuid_2_1 = Str::uuid();
        $photo_uuid_2_2 = Str::uuid();
        $photo_uuid_2_3 = Str::uuid();

        \File::copy('public/images/dyson/dyson-v12-1.jpg', 'storage/app/public/posts/images/'.$photo_uuid_1_1.'.jpg');
        \File::copy('public/images/dyson/dyson-v12-2.jpg', 'storage/app/public/posts/images/'.$photo_uuid_1_2.'.jpg');
        \File::copy('public/images/dyson/dyson-v12-3.jpg', 'storage/app/public/posts/images/'.$photo_uuid_1_3.'.jpg');
        \File::copy('public/images/razer/razer-1.jfif', 'storage/app/public/posts/images/'.$photo_uuid_2_1.'.jpg');
        \File::copy('public/images/razer/razer-2.jfif', 'storage/app/public/posts/images/'.$photo_uuid_2_2.'.jpg');
        \File::copy('public/images/razer/razer-3.jfif', 'storage/app/public/posts/images/'.$photo_uuid_2_3.'.jpg');

        Photo::create([
            'uuid' => $photo_uuid_1_1,
            'post_id' => $post1->id,
            'extension' => 'jpg'
        ]);

        Photo::create([
            'uuid' => $photo_uuid_1_2,
            'post_id' => $post1->id,
            'extension' => 'jpg'
        ]);

        Photo::create([
            'uuid' => $photo_uuid_1_3,
            'post_id' => $post1->id,
            'extension' => 'jpg'
        ]);

        Photo::create([
            'uuid' => $photo_uuid_2_1,
            'post_id' => $post2->id,
            'extension' => 'jpg'
        ]);

        Photo::create([
            'uuid' => $photo_uuid_2_2,
            'post_id' => $post2->id,
            'extension' => 'jpg'
        ]);

        Photo::create([
            'uuid' => $photo_uuid_2_3,
            'post_id' => $post2->id,
            'extension' => 'jpg'
        ]);
    }
}
