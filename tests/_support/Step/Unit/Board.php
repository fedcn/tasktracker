<?php
namespace App\Tests\Step\Unit;

class Board extends \App\Tests\UnitTester
{

    public $board;
    
    public function create()
    {
        $owner = new User('testUser', 'testuser@gmail.com');
        $this->board = new Board('testBoard', $owner);
    }
}
