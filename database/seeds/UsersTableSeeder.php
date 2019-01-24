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
            User::truncate();

            for ($i = 0; $i < 20; $i++) {
                User::create([
                    'name'     => 'Nuruzzaman Milon',
                    'email'    => 'test'.$i.'@gmail.com',
                    'password' => bcrypt('password'),
                    'is_admin' => false
                ]);
            }


        }
    }
