<?php

use Carbon\Carbon;
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
        $this->call(PrivilegeTableSeeder::class);
        $this->call(Privilege_UserTableSeeder::class);
        $this->call(ColonyTableSeeder::class);
        $this->call(TreatmentTableSeeder::class);
        $this->call(WeightTableSeeder::class);
        $this->call(Blood_PressureTableSeeder::class);
        $this->call(TagTableSeeder::class);
        $this->call(TissueTableSeeder::class);
        $this->call(StorageTableSeeder::class);
        $this->call(MouseTableSeeder::class);
        $this->call(CageTableSeeder::class);
        $this->call(SurgeryTableSeeder::class);
        $this->call(Mouse_SurgeryTableSeeder::class);
        $this->call(Mouse_StorageTableSeeder::class);
        $this->call(Mouse_TagTableSeeder::class);
    }
}

class UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'first_name' => "Martin",
            'last_name' => "Mackasey",
            'email' => "mmackasey@gmail.com",
            'student_id' => "d0000000",
            'phone' => "9025555555",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'first_name' => "Devon",
            'last_name' => "Turner",
            'email' => "devonj.turner@gmail.com",
            'student_id' => "W0204891",
            'phone' => "9028188414",
            'password' => Hash::make("password"),
        ]);
        DB::table('users')->insert([
            'first_name' => "Scott",
            'last_name' => "Rafael",
            'email' => "squiggs.rafael@gmail.com",
            'student_id' => "w0218584",
            'phone' => "9024418780",
            'password' => Hash::make("password"),
        ]);
    }
}

class PrivilegeTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('privileges')->insert([
            'name' => "Administrator",
        ]);
        DB::table('privileges')->insert([
            'name' => "Technician",
        ]);
        DB::table('privileges')->insert([
            'name' => "Standard",
        ]);
    }
}

class Privilege_UserTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('privilege_user')->insert([
            'user_id' => 1,
            'privilege_id' => 1,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 1,
            'privilege_id' => 2,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 1,
            'privilege_id' => 3,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 2,
            'privilege_id' => 1,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 2,
            'privilege_id' => 2,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 2,
            'privilege_id' => 3,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 3,
            'privilege_id' => 1,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 3,
            'privilege_id' => 2,
        ]);

        DB::table('privilege_user')->insert([
            'user_id' => 3,
            'privilege_id' => 3,
        ]);
    }
}

class ColonyTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('colonies')->insert([
           'name' => 'NPR-C'
        ]);

        DB::table('colonies')->insert([
            'name' => 'Akita'
        ]);

        DB::table('colonies')->insert([
            'name' => 'NPR-B'
        ]);

        DB::table('colonies')->insert([
            'name' => 'GFP'
        ]);
    }
}

class CageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cages')->insert([
            'male' => 1,
            'female_one' => 2,
            'female_two' => 3,
            'female_three' => 4,
            'room_num' => '78'
        ]);
    }
}

class TreatmentTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('treatments')->insert([
            'title' => 'Ang-II',
            'drug_amount' => '160',
            'mouse_id' => 1
        ]);

        DB::table('treatments')->insert([
            'title' => 'saline',
            'drug_amount' => '245',
            'mouse_id' => 2
        ]);

        DB::table('treatments')->insert([
            'title' => 'Ang-II + cANF',
            'drug_amount' => '85',
            'mouse_id' => 2
        ]);
    }
}

class WeightTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('weights')->insert([
            'weight' => 30.1,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 1,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);

        DB::table('weights')->insert([
            'weight' => 26.4,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 2,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);

        DB::table('weights')->insert([
            'weight' => 27.1,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 3,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);

        DB::table('weights')->insert([
            'weight' => 24.7,
            'weighed_on' => '2012-01-16',
            'mouse_id' => 4,
            'created_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now('America/Halifax')->format('Y-m-d H:i:s')
        ]);
    }
}

class Blood_PressureTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 1
        ]);

        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 2
        ]);

        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 3
        ]);

        DB::table('blood_pressures')->insert([
            'systolic' => 'null',
            'diastolic' => 'null',
            'taken_on' => '2012-01-16',
            'mouse_id' => 4
        ]);
    }
}

class TagTableSeeder extends Seeder
{

