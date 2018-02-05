<?php

namespace App\Commands;

class SetActiveTimer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:set {timer}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the active timer';

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
        $timer_id =  $this->getTimerId();

        if(!$this->setTimer($timer_id)) {
            return;
        }

        $this->info("Timer [<comment>$timer_id</comment>] is running...");
    }

    /**
     * @param $timer_id
     * @return bool
     */
    private function setTimer($timer_id)
    {
        if(!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        $currentEnv     = file_get_contents(base_path('.env'));
        $currentTimer   = "TOGGL_ACTIVE_TIMER=" . env('TOGGL_ACTIVE_TIMER');
        $newTimer       = "TOGGL_ACTIVE_TIMER=" . $timer_id;

        file_put_contents(base_path('.env'), str_replace($currentTimer, $newTimer, $currentEnv));

        return true;
    }
}
