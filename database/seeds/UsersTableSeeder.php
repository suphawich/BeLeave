<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Task;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $user = new User;
        // $user->email = "admin@beleave";
        // $user->password = password_hash('password', PASSWORD_DEFAULT);
        // $user->full_name = 'Administrator';
        // // $user->avatar = '\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
        // $user->address = "BeLeave Company Ltd";
        // $user->access_level = 'Administrator';
        // $user->tel = '0836429451';
        // $user->company_name = "BeLeave";
        // $user->token = str_random(64);
        // $user->save();

        $user = new User;
        $user->email = "jirath@bnk48official";
        $user->password = password_hash('jobsan', PASSWORD_DEFAULT);
        $user->full_name = 'JIRATH PAVARAVADHANA';
        // $user->avatar = '\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
        $user->address = "Bangkok";
        $user->access_level = 'Manager';
        $user->tel = '0818151905';
        $user->company_name = "BNK48";
        $user->token = str_random(64);
        $user->save();

        $user = new User;
        $user->email = "jobsan@bnk48official";
        $user->password = password_hash('jobsan', PASSWORD_DEFAULT);
        $user->full_name = 'NATAPHOL PAVARAVADHANA';
        // $user->avatar = '\images\profiles\0b2bdcce13913b4c38daec9aba56b651.jpg';
        $user->address = "Bangkok";
        $user->access_level = 'Subordinate';
        $user->tel = '0848484848';
        $user->company_name = "BNK48";
        $user->token = str_random(64);
        $user->save();
        $task = new Task;
        $task->subordinate_id = $user->id;
        $task->subordinate_id = 'general manager';
        $task->save();

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

            $task = new Task;
            $task->subordinate_id = $user->id;
            $task->task = $member->task;
            $task->save();
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
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'pun@bnk48official',
                'full_name' => 'PUNSIKORN TIYAKORN',
                'password' => 'pun',
                'address' => 'Bangkok',
                'tel' => '0842141102',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'jennis@bnk48official',
                'full_name' => 'JENNIS OPRASERT',
                'password' => 'jennis',
                'address' => 'Petchaburi',
                'tel' => '0842141103',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'can@bnk48official',
                'full_name' => 'NAYIKA SRINIAN',
                'password' => 'can',
                'address' => 'Bangkok',
                'tel' => '0842141104',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
            (Object) [
                'email' => 'izurina@bnk48official',
                'full_name' => 'RINA IZUTA',
                'password' => 'izurina',
                'address' => 'Saitama, Japan',
                'tel' => '0842141105',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'jaa@bnk48official',
                'full_name' => 'NAPAPHAT WORRAPHUTTANON',
                'password' => 'jaa',
                'address' => 'Bangkok',
                'tel' => '0842141106',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
            (Object) [
                'email' => 'jane@bnk48official',
                'full_name' => 'KUNJIRANUT INTARASIN',
                'password' => 'jane',
                'address' => 'Pathum Thani',
                'tel' => '0842141107',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'jib@bnk48official',
                'full_name' => 'SUCHAYA SAENKHOT',
                'password' => 'jib',
                'address' => 'Lopburi',
                'tel' => '0842141108',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'kaew@bnk48official',
                'full_name' => 'NATRUJA CHUTIWANSOPON',
                'password' => 'kaew',
                'address' => 'Chonburi',
                'tel' => '0842141109',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'kaimook@bnk48official',
                'full_name' => 'WARATTAYA DEESOMLERT',
                'password' => 'kaimook',
                'address' => 'Bangkok',
                'tel' => '0842141110',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'kate@bnk48official',
                'full_name' => 'KORAPAT NILPRAPA',
                'password' => 'kate',
                'address' => 'Phayao',
                'tel' => '0842141111',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'korn@bnk48official',
                'full_name' => 'VATHUSIRI PHUWAPUNYASIRI',
                'password' => 'korn',
                'address' => 'Bangkok',
                'tel' => '0842141112',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
            (Object) [
                'email' => 'miori@bnk48official',
                'full_name' => 'MIORI OHKUBO',
                'password' => 'miori',
                'address' => 'Ibaraki, Japan',
                'tel' => '0842141113',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'mobile@bnk48official',
                'full_name' => 'PIMRAPAT PHADUNGWATANACHOK',
                'password' => 'mobile',
                'address' => 'Bangkok',
                'tel' => '0842141114',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
            (Object) [
                'email' => 'music@bnk48official',
                'full_name' => 'PRAEWA SUTHAMPHONG',
                'password' => 'music',
                'address' => 'Bangkok',
                'tel' => '0842141115',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
            (Object) [
                'email' => 'namneung@bnk48official',
                'full_name' => 'MILIN DOKTHIAN',
                'password' => 'namneung',
                'address' => 'Sing Buri',
                'tel' => '0842141116',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'namsai@bnk48official',
                'full_name' => 'PICHAYAPA NATHA',
                'password' => 'namsai',
                'address' => 'Chiang Mai',
                'tel' => '0842141117',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'nink@bnk48official',
                'full_name' => 'PICHAYAPA NATHA',
                'password' => 'nink',
                'address' => 'Samut Sakorn',
                'tel' => '0842141118',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
            (Object) [
                'email' => 'noey@bnk48official',
                'full_name' => 'KANTEERA WADCHARATHADSANAKUL',
                'password' => 'noey',
                'address' => 'Samut Prakan',
                'tel' => '0842141119',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'orn@bnk48official',
                'full_name' => 'PATCHANAN JIAJIRACHOTE',
                'password' => 'orn',
                'address' => 'Bangkok',
                'tel' => '0842141120',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'pupe@bnk48official',
                'full_name' => 'JIRADAPA INTAJAK',
                'password' => 'pupe',
                'address' => 'Chiang Mai',
                'tel' => '0842141121',
                'company_name' => 'BNK48',
                'task' => 'middleline'
            ],
            (Object) [
                'email' => 'satchan@bnk48official',
                'full_name' => 'SAWITCHAYA KAJONRUNGSILP',
                'password' => 'satchan',
                'address' => 'Bangkok',
                'tel' => '0842141122',
                'company_name' => 'BNK48',
                'task' => 'backline'
            ],
            (Object) [
                'email' => 'tarwaan@bnk48official',
                'full_name' => 'ISARAPA THAWATPAKDEE',
                'password' => 'tarwaan',
                'address' => 'Nakhon Pathom',
                'tel' => '0842141123',
                'company_name' => 'BNK48',
                'task' => 'frontline'
            ],
        ];
    }
}
