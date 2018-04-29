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
        $user->email = "admin@beleave";
        $user->password = password_hash('password', PASSWORD_DEFAULT);
        $user->full_name = 'Administrator';
        // $user->avatar = '\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
        $user->address = "BeLeave Company Ltd";
        $user->access_level = 'Administrator';
        $user->tel = '0836429451';
        $user->company_name = "BeLeave";
        $user->token = str_random(64);
        $user->save();

        foreach ($this->getMembers() as $member) {
            $user = new User;
            $user->email = $member->email;
            $user->password = password_hash($member->password, PASSWORD_DEFAULT);
            $user->full_name = $member->full_name;
            // $user->avatar = '\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
            $user->address = $member->address;
            $user->access_level = 'Subordinate';
            $user->tel = $member->tel;
            $user->company_name = $member->company_name;
            $user->token = str_random(64);
            $user->save();
        }



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

    private function getMembers() {
        return [
            (Object) [
                'email' => 'cherprang@bnk48official',
                'full_name' => 'CHERPRANG AREEKUL',
                'password' => 'cherprang',
                'address' => 'Bangkok',
                'tel' => '0842141101',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'pun@bnk48official',
                'full_name' => 'PUNSIKORN TIYAKORN',
                'password' => 'pun',
                'address' => 'Bangkok',
                'tel' => '0842141102',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'jennis@bnk48official',
                'full_name' => 'JENNIS OPRASERT',
                'password' => 'jennis',
                'address' => 'Petchaburi',
                'tel' => '0842141103',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'can@bnk48official',
                'full_name' => 'NAYIKA SRINIAN',
                'password' => 'can',
                'address' => 'Bangkok',
                'tel' => '0842141104',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'izurina@bnk48official',
                'full_name' => 'RINA IZUTA',
                'password' => 'izurina',
                'address' => 'Saitama, Japan',
                'tel' => '0842141105',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'jaa@bnk48official',
                'full_name' => 'NAPAPHAT WORRAPHUTTANON',
                'password' => 'jaa',
                'address' => 'Bangkok',
                'tel' => '0842141106',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'jane@bnk48official',
                'full_name' => 'KUNJIRANUT INTARASIN',
                'password' => 'jane',
                'address' => 'Pathum Thani',
                'tel' => '0842141107',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'jib@bnk48official',
                'full_name' => 'SUCHAYA SAENKHOT',
                'password' => 'jib',
                'address' => 'Lopburi',
                'tel' => '0842141108',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'kaew@bnk48official',
                'full_name' => 'NATRUJA CHUTIWANSOPON',
                'password' => 'kaew',
                'address' => 'Chonburi',
                'tel' => '0842141109',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'kaimook@bnk48official',
                'full_name' => 'WARATTAYA DEESOMLERT',
                'password' => 'kaimook',
                'address' => 'Bangkok',
                'tel' => '0842141110',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'kate@bnk48official',
                'full_name' => 'KORAPAT NILPRAPA',
                'password' => 'kate',
                'address' => 'Phayao',
                'tel' => '0842141111',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'korn@bnk48official',
                'full_name' => 'VATHUSIRI PHUWAPUNYASIRI',
                'password' => 'korn',
                'address' => 'Bangkok',
                'tel' => '0842141112',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'miori@bnk48official',
                'full_name' => 'MIORI OHKUBO',
                'password' => 'miori',
                'address' => 'Ibaraki, Japan',
                'tel' => '0842141113',
                'company_name' => 'BNK48'
            ],
            (Object) [
                'email' => 'mobile@bnk48official',
                'full_name' => 'PIMRAPAT PHADUNGWATANACHOK',
                'password' => 'mobile',
                'address' => 'Bangkok',
                'tel' => '0842141114',
                'company_name' => 'BNK48'
            ],
        ];
    }
}
