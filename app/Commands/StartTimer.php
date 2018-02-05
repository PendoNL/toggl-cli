<?php

namespace App\Commands;

class StartTimer extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'timer:start {description} {task?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start a new timer';

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
        $data = $this->prepareTimerData();

        $response = $this->client->StartTimeEntry([
            'time_entry' => $data,
        ]);
        $timer = $response['data'];

        $this->call("timer:set", [
            'timer' => intval($timer['id']),
        ]);
    }

    /**
     * @return array
     */
    private function prepareTimerData()
    {
        $timerData = [
            'description' => $this->argument('description'),
            'pid' => $this->getProjectId(),
            'tid' => $this->getTaskId(),
            'created_with' => $this->client_name,
        ];

        if($timerData['pid'] == false) {
            unset($timerData['pid']);
        }

        if($timerData['tid'] == false) {
            unset($timerData['tid']);
        }

        return $timerData;
    }
}
