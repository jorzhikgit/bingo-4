<?php

namespace SedpMis\Bingo\Commands;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use SedpMis\Bingo\Modules\CardMaker\CardMaker;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;
use SedpMis\Bingo\Models\WinningPattern;
use SedpMis\Bingo\Models\Pattern;
use SedpMis\Bingo\Models\Card;

class BingoWinningPatternsCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'bingo:winning_patterns';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate card\'s winning numbers for each patterns.';

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

        $patterns = Pattern::all();

        if ($patterns->count() == 0) {
            throw new \Exception('No patterns available in database.');
        }

        if (($total = Card::count()) == 0) {
            throw new \Exception('No cards available in database.');
        }

        $page = 1;
        $perPage = 500;
        $totalPages = $total / $perPage;

        while ($page < $totalPages) {
            \Paginator::setCurrentPage($page);
            $cards = Card::paginate($perPage);
            $this->info("Page {$page} of {$totalPages}...");
            $this->info("Generating winning patterns for cards {$cards->first()->id}-{$cards->last()->id}, ({$cards->count()})...");
            $this->info("Pattern count: {$patterns->count()}...");

            $inserts = [];

            foreach ($patterns as $pattern) {
                foreach ($cards as $card) {
                    $inserts[] = [
                        'card_id'    => $card->id,
                        'pattern_id' => $pattern->id,
                        'numbers'    => join(',', $this->generateWinningNumbers($pattern, $card))
                    ];
                }
            }

            DB::beginTransaction();
            DB::table('winning_patterns')->insert($inserts);
            DB::commit();

            $insertedCount = count($inserts);

            $this->info("...Successfully inserted {$insertedCount} rows!");

            $page++;
        }
    }

    public function generateWinningNumbers($pattern, $card)
    {
        $numbers = [];

        foreach ($pattern->plots() as $plot) {
            $numbers[] = $card->getNumberAtPlot($plot);
        }

        sort($numbers);

        return $numbers;
    }
}
