<?php

namespace Strakez\SymLink;

use Illuminate\Support\ServiceProvider;

class SymLinkServiceProvider extends ServiceProvider
{
    public function boot(){}

    public function register()
    {
        // register commands
        $this->app->singleton('command.symlink.projectlink', function( $app ){
            return $app['Strakez\SymLink\Commands\ProjectLinkCommand'];
        });
        $this->app->singleton('command.symlink.folderlink', function( $app ){
            return $app['Strakez\SymLink\Commands\FolderLinkCommand'];
        });

        $this->commands([
            'command.symlink.projectlink',
            'command.symlink.folderlink'
        ]);

    }
}
