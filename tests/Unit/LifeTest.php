<?php

namespace Tests\Unit;

use App\Services\LifeEngine;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertInstanceOf;

class LifeTest extends TestCase
{   
    protected function setUp(): void {
        
        //Instantiate System Under Test (Assess for all tests)
        $this->sut = new LifeEngine();
    }   

    public function test_engine_exists() {
        
        //Check if $sut is an instance of LifeEngine class
        return assertInstanceOf(LifeEngine::class, $this->sut);
    }

    /* public function test_explore_world(){
        
        //Act
        $result = $this->sut->isAlive(3,4); //check a random cell
        
        //Assert
        return $this->assertFalse($result); //check if $result is false
    } */

    public function test_world_exists(){

        //Act
        $this->sut->init([
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 0, 0]
        ]); //Inizialize a 5x5 world to check if init method works


        //Assert
        return $this->assertTrue($this->sut->isAlive(0,0)); //check if isAlive method works
        return $this->assertFalse($this->sut->isAlive(0,1)); //check if isAlive method works
    }

    //1. Any live cell with fewer than two live neighbours dies, as if by underpopulation.
    public function test_loneliness(){

        //Assess
        $this->sut->init([
            [1, 0, 0, 0, 0],
            [1, 0, 1, 0, 0],
            [0, 0, 0, 0, 0],
            [0, 0, 0, 1, 1],
            [0, 0, 0, 1, 1]
        ]);

        //Act
        $this->sut->nextGeneration();

        var_dump($this->sut);

        //Assert
        return $this->assertFalse($this->sut->isAlive(0,0));
        return $this->assertFalse($this->sut->isAlive(4,4));
    }

}
