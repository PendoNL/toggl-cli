<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class CreateProject extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:create {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Project within the active workspace';

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
        $name = $this->argument('name');

        $response = $this->client->CreateProject([
            'project' => [
                'name' => $name,
                'wid' => $this->getWorkspaceId(),
                'billable' => env('TOGGL_DEFAULT_BILLABLE'),
            ]
        ]);
        $project = $response['data'];

        $this->info("Project [<comment>" . $project['name'] . "</comment>] created, id: <comment>" . $project['id'] ."</comment>.");
    }

    /**
	 * Define the command's schedule.
	 *
	 * @param  \Illuminate\Console\Scheduling\Schedule $schedule
	 *
	 * @return void
	 */
	public function schedule(Schedule $schedule): void
	{
		// $schedule->command(static::class)->everyMinute();
	}
}
