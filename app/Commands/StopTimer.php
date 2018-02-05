<?php

namespace App\Commands;

class StopTimer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:stop';

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

        $this->info("Timer [<command>" . $timer['description'] . "</command>] stopped, ran for " . $timer['duration'] . " seconds");

        $this->unsetTimer();
    }

    private function unsetTimer()
    {
        if(!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        $currentEnv     = file_get_contents(base_path('.env'));
        $currentTimer   = "TOGGL_ACTIVE_TIMER=" . env('TOGGL_ACTIVE_TIMER');
        $newTimer       = "TOGGL_ACTIVE_TIMER=";

        file_put_contents(base_path('.env'), str_replace($currentTimer, $newTimer, $currentEnv));

        return true;
    }
}
