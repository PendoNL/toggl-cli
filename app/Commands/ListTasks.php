<?php

namespace App\Commands;

class ListTasks extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:list {project?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Lists all tasks within the active project';

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
        if(!$project_id = $this->getProjectId()) {
            $this->error("Set an active project first using the project:list command");
            return;
        }

        $tasks = $this->client->GetProjectTasks(['id' => $project_id]);

        $this->chooseTask($tasks);
    }

    /**
     * @param $tasks
     */
    private function chooseTask($tasks)
    {
        $options = [];

        foreach($tasks as $task) {
            $options[] = $task['name'] . ' #' .$task['id'];
        }

        list($name, $task_id) = explode("#", $this->choice('Choose the Task to work on', $options));

        $this->call("task:set", [
            'task' => intval($task_id),
        ]);
    }
}
