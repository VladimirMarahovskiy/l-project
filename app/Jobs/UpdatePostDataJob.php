<?php

namespace App\Jobs;

use App\Repositories\PostRepository;
use App\Repositories\ReportsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

/**
 * Class ReportsJob
 * @package App\Jobs
 */
class UpdatePostDataJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 10800;


    /**
     * Data for report generation
     * @var array
     */
    public $data;

    /**
     * Create a new job instance.
     *
     * @param string $action
     * @param array $data
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @param PostRepository $repository
     *
     * @return void
     */
    public function handle(PostRepository $repository)
    {
        $repository->updatePostData($this->data);
    }
}
