<?php

namespace App\Commands;

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

        if(!$workspace_id = $this->getWorkspaceId()) {
            $this->error("Set an active Workspace first using the workspace:list command");
            return;
        }

        $response = $this->client->CreateProject([
            'project' => [
                'name' => $name,
                'wid' => $workspace_id,
                'is_private' => false,
                'billable' => env('TOGGL_DEFAULT_BILLABLE'),
            ]
        ]);
        $project = $response['data'];

        $this->info("Project [<comment>" . $project['name'] . "</comment>] created, id: <comment>" . $project['id'] ."</comment>.");

        $this->call("project:set", [
            'project' => intval($project['id']),
        ]);
    }
}
