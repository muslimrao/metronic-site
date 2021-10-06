<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Factory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

    

        DB::table('airlines')->insert([[
            'airline_name' => "Alaska Airlines",
            'about' => 'Alaska Airlines is a major American airline headquartered in SeaTac, Washington, within the Seattle metropolitan area. It is the fifth largest airline in the United States when measured by fleet size',
            'domain' => "domain1.xyz.com",
            'logo' => "assets/uploads/domain_images/domain-1.jpg",
            'plan' => 1,

            'currency_type' => "USD",
            'measurement_type'  => "measurement",
            "timezone"      => "Asia/Karachi",

            'status' => 1
        ],[
            'airline_name' => "United Airlines",
            'about' => 'United Airlines, Inc. (commonly referred to as United) is a major American airline headquartered at Willis Tower in Chicago, Illinois.<br>United operates a large domestic and international route network spanning cities large and small across the United States and all six continents.[15] Measured by fleet size and the number of routes, it is the third-largest airline in the world',
            'domain' => "domain2.xyz.com",
            'logo' => "assets/uploads/domain_images/domain-2.jpg",
            'plan' => 1,

            
            'currency_type' => "CAD",
            'measurement_type'  => "measurement 2",
            "timezone"      => "America/Managua",


            'status' => 1
        ]]);


        DB::table('hubs')->insert([[
            'hub_name' => "Anchorage (ANC)",
            'airline_id' => 1,
            
        ],[
            'hub_name' => "Phoenix (PHX)",
            'airline_id' => 1,
        ],
        [
            'hub_name' => "Los Angeles (LAX)",
            'airline_id' => 2,
        ]]);


        DB::table('ranks')->insert([[
            'airline_id'        => 1,
            'rank_name' => "Training Captain",
            'hours_to_rank' => 1500,
            'num_flights' => 5,
            
        ],[
            'airline_id'        => 1,
            'rank_name' => "Captain",
            'hours_to_rank' => 4500,
            'num_flights' => 10,
        ],
        [
            'airline_id'        => 1,
            'rank_name' => "Senior First Officer",
            'hours_to_rank' => 2000,
            'num_flights' => 7,
        ],
        [
            'airline_id'        => 1,
            'rank_name' => "First Officer",
            'hours_to_rank' => 3000,
            'num_flights' => 9,
        ],[
            'airline_id'        => 2,
            'rank_name' => "Second Officer",
            'hours_to_rank' => 8000,
            'num_flights' => 11,
        ]]);



        DB::table('site_settings')->insert([
            'admin_title' => "Dran Groups Admin",
            'site_title' => "Dran Groups Frontend",


            'email_mode' => "smtp",
            'email_host' => "smtp.mailtrap.io",
            'email_username' => "76cd478baa7df0",
            'email_password' => "f2efac41711db7",
            'email_from' => "Dran Groups Email Admin",
            'email_port' => "465",
            'email_from_name' => "Dran Groups Email Admin",
            'email_to' => "fairsit.m@gmail.com",
            'email_subject' => "Dran Groups Subject",
            'mobilenumber_smsalerts' => "+923322160204",
            'airline_id' => 1,
        ]);


        DB::table('pilot_roles')->insert([
            [
                'slug' => "owner",
                'name'  => "Owner",
                'is_owner' => 1
            ],
            [
                'slug'      => 'admin',
                'name'  => "Administrator",
                'is_owner' => 0
            ],
            [
                'slug'      => 'manager',
                'name'  => "Manager",
                'is_owner' => 0
            ],
            [
                'slug'      => 'registered_user',
                'name'  => "Registered User",
                'is_owner' => 0
            ],
            [
                'slug'      => 'guest',
                'name'  => "Guest",
                'is_owner' => 0
            ]
        ]);

        

        $pilots_array = array();
        $faker = Factory::create();
        DB::table('pilots')->insert([

            [
            'airline_id'     => 1,
            'pilot_role_id'     => 1,
            'rank_id'           => 1,
            'hub_id'            => 1,
        
            'first_name'      => "Chad",
            'last_name'      => "Decker",
            'email'      => "fairsit.m@gmail.com",
            'password'      => Hash::make("admin123"),
            "bio"           => $faker->paragraph(3),
            "user_image"        => 'assets/uploads/user_images/dummy-image.jpg',

            "call_sign"         => $faker->sentence(1),
            "number_flights"        => 5,
            "vatsim_id"             => "12",
            "notifications"         => $faker->sentence(20),
            "join_date"             => date("Y-m-d")
            ],


            [
                'airline_id'     => 2,
                'pilot_role_id'     => 1,
                'rank_id'           => 5,
                'hub_id'            => 3,
            
                'first_name'      => "Musati",
                'last_name'      => "Limya",
                'email'      => "musatilimya@gmail.com",
                'password'      => Hash::make("admin123"),
                "bio"           => $faker->paragraph(3),
                "user_image"        => 'assets/uploads/user_images/dummy-image.jpg',
    
                "call_sign"         => $faker->sentence(1),
                "number_flights"        => 5,
                "vatsim_id"             => "12",
                "notifications"         => $faker->sentence(20),
                "join_date"             => date("Y-m-d")
                ],

        ]);



        
        for ($i = 0; $i <= 10; $i++)
        {
            $abc =  $i % 2;

            DB::table('pilots')->insert([
                'airline_id'     => rand(1,2),
                'pilot_role_id'     => rand(1,4),

                'rank_id'           => rand(1,5),
                'hub_id'            => rand(1,2),
            
                'first_name'      => ($i % 2 == 0 ? $faker->firstNameMale() : $faker->firstNameFemale()) ,
                'last_name'      => $faker->lastName(),
                'email'      => $faker->email(),
                'password'      => Hash::make("admin123"),
                "bio"           => $faker->paragraph(3),
                "user_image"        => $faker->imageUrl(),

                "call_sign"         => $faker->sentence(1),
                "number_flights"        => $i,
                "vatsim_id"             => $i  * 2,
                "notifications"         => $faker->sentence(20),
                "join_date"             => date("Y-m-d")
            ]);

        }



        DB::table('aircraft')->insert([

            [
                'aircraft_name'     => "Airbus A350",
                'airline_id'        => 1,
            ],
            [
                'aircraft_name'     => "Boeing 737 NG",
                'airline_id'        => 1,
            ],
            [
                'aircraft_name'     => "Boeing 787",
                'airline_id'        => 1,
            ]
        ]);



        DB::table('flight_history')->insert([

            [
                'pilot_id'              => 1,
                'flight_number'         => "A320",
                'aircraft_id'           => 1,
                'report'                => "Ok. Good.",
                'airport_depart'        => "2021-09-18",
                'airport_arrive'        => "2021-09-19",
                'route'                 => "2 routes",
                'status'                => 1,
                'flight_data'           => "Flight Data",
                'landing_rate'          => "Ok. Landing Rate.",
                'miles'                 => 4500,
                'fuel'                  => 500,
                'flight_time'           => rand(100, 11000) . '.' . rand(0, 10),
                'passengers'            => "10 Passengers",
            ],

            [
                'pilot_id'              => 1,
                'flight_number'         => "PK320",
                'aircraft_id'           => 2,
                'report'                => "Ok. Good.",
                'airport_depart'        => "2021-09-19",
                'airport_arrive'        => "2021-09-20",
                'route'                 => "1 routes",
                'status'                => 1,
                'flight_data'           => "Flight Data",
                'landing_rate'          => "Ok. Landing Rate.",
                'miles'                 => 5000,
                'fuel'                  => 500,
                'flight_time'           => rand(100, 11000) . '.' . rand(0, 10),
                'passengers'            => "20 Passengers",
            ],

            [
                'pilot_id'              => 1,
                'flight_number'         => "A320",
                'aircraft_id'           => 1,
                'report'                => "Ok. Good.",
                'airport_depart'        => "2021-09-15",
                'airport_arrive'        => "2021-09-16",
                'route'                 => "3 routes",
                'status'                => 1,
                'flight_data'           => "Flight Data",
                'landing_rate'          => "Ok. Landing Rate.",
                'miles'                 => 1200,
                'fuel'                  => 300,
                'flight_time'           => rand(100, 11000) . '.' . rand(0, 10),
                'passengers'            => "8 Passengers",
            ],

            
        ]);


        for ($i = 0; $i <= 50; $i++)
        {
            $depart = $i + 1;
            $arrive = $depart + 1;
            DB::table('flight_history')->insert([
                'pilot_id'              => rand(1,10),
                'flight_number'         => rand(3000,5000),
                'aircraft_id'           => rand(1,3),
                'report'                => $faker->paragraph(1),
                'airport_depart'        => $faker->date("Y-m-d", strtotime("+". $depart." day")),
                'airport_arrive'        => $faker->date("Y-m-d", strtotime("+". $arrive." day")),
                'route'                 => rand(1,5) . " routes",
                'status'                => 1,
                'flight_data'           => $faker->sentence(6),
                'landing_rate'          => $faker->sentence(1),
                'miles'                 => rand(3000, 10000),
                'fuel'                  => rand(300, 1500),
                'flight_time'           => rand(100, 11000) . '.' . rand(0, 10),
                'passengers'            => rand(50,100) . " Passengers",
            ],);

        }



        DB::table('roles_permissions')->insert([

            [
            'pilot_role_id'              => 5,
            'directory'                 => 'dashboard',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 5,
            'directory'                 => 'about-us',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 5,
            'directory'                 => 'pilot/view',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 5,
            'directory'                 => 'managepilots',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 5,
            'directory'                 => 'manageflightshistory',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 5,
            'directory'                 => '/',
            'operation'                 => 'redirect_after_login',
            ],








            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managepilots',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managepilots',
            'operation'                 => 'add',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managepilots',
            'operation'                 => 'edit',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managepilots',
            'operation'                 => 'save',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managepilots',
            'operation'                 => 'delete',
            ],







            [
            'pilot_role_id'              => 2,
            'directory'                 => 'manageflightshistory',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'manageflightshistory',
            'operation'                 => 'add',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'manageflightshistory',
            'operation'                 => 'edit',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'manageflightshistory',
            'operation'                 => 'save',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'manageflightshistory',
            'operation'                 => 'delete',
            ],





            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/aircraft',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/aircraft',
            'operation'                 => 'add',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/aircraft',
            'operation'                 => 'edit',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/aircraft',
            'operation'                 => 'save',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/aircraft',
            'operation'                 => 'delete',
            ],




            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/ranks',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/ranks',
            'operation'                 => 'add',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/ranks',
            'operation'                 => 'edit',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/ranks',
            'operation'                 => 'save',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings/ranks',
            'operation'                 => 'delete',
            ],




            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managemyaccount',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managemyaccount',
            'operation'                 => 'edit',
            ],




            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings',
            'operation'                 => 'view',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => 'managesitesettings',
            'operation'                 => 'save',
            ],

            [
            'pilot_role_id'              => 2,
            'directory'                 => '/',
            'operation'                 => 'redirect_after_login',
            ],
            
            

        ]);

    }
}