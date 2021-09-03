<?php

namespace App\Services;

class LifeEngine{

    private $world;

    public function init($world){
       $this->world = $world;
    }

    public function isAlive($row, $col){
        return ($this->world[$row][$col] == 1);
    }

    public function nextGeneration(){
        
        $newWorld = [];
        //$oldWorld = $this->world;

        foreach($this->world as $rowIndex => $row) {
            foreach($row as $colIndex => $cell) {
                if ($cell == 1) {
                    $liveNeighbours = $this->countLiveNeighbours($rowIndex, $colIndex);

                    if ($liveNeighbours == 2 || $liveNeighbours == 3){
                        //Any live cell with two or three live neighbours lives on to the next generation.
                        $newWorld[$rowIndex][$colIndex] = 1;

                    } else {
                        //Any live cell with fewer than two live neighbours dies, as if by underpopulation.
                        //Any live cell with more than three live neighbours dies, as if by overpopulation.
                        $newWorld[$rowIndex][$colIndex] = 0;
                    }

                } else {
                    $liveNeighbours = $this->countLiveNeighbours($rowIndex, $colIndex);

                    if ($liveNeighbours == 3){
                        //Any dead cell with exactly three live neighbours becomes a live cell, as if by reproduction.              
                        $newWorld[$rowIndex][$colIndex] = 1;

                    } else {
                        //all other dead cells stay dead.
                        $newWorld[$rowIndex][$colIndex] = 0;
                    }
                }
            }
        }

        $this->world = $newWorld;
    }

    private function countLiveNeighbours($row, $col) {
        $count = 0;

        $maxRow = sizeof($this->world) - 1;
        $maxCol = sizeof($this->world[0]) - 1;

        if ($row < $maxRow) {
            ($this->world[$row+1][$col] == 1) ? $count++ : null;
        }

        if ($col < $maxCol) {
            ($this->world[$row][$col+1] == 1) ? $count++ : null;
        }
        
        if ($row > 0) {
            ($this->world[$row-1][$col] == 1) ? $count++ : null;
        }

        if ($col > 0) {
            ($this->world[$row][$col-1] == 1) ? $count++ : null;
        }

        if ($row > 0 && $col > 0) {
            ($this->world[$row-1][$col-1] == 1) ? $count++ : null;
        }

        if ($row > 0 && $col < $maxCol) {
            ($this->world[$row-1][$col+1] == 1) ? $count++ : null;
        }

        if ($row < $maxRow && $col > 0) {
            ($this->world[$row+1][$col-1] == 1) ? $count++ : null;
        }

        if ($row < $maxRow && $col < $maxCol) {
            ($this->world[$row+1][$col+1] == 1) ? $count++ : null;
        }

        return $count;
    }

}