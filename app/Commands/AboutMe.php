<?php

namespace App\Commands;

class AboutMe extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'about:me';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Show the logged in user';

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
        $response = $this->client->GetCurrentUser();
        $user = $response['data'];

        $this->info("Currently logged in as [<comment>" . $user['id'] . "</comment>]: " . $user['fullname']);
    }
}
