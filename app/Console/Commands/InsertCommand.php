<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class InsertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporting:insert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set("Asia/Amman");
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $logins = DB::table('rep_users')
            ->where("USR_CURRENCY","GBP")
            ->select('USR_LOGIN','branch')
            ->get()
            ->toArray()
            ;


        //for($i = 0; $i <100;$i++){

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
        //}
    

    }
}