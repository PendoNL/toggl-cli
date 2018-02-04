<?php

namespace App\Commands;

class SetActiveProject extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:set {project}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets a project to work within';

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
        $project_id =  $this->getProjectId();

        if(!$this->setProject($project_id)) {
            return;
        }

        $this->info("Project [<comment>$project_id</comment>] activated.");
    }

    /**
     * @param $project_id
     * @return bool
     */
    private function setProject($project_id)
    {
        if(!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        $currentEnv         = file_get_contents(base_path('.env'));
        $currentProject     = "TOGGL_ACTIVE_PROJECT=" . env('TOGGL_ACTIVE_PROJECT');
        $newProject         = "TOGGL_ACTIVE_PROJECT=" . $project_id;

        file_put_contents(base_path('.env'), str_replace($currentProject, $newProject, $currentEnv));

        return true;
    }
}
