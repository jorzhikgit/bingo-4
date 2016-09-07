<?php

namespace SedpMis\Bingo\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Console\Command;
use SedpMis\Bingo\Models\Card;

class BingoDumpCardsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bingo:dump_cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Dump bingo cards into json file.';

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
    public function fire()
    {
        ini_set('memory_limit', -1);

        $filename = $this->argument('filename').'.json';

        if ((new File)->exists($filepath = base_path("data_cards/{$filename}"))) {
            throw new \Exception("File already exists bingo/data_cards/{$filename}");
        }

        (new File)->put($filepath, Card::all()->toJson());

        $this->info("Successfully dumped cards into bingo/data_cards/{$filename}!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('filename', InputArgument::REQUIRED, 'Filename to save.'),
        );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    // protected function getOptions()
    // {
    //     return array(
    //         array('spaces', 's', InputOption::VALUE_REQUIRED, 'Plots to be free spaces separated by commas.', 'n2'),
    //     );
    // }
}