<?php

namespace App\Tests;

use App\Tasktracker\Entity\Board;
use App\Tasktracker\Entity\User;
use Codeception\Test\Unit;

class BoardTest extends Unit
{
    /**
     * @var UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
    }

    protected function _after()
    {
    }

    // tests
    public function testSuccessfulCreate()
    {
        $owner = new User('testUser', 'testuser@gmail.com');
        $board = new Board('testBoard', $owner);
        $this->assertEquals('testBoard', $board->getName());
        $this->assertEquals($owner, $board->getOwner());
        $this->assertEquals([], $board->getParticipants());
        $this->assertEquals(null, $board->getDescription());
    }
    
    public function testEmpty()
    {
        $this->expectException(\InvalidArgumentException::class);
        $owner = new User('testUser', 'testuser@gmail.com');
        new Board();
        new Board('');
        new Board('', $owner);
    }
}
