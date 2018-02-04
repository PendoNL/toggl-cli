<?php

namespace App\Commands;

class ListProjects extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:list {workspace?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all projects';

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
        if(!$workspace_id = $this->getWorkspaceId()) {
            return;
        }

        $projects = $this->client->GetProjects(['id' => $workspace_id]);

        $this->chooseProject($projects);
    }

    /**
     * @param $projects
     */
    private function chooseProject($projects)
    {
        $options = [];

        foreach($projects as $project) {
            $options[] = $project['id'] . ' # ' .$project['name'];
        }

        list($project_id, $name) = explode("#", $this->choice('Choose the Project to work in', $options));

        $this->call("project:set", [
            'project' => intval($project_id),
        ]);
    }
}
