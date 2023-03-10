<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        date_default_timezone_set("Asia/Amman");
        
        //$branches = ["SV","CY","MU"];

        
        
        $logins = DB::table('rep_users')
            ->where("USR_CURRENCY","GBP")
            ->select('USR_LOGIN','branch')
            ->get()
            ->toArray()
            ;


        for($i = 0; $i <100;$i++){

            $random_user = $logins[array_rand($logins,1)];
    
            $ticket  = random_int(100000,999999);
            DB::table('rep_trades')->insert(
                [
                    'TRD_TICKET' => $ticket, 
                    'TRD_CMD' => random_int(6,7),
                    'BRANCH' => $random_user->branch,
                    'TRD_LOGIN'=> $random_user->USR_LOGIN,
                    "TRD_MODIFY_TIME" =>  date("Y-m-d H:i:s")
                ]
            );
        }
        
        //end
        
        
    }
}