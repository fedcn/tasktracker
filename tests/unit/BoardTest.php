<?php

namespace App\Tests;

use App\Tasktracker\Entity\Board;
use App\Tasktracker\Entity\User;
use ArgumentCountError;
use Codeception\Test\Unit;
use InvalidArgumentException;

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

    /**
     * Creating a task board
     * @before testAddParticipant
     */
    public function testSuccessfulCreate()
    {
        $owner = new User('testUser', 'testuser@gmail.com');
        $board = new Board('testBoard', $owner);
        $this->assertEquals('testBoard', $board->getName());
        $this->assertEquals($owner, $board->getOwner());
        $this->assertEquals(0, count($board->getParticipants()));
        $this->assertEquals(null, $board->getDescription());
    }
    
    /**
     * @after testSuccessfulCreate
     */
    public function testAddParticipant()
    {
        $user1 = new User('testUser1', 'testuser1@gmail.com');
        $board = $this->createBoard();
        $board->add($user1);
        $this->assertEquals(1, count($board->getParticipants()));
    }
    
    public function testEmpty()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectException(ArgumentCountError::class);
        $owner = new User('testUser', 'testuser@gmail.com');
        new Board();
        new Board('');
        new Board('', $owner);
    }
    
    private function createBoard(): Board
    {
        $owner = new User('testUser', 'testuser@gmail.com');
        return new Board('testBoard', $owner);
    }
}
