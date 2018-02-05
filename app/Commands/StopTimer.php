<?php

namespace App\Commands;

class StopTimer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:stop {timer?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Stops the currently running timer';

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
            $this->error("Unabled to find the currently active timer.");
            return;
        }

        $response = $this->client->StopTimeEntry([
            'id' => $timer_id,
        ]);
        $timer = $response['data'];

        $this->info("Timer [<comment>" . $timer['description'] . "</comment>] stopped, ran for <comment>" . $timer['duration'] . "</comment> seconds");

        $this->unsetTimer();
    }
}
