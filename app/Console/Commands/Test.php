<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
class Test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expired user automaticlly';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user=User::where('expired',0)->get();
        foreach($user as $item):
            if($item->expired==0){
                $item->update(['expired' => 1]);
               
            }
            
        endforeach;
        
}
}