<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class UpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reporting:update';

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
        $logins = 
            DB::table('rep_users')
                
            ->join('rep_trades', 'rep_trades.trd_login', '=', 'rep_users.usr_login')
            ->where("rep_users.branch = rep_trades.branch")        
            ->whereIn('TRD_CMD',[6,7])    
            ->select('TRD_TICKET')
            ->get()
            ;
        
        
            foreach ($logins as $value) {
                DB::table('rep_trades')->where('TRD_TICKET',$value->TRD_TICKET)->update([
                    "TRD_MODIFY_TIME" =>  date("Y-m-d H:i:s")
                ]);
            }
        
    

    }
}