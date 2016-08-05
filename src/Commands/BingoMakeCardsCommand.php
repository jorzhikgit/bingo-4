<?php

namespace SedpMis\Bingo\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use SedpMis\Bingo\Modules\CardMaker\CardMaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;


class BingoMakeCardsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bingo:make_cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make bingo cards.';

    /**
     * Card maker.
     * 
     * @var \SedpMis\Bingo\Modules\CardMaker\CardMaker
     */
    protected $cardMaker;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(CardMaker $cardMaker)
    {
        parent::__construct();

        $this->cardMaker = $cardMaker;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        ini_set('memory_limit', -1);

        $spaces = explode(',', $this->option('spaces'));

        DB::beginTransaction();

        $cards = $this->cardMaker->make($n = $this->argument('number'), $spaces);

        $cards->each(function ($card) {
            $card->save();
        });

        DB::commit();

        $this->info("Successfully generated {$n} cards!");
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
     return array(
         array('number', InputArgument::REQUIRED, 'Number of cards to make.'),
     );
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
     return array(
         array('spaces', 's', InputOption::VALUE_REQUIRED, 'Plots to be free spaces separated by commas.', 'n2'),
     );
    }
}