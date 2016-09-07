<?php

namespace SedpMis\Bingo\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Illuminate\Filesystem\Filesystem as File;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use SedpMis\Bingo\Models\Card;

class BingoLoadCardsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bingo:load_cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Load bingo cards into database from json file.';

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
        $filepath = base_path("data_cards/{$filename}");

        $cards = json_decode((new File)->get($filepath), true);

        if (($count = Card::count()) > 0 && !$this->confirm("Cards database has {$count} records. Do you wish to truncate table to load new cards? [Y/n]")) {
            $this->comment("Transaction cancelled!");
            return;
        }

        $cards = array_map(function ($card) {
            foreach (Card::columns() as $column) {
                $card[$column] = Card::stringifyNumbers($card[$column]);
            }
            return $card;
        }, $cards);

        DB::table('cards')->truncate();
        DB::table('cards')->insert($cards);
        
        $this->info("Successfully loaded cards from bingo/data_cards/{$filename}!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return array(
            array('filename', InputArgument::REQUIRED, 'Filename to load.'),
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