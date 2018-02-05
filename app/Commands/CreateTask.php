<?php

namespace App\Commands;

class CreateTask extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:create {name} {project?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Task within the active project';

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

        if(!$project_id = $this->getProjectId()) {
            $this->error("Set an active Project first using the project:list command");
            return;
        }

        $response = $this->client->CreateTask([
            'task' => [
                'name' => $name,
                'pid' => $project_id,
            ]
        ]);
        $task = $response['data'];

        $this->info("Task [<comment>" . $task['name'] . "</comment>] created, id: <comment>" . $task['id'] ."</comment>.");

        $this->call("task:set", [
            'task' => intval($task['id']),
        ]);
    }
}
