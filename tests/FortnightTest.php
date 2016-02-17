<?php

/**
 * FortnightTest.php
 *
 * @author David Yell <neon1024@gmail.com>
 */

namespace Fortnight\Test\Lib;

use DateTimeImmutable;
use DateTimeInterface;
use Fortnight\Fortnight;
use PHPUnit_Framework_TestCase;

class FortnightTest extends PHPUnit_Framework_TestCase
{
    /**
     * @type \Fortnight\Fortnight Class instance
     */
    protected $Fortnight;

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

    /**
     * Test that a different format works
     */
    public function testFormat()
    {
        $result = $this->Fortnight->dates(new DateTimeImmutable('2016-02-02'), 'l jS F Y');
        $expected = [
            'start' => 'Monday 1st February 2016',
            'end' => 'Sunday 14th February 2016'
        ];

        $this->assertEquals($expected, $result);
    }


}
