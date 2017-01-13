<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(ColonyTableSeeder::class);
        $this->call(MouseTableSeeder::class);
        $this->call(Mouse_ColonyTableSeeder::class);
        $this->call(SurgeryTableSeeder::class);
        $this->call(Mouse_SurgeryTableSeeder::class);
        $this->call(PrivilegeTableSeeder::class);
        $this->call(Privilege_UserTableSeeder::class);

    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'name' => "Martin Mackasey",
            'email' => "mmackasey@gmail.com",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'name' => "Devon Turner",
            'email' => "devonj.turner@gmail.com",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'name' => "Scott Rafael",
            'email' => "squiggs.rafael@gmail.com",
            'password' => Hash::make("password"),
        ]);
    }
}

class ColonyTableSeeder extends Seeder
{
    public function run()
    {

    }
}

class MouseTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mice')->insert([
            'm_geno_type_a' => "****",
            'm_geno_type_b' => "****",
            'm_birth_date' => "****",
            'mc_id' => "****",
            'mc_id' => "****",
            'mc_id' => "****",

        ]);

    }
}

class Mouse_ColonyTableSeeder extends Seeder
{
    public function run()
    {

    }
}

class SurgeryTableSeeder extends Seeder
{
    public function run()
    {

    }
}

class Mouse_SurgeryTableSeeder extends Seeder
{
    public function run()
    {

    }
}

class PrivilegeTableSeeder extends Seeder
{
    public function run()
    {

    }
}

class Privilege_UserTableSeeder extends Seeder
{
    public function run()
    {

    }
}