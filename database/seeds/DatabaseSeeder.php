<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        // $this->call(CategoriesSeeder::class);
        // $this->call(PostsTableSeeder::class);
        // $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        // \DB::table('users')->truncate();
        // \DB::table('categories')->truncate();
        // \DB::table('posts')->truncate();
        
        // $this->call([
        //     UsersTableSeeder::class,
        //     PostsTableSeeder::class,
        //     CategoriesTableSeeder::class,
        // ]);

    }
}
