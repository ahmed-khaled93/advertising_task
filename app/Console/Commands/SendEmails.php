<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Ad;
use Carbon\Carbon;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:advertiserEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = ' A daily email at 08:00 PM that will be sent to advertisers who have ads the next day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // get all the ads the will start tomorrow
        $ads = Ad::where('start_date', Carbon::tomorrow())->get();

        // send remainder emails to the ads advertisers
        foreach($ads as $ad)
        {
          \Mail::raw("Your Ad Will Be Tomorrow", function ($mail) use ($ad) {
                $mail->from('test@advertisment.com');
                $mail->to($ad->user->email)
                    ->subject('Advertisment Remainder');
            });
        }

        $this->info('Successfully sent remainders to the advertisers.');
    }
}
