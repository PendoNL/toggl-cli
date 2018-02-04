<?php

namespace App\Commands;

class StartTimer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:start {description} {project}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a new timer';

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
        $timer = $this->client->StartTimeEntry([
            'time_entry' => [
                'description' => $this->argument('description'),
                'pid' => $this->argument('project'),
                'created_with' => $this->client_name,
            ]
        ]);

        dd($timer);
    }
}
