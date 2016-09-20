<?php

namespace SedpMis\Bingo\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register()
    {
        $repos = [
            'Cards'
        ];
        
        foreach ($repos as $i => $repo) 
        {
            $this->app->bind(
                "SedpMis\\Bingo\\Repositories\\{$repo}\\{$repo}RepositoryInterface",
                "SedpMis\\Bingo\\Repositories\\{$repo}\\{$repo}RepositoryEloquent"
            );
        }
    }
}