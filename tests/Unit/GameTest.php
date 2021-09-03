<?php

namespace Tests\Unit;

use App\Services\GameEngine;

use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertInstanceOf;

class GameTest extends TestCase
{   
    protected function setUp(): void {
        
        //Instantiate System Under Test (Assess for all tests)
        $this->sut = new GameEngine();
    }

    public function test_engine_exists() {
        
        //Check if $sut is an instance of GameEngine class
        return assertInstanceOf(GameEngine::class, $this->sut);
    }

    public function test_explore_world(){
        
        //Act
        $result = $this->sut->isAlive(3,4); //check a random cell
        
        //Assert
        return $this->assertFalse($result); //check if $result is false
    }

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
}
