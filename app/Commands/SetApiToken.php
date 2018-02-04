<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class SetApiToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'set:token {token}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Saves a new API token';

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
        $token = $this->argument('token');

        if(!$this->setApiToken($token)) {
            return;
        }

        $this->info("API token [$token] set successfully.");
    }

    /**
     * Save the API token to the Environment file
     *
     * @param $token
     * @return bool
     */
    private function setApiToken($token)
    {
        if(!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        $currentEnv     = file_get_contents(base_path('.env'));
        $currentToken   = "TOGGL_API_KEY=" . env('TOGGL_API_KEY');
        $newToken       = "TOGGL_API_KEY=" . $token;

        file_put_contents(base_path('.env'), str_replace($currentToken, $newToken, $currentEnv));

        return true;
    }
}
