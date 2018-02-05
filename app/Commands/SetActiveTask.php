<?php

namespace App\Commands;

class SetActiveTask extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:set {task}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets a task to work on';

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
        $task_id =  $this->getTaskId();

        if(!$this->setTask($task_id)) {
            return;
        }

        $this->info("Task [<comment>$task_id</comment>] activated.");
    }

    /**
     * @param $task_id
     * @return bool
     */
    private function setTask($task_id)
    {
        if(!file_exists(base_path('.env'))) {
            copy(base_path('.env.example'), base_path('.env'));
        }

        $currentEnv     = file_get_contents(base_path('.env'));
        $currentTask    = "TOGGLE_ACTIVE_TASK=" . env('TOGGLE_ACTIVE_TASK');
        $newTask        = "TOGGLE_ACTIVE_TASK=" . $task_id;

        file_put_contents(base_path('.env'), str_replace($currentTask, $newTask, $currentEnv));

        return true;
    }
}
