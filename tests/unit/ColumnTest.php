<?php namespace App\Tests;

class ColumnTest extends \Codeception\Test\Unit
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
    
    /**
     * test creation new columns
     * @dataProvider dataProvider
     */
    public function testColumnCreate($data)
    {
        
        $user = new \App\Tasktracker\Entity\User('test', 'test@gmail.com');
        $board = new \App\Tasktracker\Entity\Board('test', $user);
        foreach ($data as $item) {
            [$expectedCount, $name] = $item;
            $column = new \App\Tasktracker\Entity\Column($name);
            $board->addColumn($column);
            $this->assertEquals($name, $column->getName());
            $this->assertEquals($board->getColumnsCount(), $column->getOrder());
            $this->assertEquals($expectedCount, $board->getColumnsCount());
        }
    }
    
    public function dataProvider()
    {
        return [
            [
                [
                    [1, 'todo'],
                    [2, 'work'],
                ]
            ],
        ];
    }
}
