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
        $arguments = $this->arguments();

        if(!array_key_exists('workspace', $arguments) || is_null($this->argument('workspace'))) {
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
        $arguments = $this->arguments();

        if(!array_key_exists('project', $arguments) || is_null($this->argument('project'))) {
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
        $arguments = $this->arguments();

        if(!array_key_exists('task', $arguments) || is_null($this->argument('task'))) {
            if(!intval(env('TOGGL_ACTIVE_TASK')) > 0) {
                $this->error('Please set your active task or use the task argument.');
                return false;
            }

            return intval(env('TOGGL_ACTIVE_TASK'));
        }

        return intval($this->argument('task'));
    }

    /**
     * @return int
     */
    public function getTimerId()
    {
        $arguments = $this->arguments();

        if(!array_key_exists('timer', $arguments) || is_null($this->argument('timer'))) {
            if(!intval(env('TOGGL_ACTIVE_TIMER')) > 0) {
                $this->error('Please set your active timer or use the timer argument.');
                return false;
            }

            return intval(env('TOGGL_ACTIVE_TIMER'));
        }

        return intval($this->argument('timer'));
    }
}
