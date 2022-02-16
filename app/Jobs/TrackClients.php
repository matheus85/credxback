<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Tracking;

class TrackClients implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $trackings = Tracking::all();

        foreach ($trackings as $tracking) {
            $code = null;

            $ch = curl_init($tracking->url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_CONNECTTIMEOUT => 5,
                CURLOPT_TIMEOUT        => 5
            ]);

            $data = curl_exec($ch);
            $info = curl_getinfo($ch);
            $code = $info['http_code'];
            
            curl_close($ch);

            $tracking->code = $code;
            $tracking->body = $data;
            $tracking->last_query = now();
            $tracking->save();
        }
    }
}
