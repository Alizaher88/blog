<?php

namespace App\Jobs;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendEmail;
use App\Services\AudioProcessor;
use Illuminate\Support\Facades\Mail;
class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct()
    {
      
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $details = [
            'title' => 'Thank you for subscribing to my ali zaher',
            'body' => 'You will receive a newsletter every Fourth Friday of the month'

        ];
        
        Mail::To("ali@org.com")->send(new SendEmail($details) );
      
    }
}
