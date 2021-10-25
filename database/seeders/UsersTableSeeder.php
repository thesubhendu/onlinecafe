<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('users')->delete();

        \DB::table('users')->insert(array (
            0 =>
                array(
                    'id'                => 1,
                    'role_id'           => 2,
                    'name'              => 'Pierce Rodriguez',
                    'email'             => 'qhauck@example.com',
                    'mobile'            => '0457.651.341',
                    'email_verified_at' => '2021-06-20 01:55:04',
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                    'remember_token'    => 'vcee9X19w6gy5T8LgnnPnTtLHGs4jifunQLOWMICNuw6EisDegGNnVHbQ4fQ',
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\X6tJyH1suwFMnExExlVP.jpg',
                    'created_at'        => '2021-06-20 01:55:04',
                    'updated_at'        => '2021-08-03 00:22:11',
                ),
            1 =>
                array(
                    'id'                => 2,
                    'role_id'           => 2,
                    'name'              => 'Dr. Darien Rice',
                    'email'             => 'meagan53@example.com',
                    'mobile'            => '0426.666.095',
                    'email_verified_at' => '2021-06-20 01:55:04',
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                    'remember_token'    => 'UQPtBRDNFn',
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\VuL7btlsChWWM2eMVnkF.jpg',
                    'created_at'        => '2021-06-20 01:55:04',
                    'updated_at'        => '2021-08-03 00:22:41',
                ),
            2 =>
                array(
                    'id'                => 3,
                    'role_id'           => 2,
                    'name'              => 'Christ Barrows',
                    'email'             => 'isabella.graham@example.com',
                    'mobile'            => '+61.482.736.066',
                    'email_verified_at' => '2021-06-20 01:55:04',
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                    'remember_token'    => 'T2yve1Z6uT',
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\aIdR8QW8JKyt1FR3n5vd.jpg',
                    'created_at'        => '2021-06-20 01:55:04',
                    'updated_at'        => '2021-08-03 00:22:49',
                ),
            3 =>
                array(
                    'id'                => 4,
                    'role_id'           => 2,
                    'name'              => 'Adell Anderson Jr.',
                    'email'             => 'kasandra.brekke@example.com',
                    'mobile'            => '0447.470.595',
                    'email_verified_at' => '2021-06-20 01:55:04',
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                    'remember_token'    => 'FV94E39qgU',
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\j52MZf9PThLRby16J9Al.jpg',
                    'created_at'        => '2021-06-20 01:55:04',
                    'updated_at'        => '2021-08-03 00:22:56',
                ),
            4 =>
                array(
                    'id'                => 5,
                    'role_id'           => 2,
                    'name'              => 'Bettie Zieme',
                    'email'             => 'konopelski.hipolito@example.org',
                    'mobile'            => '+61.434.531.783',
                    'email_verified_at' => '2021-06-20 01:55:04',
                    'password'          => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
                    'remember_token'    => 'K50zcOlTcq',
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\tNF1nDXza2b33Y3D3uKh.jpg',
                    'created_at'        => '2021-06-20 01:55:04',
                    'updated_at'        => '2021-08-03 00:23:04',
                ),
            5 =>
                array(
                    'id'                => 6,
                    'role_id'           => 1,
                    'name'              => 'Glen Allen',
                    'email'             => 'glena072@gmail.com',
                    'mobile'            => '0437223665',
                    'email_verified_at' => null,
                    'password'          => '$2y$10$3GygDmQsRpn.N/FfDPqd0.wLpVCFU3GOh9Y5l5wn27yJLeAXiuSmy',
                    'remember_token'    => null,
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\53ElmtXj6cjkAht8NVty.png',
                    'created_at'        => '2021-06-20 02:18:04',
                    'updated_at'        => '2021-08-03 00:22:30',
                ),
            6 =>
                array(
                    'id'                => 7,
                    'role_id'           => 2,
                    'name'              => 'John Doe',
                    'email'             => 'jdoe@gmail.com',
                    'mobile'            => '0412345678',
                    'email_verified_at' => null,
                    'password'          => '$2y$10$xmqEflYCY5/WwKCdB5bdqeue.n3Fahr..9W7YMnCIW8zCco1wjSWi',
                    'remember_token'    => null,
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\gXY3d8FrIQ8rHTMKxh7T.jpg',
                    'created_at'        => '2021-06-23 00:43:15',
                    'updated_at'        => '2021-08-03 00:22:02',
                ),
            7 =>
                array(
                    'id'                => 9,
                    'role_id'           => 2,
                    'name'              => 'colin',
                    'email'             => 'colin@gmail.com',
                    'mobile'            => '0412345679',
                    'email_verified_at' => null,
                    'password'          => '$2y$10$ZF0PqhQVKVjkiEYgB4g7Uu6MGsyhnoWZLclNeQ8VfHMPkHS3PIRC2',
                    'remember_token'    => null,
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\n81hqP3dLqhN34KNgWbZ.jpg',
                    'created_at'        => '2021-06-29 02:10:01',
                    'updated_at'        => '2021-08-03 00:21:55',
                ),
            8 =>
                array(
                    'id'                => 11,
                    'role_id'           => 2,
                    'name'              => 'Homer Simpson',
                    'email'             => 'homer@gmail.com',
                    'mobile'            => '0412657891',
                    'email_verified_at' => null,
                    'password'          => '$2y$10$lhGWVrfg2noMsmr5fapAq.ioyO2kzMK1XfvMuVeDAE3ofNFwVYDc6',
                    'remember_token'    => null,
                    'settings'          => '{"locale":"en"}',
                    'avatar'            => 'users\\August2021\\FjBgYWXO6r1uHW3O73Vz.jpg',
                    'created_at'        => '2021-07-13 05:08:21',
                    'updated_at'        => '2021-08-03 00:21:46',
                ),
        ));

        User::factory()->create(['email' => 'webdevmatics@gmail.com', 'mobile' => 9779809333222]);

    }
}
