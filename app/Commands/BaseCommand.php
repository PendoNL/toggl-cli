<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

abstract class BaseCommand extends Command
{
    /*** @var mixed */
    public $client;

    /*** @var string */
    public $client_name = 'Pendo Toggl CLI';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->client = app()->make('Toggl');
    }

    /**
     * @return int
     */
    public function getWorkspaceId()
    {
        if(is_null($this->argument('workspace'))) {
            if(!intval(env('TOGGL_ACTIVE_WORKSPACE')) > 0) {
                $this->error('Please set your active workspace or use the workspace argument.');
                return false;
            }

            return intval(env('TOGGL_ACTIVE_WORKSPACE'));
        }

        return intval($this->argument('workspace'));
    }

    /**
     * @return int
     */
    public function getProjectId()
    {
        if(is_null($this->argument('project'))) {
            if(!intval(env('TOGGL_ACTIVE_PROJECT')) > 0) {
                $this->error('Please set your active project or use the project argument.');
                return false;
            }

            return intval(env('TOGGL_ACTIVE_PROJECT'));
        }

        return intval($this->argument('project'));
    }

    /**
     * @return int
     */
    public function getTaskId()
    {
        if(is_null($this->argument('task'))) {
            if(!intval(env('TOGGLE_ACTIVE_TASK')) > 0) {
                $this->error('Please set your active task or use the task argument.');
                return false;
            }

            return intval(env('TOGGLE_ACTIVE_TASK'));
        }

        return intval($this->argument('task'));
    }
}