    public function run()
    {
        for($i = 0; $i < 1000; $i++) {

            $i = str_pad($i, 3, '00', STR_PAD_LEFT);

            DB::table('tags')->insert([
                'tag_num' => $i,
                'lost_tag' => false
            ]);
        }
    }
}

class TissueTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('tissues')->insert([
            'name' => 'Ventricle'
        ]);

        DB::table('tissues')->insert([
            'name' => 'Apex'
        ]);

        DB::table('tissues')->insert([
            'name' => 'Full Atrial'
        ]);

        DB::table('tissues')->insert([
            'name' => 'Posterior Wall'
        ]);

        DB::table('tissues')->insert([
            'name' => 'Whole Heart'
        ]);
    }
}

class StorageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('storages')->insert([
            'tissue_id' => 1,
            'type' => true,
            'freezer' => '1',
            'compartment' => '1',
            'shelf' => '2'
        ]);

        DB::table('storages')->insert([
            'tissue_id' => 1,
            'type' => true,
            'freezer' => '1',
            'compartment' => '2',
            'shelf' => '2'
        ]);

        DB::table('storages')->insert([
            'tissue_id' => 1,
            'type' => true,
            'freezer' => '1',
            'compartment' => '1',
            'shelf' => '3'
        ]);
    }
}

class MouseTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 'True',
            'geno_type_a' => 1,
            'geno_type_b' => 1,
            'father' => 1,
            'mother_one' => 2,
            'mother_two' => false,
            'mother_three' => false,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => '2012-02-28',
            'sick_report' => false,
            'comments' => ""
        ]);

        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 'False',
            'geno_type_a' => 1,
            'geno_type_b' => 0,
            'father' => 1,
            'mother_one' => 2,
            'mother_two' => false,
            'mother_three' => false,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => false,
            'sick_report' => false,
            'comments' => ""
        ]);

        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 'False',
            'geno_type_a' => 0,
            'geno_type_b' => 0,
            'father' => 1,
            'mother_one' => 2,
            'mother_two' => false,
            'mother_three' => false,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => false,
            'sick_report' => false,
            'comments' => ""
        ]);

        DB::table('mice')->insert([
            'colony_id' => 1,
            'source' => 'In house',
            'reserved_for' => 1,
            'sex' => 'False',
            'geno_type_a' => 1,
            'geno_type_b' => 1,
            'father' => 1,
            'mother_one' => 2,
            'mother_two' => false,
            'mother_three' => false,
            'birth_date' => '2012-01-02',
            'wean_date' => '2012-01-29',
            'end_date' => false,
            'sick_report' => true,
            'comments' => ""
        ]);
    }
}

class SurgeryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('surgeries')->insert([
            'user_id' => 1,
            'scheduled_date' => '01/02/2012',
            'purpose' => 'Emmanual-intracardiac',
            'comments' => 'Oleg Kept tissue'
        ]);

        DB::table('surgeries')->insert([
            'user_id' => 1,
            'scheduled_date' => '01/02/2012',
            'purpose' => 'Hailey intracardiac',
            'comments' => 'Atrial prep for mlcl, plasma frozen'
        ]);
    }
}


class Mouse_SurgeryTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mouse_surgery')->insert([
            'mouse_id' => 1,
            'surgery_id' => 1
        ]);

        DB::table('mouse_surgery')->insert([
            'mouse_id' => 2,
            'surgery_id' => 2
        ]);
    }
}

class Mouse_StorageTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mouse_storage')->insert([
            'mouse_id' => 1,
            'storage_id' => 1
        ]);

        DB::table('mouse_storage')->insert([
            'mouse_id' => 2,
            'storage_id' => 2
        ]);
    }
}

class Mouse_TagTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('mouse_tag')->insert([
            'mouse_id' => 1,
            'tag_id' => 1
        ]);

        DB::table('mouse_tag')->insert([
            'mouse_id' => 2,
            'tag_id' => 2
        ]);

        DB::table('mouse_tag')->insert([
            'mouse_id' => 3,
            'tag_id' => 3
        ]);

        DB::table('mouse_tag')->insert([
            'mouse_id' => 4,
            'tag_id' => 4
        ]);

    }
}
