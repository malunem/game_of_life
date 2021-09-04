<?php

namespace App\Console\Commands;

use App\Services\LifeEngine;
use Illuminate\Console\Command;

class StartGame extends Command {

    protected $signature = 'startgame';
    protected $description = 'Game of Life';

    public function __construct(){
        parent::__construct();
    }

    public function handle(){
        //echo "funzione handle in esecuzione \n";

        $startgame = new LifeEngine();
        //echo "creata istanza di lifeengin \n";

        //congifuration 1
        $startgame->init([
            [0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0],
            [1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0],
            [0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 1, 0],
            [1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0, 1, 1, 1, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0],
            [0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0],
            [0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
        ]);
        $height = 16;
        $length = 16;
       

        //configuration 2
        /* $startgame->init([
            [0, 0, 0, 0, 0, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 1, 0],
            [1, 1, 1, 0, 1, 1, 1, 0],
            [0, 0, 0, 0, 0, 0, 0, 0],
            [0, 0, 0, 0, 1, 1, 1, 0],
            [0, 0, 0, 1, 1, 1, 0, 0],
            [0, 0, 0, 0, 0, 0, 0, 0],
        ]);
        $height = 7;
        $length = 8;
 */

        //echo "mondo inizializzato \n";
        var_dump($startgame);

        $stdin = fopen('php://stdin', 'r');
        var_dump($stdin);

        $iteration = 1; //debug

        while(true) {

        //echo "iterazione while n° $iteration \n";


            if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
                system('cls');
            } else {
                system('clear');
            }

            for ($row = 0; $row < $height; $row++) {
                //echo "iterazione for di row n°$row \n";

                $line = '';

                for ($col = 0; $col < $length; $col++) {
                //echo "iterazione for di col n°$col \n";
                    $cell = $startgame->isAlive($row, $col) ? 'O' : '-';
                    $line = $line . $cell . " ";
                }

                echo $line . "\n";
            }
            usleep(50000);
            $startgame->nextGeneration();
        }

        $iteration++;
    }
}