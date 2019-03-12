<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Repositories\PostRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GeneratePosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:posts {count}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate rundom post';

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
    public function handle()
    {
        $count = $this->argument('count');
        PostRepository::generatePost($count);

    }
}
