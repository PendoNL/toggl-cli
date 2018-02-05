<?php

namespace App\Commands;

class ListWorkspaces extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workspace:list';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all workspaces for the current user';

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
        $workspaces = $this->client->getWorkspaces([]);

        if(!count($workspaces)) {
            $this->error('No workspaces found, please set-up your toggle Workspace first.');
        }

        $this->chooseWorkspace($workspaces);
    }

    /**
     * @param $workspaces
     */
    private function chooseWorkspace($workspaces)
    {
        $options = [];

        foreach($workspaces as $workspace) {
            $options[] = $workspace['name'] . ' #' .$workspace['id'];
        }

        list($name, $workspace_id) = explode("#", $this->choice('Choose a Workspace to activate', $options));

        $this->call("workspace:set", [
            'workspace' => intval($workspace_id),
        ]);
    }
}
