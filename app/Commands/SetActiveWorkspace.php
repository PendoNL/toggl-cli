<?php

namespace App\Commands;

class SetActiveWorkspace extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'workspace:set {workspace}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets a workspace to work within';

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
        $workspace_id = $this->getWorkspaceId();

        if(!$this->setWorkspace($workspace_id)) {
            return;
        }

        $this->info("Workspace [<comment>$workspace_id</comment>] activated.");
    }

    /**
     * @param $workspace_id
     * @return bool
     */
    private function setWorkspace($workspace_id)
    {
        if(!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        $currentEnv         = file_get_contents(base_path('.env'));
        $currentWorkspace   = "TOGGL_ACTIVE_WORKSPACE=" . env('TOGGL_ACTIVE_WORKSPACE');
        $newWorkspace       = "TOGGL_ACTIVE_WORKSPACE=" . $workspace_id;

        file_put_contents(base_path('.env'), str_replace($currentWorkspace, $newWorkspace, $currentEnv));

        return true;
    }
}
