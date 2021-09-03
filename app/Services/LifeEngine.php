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

        // 1. Any live cell with fewer than two live neighbours dies, as if by underpopulation.
        foreach($this->world as $rowIndex => $row) {
            foreach($row as $colIndex => $cell) {
                if ($cell == 1) {
                    $liveNeighbours = $this->countLiveNeighbours($rowIndex, $colIndex);

                    ($liveNeighbours < 2) ? $newWorld[$rowIndex][$colIndex] = 0 : $newWorld[$rowIndex][$colIndex] = 1;
                } else {
                    $newWorld[$rowIndex][$colIndex] = 0;
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