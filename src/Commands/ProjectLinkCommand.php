<?php

namespace Strakez\SymLink\Commands;

use Illuminate\Console\Command;

class ProjectLinkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:link {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Link the project\'s public folder to another path';

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
        $link_path = $this->getPathInput();
        $base_path = public_path();

        if (file_exists($link_path)) {
            return $this->error("The '{$link_path}' directory already exists.");
        }

        $this->laravel->make('files')->link(
            $base_path, $link_path
        );

        $this->info("The '{$link_path}' directory has been linked.");
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getPathInput()
    {
        return trim($this->argument('path'));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['path', InputArgument::REQUIRED, 'The destination path to be linked'],
        ];
    }
}

