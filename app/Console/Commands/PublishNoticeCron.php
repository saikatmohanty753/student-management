<?php

namespace App\Console\Commands;

use App\Models\Notice;
use Carbon\Carbon;
use Illuminate\Console\Command;

class PublishNoticeCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'publish-notice:cron';

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
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $notice = Notice::where('published_date', Carbon::now())->get();
        foreach ($notice as $key => $value) {
            # code...
        }
        $check = Notice::where([['id', $request->id], ['status', 0]])->count();
        if ($check == 1) {
            Notice::where('status', 0)
                ->where('id', $request->id)
                ->update(['status' => 1, 'published_date' => Carbon::now()]);
            $notice = Notice::find($request->id);
            $status = "Published";
            if ($notice->notice_type == 1) {
                //academic
                $users = User::whereIn('role_id', [14, 16])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_type == 2) {
                //exam

                $users = User::whereIn('role_id', [13, 17])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            } elseif ($notice->notice_type == 3) {
                $users = User::whereIn('role_id', [3, 13, 14, 16, 17])->get();
                foreach ($users as $key => $user) {
                    $user->notice_id = $request->id;
                    $user->notify(new UucNotice());
                }
            }

            // $user->notify(new Notice());
        }
        \Log::info($notice);
    }
}
