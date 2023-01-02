<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branches = ["SV","CY","MU"];
        
        $logins = DB::table('rep_users')->select('USR_LOGIN')->pluck('USR_LOGIN');
        //first chart 1
        DB::table('rep_trades')->insert(
            [
                'TRD_TICKET' => random_int(100000,999999), 
                'TRD_CMD' => random_int(6,7),
                'BRANCH' => $branches[array_rand($branches,1)],
                'TRD_LOGIN'=> $logins[array_rand($logins,1)],
            ]
        );
        
        //end
        
        
    }
}
