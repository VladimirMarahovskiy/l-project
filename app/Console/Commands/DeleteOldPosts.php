<?php

namespace App\Console\Commands;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteOldPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:old_post {day}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete old posts';

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
        $this->info('Start delete');
        $day = $this->argument('day');

        Post::oldPosts($day)->delete();

        $this->info('Finis delete');

    }
}
