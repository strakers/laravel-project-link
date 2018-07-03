<?php

namespace Strakez\SymLink\Commands;

use Illuminate\Console\Command;

class FolderLinkCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folder:link {src_path} {link_path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $base_path = realpath($this->getSourcePathInput());
        $link_path = $this->getLinkPathInput();

        if (file_exists($link_path)) {
            return $this->error("The destination '{$link_path}' directory already exists.");
        }


        if (file_exists($base_path)) {
            $this->laravel->make('files')->link(
                $base_path, $link_path
            );
        }
        else {
            return $this->error("The source '{$base_path}' directory does not exist.");
        }

        $this->info("The link at '{$link_path}' has been created.");
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getLinkPathInput()
    {
        return (trim($this->argument('link_path')));
    }

    /**
     * Get the desired class name from the input.
     *
     * @return string
     */
    protected function getSourcePathInput()
    {
        return (trim($this->argument('src_path')));
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['src_path', InputArgument::REQUIRED, 'The source path to be linked'],
            ['link_path', InputArgument::REQUIRED, 'The destination path to be linked'],
        ];
    }
}

