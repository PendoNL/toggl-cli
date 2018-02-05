<?php

namespace App\Commands;

class TimerStatus extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays information on the running timer';

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
     * @return mixed
     */
    public function handle(): void
    {
        if(!$timer_id = $this->getTimerId()) {
            $this->error("No running timer found..");
            return;
        }

        $response = $this->client->GetTimeEntry([
            'id' => $timer_id,
        ]);
        $timer = $response['data'];

        if(array_key_exists('stop', $timer)) {
            $this->info("Timer [<comment>" . $timer['description'] . "</comment>] already stopped, ran for <comment>" . $timer['duration'] . "</comment> seconds");
            $this->unsetTimer();
        } else {
            $this->info("Timer [<comment>" . $timer['id'] . "</comment>] is currently running for <comment>" . ($response['data']['duration'] + time()) . "</comment> seconds");
        }
    }
}
