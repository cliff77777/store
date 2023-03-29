<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\SendMailJob;
use App\Models\Merchandise;
use App\Models\User;

class SendMailCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'SendMailCommand';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SendMailCommand';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //撈取最新10筆商品資料
        $get_merchandise_data=10;
        $MerchandiseCollection=Merchandise::OrderBy('created_at','desc')
        ->where('status','=',1)
        ->take($get_merchandise_data)
        ->get();

        //一次寄給10個會員
        $user_per_page=10;
        $page=1;
        while(true){
            //跳過會員數量
            $skip = ($page-1) * $user_per_page;
            $user_date=User::orderBy('id','asc')
            ->skip($skip)
            ->take($user_per_page)
            ->get();

            //沒有會員了就跳出
            if(!$user_date->count()){
                break;
            }
            //寄給每個撈取的會員
            foreach($user_date as $User){
                SendMailJob::dispatch($User,$MerchandiseCollection);
            }
            //都完成後在接續下個10會員
            $page++;
        }


        return Command::SUCCESS;
    }
}
