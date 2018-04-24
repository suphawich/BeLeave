<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User;
        $user->email = "suphawich.s@ku.th";
        $user->password = password_hash('mark', PASSWORD_DEFAULT);
        $user->full_name = 'Suphawich Sungkhavorn';
        $user->avatar = '\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
        $user->address = "20 Soi Pichayanunt15 Tiwanont Road";
        $user->access_level = 'Manager';
        $user->tel = '0836429451';
        $user->company_name = "Suphawich";
        $user->is_enabled = 0;
        $user->token = str_random(64);
        $user->save();
        factory(App\User::class, 10)->create();
    }
}
