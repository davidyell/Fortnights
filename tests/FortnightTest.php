<?php

/**
 * FortnightTest.php
 *
 * @author David Yell <dyell@ukwebmedia.com>
 * @copyright 2016 UK Web Media Ltd
 */

namespace TestCase\Lib;

use App\Lib\Fortnight;
use Cake\TestSuite\TestCase;
use DateTimeImmutable;
use DateTimeInterface;

class FortnightTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->Fortnight = new Fortnight();
    }

    public function tearDown()
    {
        parent::tearDown();
        unset($this->Fortnight);
    }

    public function providerDates()
    {
        return [
            [
                new DateTimeImmutable('2016-02-02'), // Week 5
                ['start' => '2016-02-01', 'end' => '2016-02-14']
            ],
            [
                new DateTimeImmutable('2016-02-17'), // Week 7
                ['start' => '2016-02-15', 'end' => '2016-02-28']
            ],
            [
                new DateTimeImmutable('2016-02-13'), // Week 6
                ['start' => '2016-02-01', 'end' => '2016-02-14']
            ],
            [
                new DateTimeImmutable('2016-01-01'), // Week 53
                ['start' => '2015-12-28', 'end' => '2016-01-10']
            ],
            [
                new DateTimeImmutable('2016-02-01'), // Week 5
                ['start' => '2016-02-01', 'end' => '2016-02-14']
            ],
        ];
    }

    /**
     * Test the start and end dates
     *
     * @param \DateTimeInterface $date A datetime instance to work from
     * @param array $expected Array of start and end date for the fortnight
     *
     * @dataProvider providerDates
     */
    public function testDates(DateTimeInterface $date, $expected)
    {
        $result = $this->Fortnight->dates($date);

        $this->assertEquals($expected, $result);
    }
}