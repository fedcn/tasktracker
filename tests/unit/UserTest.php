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
        $user = new \App\Tasktracker\Entities\User('test', 'test@gmail.com');
        $this->assertEquals('test', $user->getName());
        $this->assertEquals('test@gmail.com', $user->getEmail());
        $this->assertNotEmpty($user->getId());
    }
    
    public function testEmptyUser()
    {
        $this->expectException(\InvalidArgumentException::class);
        new \App\Tasktracker\Entities\User();
        new \App\Tasktracker\Entities\User('');
        new \App\Tasktracker\Entities\User('test');
        new \App\Tasktracker\Entities\User('', '');
        new \App\Tasktracker\Entities\User('test', '');
    }
}
