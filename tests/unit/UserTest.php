<?php

namespace App\Tests;

class UserTest extends \Codeception\Test\Unit
{
    /**
     * @var \App\Tests\UnitTester
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
        $user = new \App\Tasktracker\Entity\User('test', 'test@gmail.com');
        $this->assertEquals('test', $user->getName());
        $this->assertEquals('test@gmail.com', $user->getEmail());
    }
    
    public function testEmptyUser()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectException(\ArgumentCountError::class);
        new \App\Tasktracker\Entity\User();
        new \App\Tasktracker\Entity\User('');
        new \App\Tasktracker\Entity\User('test');
        new \App\Tasktracker\Entity\User('', '');
        new \App\Tasktracker\Entity\User('test', '');
    }
}
