<?php

use Illuminate\Database\Seeder;

use App\User;

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
        $u = new User;
        $u->name = 'Admin';
        $u->email = 'admin@admin.com';
        $u->password = bcrypt('1234567');
        $u->role = 1;
        $u->save();

        $u = new User;
        $u->name = 'Chris H.';
        $u->email = 'user@email.com';
        $u->password = bcrypt('1234567');
        $u->role = 2;
        $u->save();
    }
}
