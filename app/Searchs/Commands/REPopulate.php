<?php
namespace App\Searchs\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use ScoutElastic\Facades\ElasticClient;

class REPopulate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     * @translator laravelacademy.org
     */
    protected $signature = 'elasticsearch:repopulate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'repopulate elasticsearch with data';
    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if (!$this->confirm('此命令会删除所有ES数据, 你确定吗?')) {
            return ;
        }

        $models = config("scout_elastic.models");

        foreach ($models as $model) {
            $indexer = with(new $model)->indexConfigurator;
            ElasticClient::indices()->delete(['index' => with(new $indexer)->getName()]);
            Artisan::call("elastic:create-index", ["index-configurator" => $indexer]);
            $this->info(Artisan::output());
            Artisan::call("elastic:update-mapping", ["model" => $model]);
            $this->info(Artisan::output());
            $this->info("importing {$model}");
            Artisan::call("scout:import", ["model" => $model]);
            $this->info(Artisan::output());
        }
    }
}