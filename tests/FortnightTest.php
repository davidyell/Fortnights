<?php

/**
 * FortnightTest.php
 *
 * @author David Yell <neon1024@gmail.com>
 */

namespace Fortnight\Test\Lib;

use DateTimeInterface;
use Fortnight\Fortnight;
use PHPUnit\Framework\TestCase;

class FortnightTest extends TestCase
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

    /**
     * @return array
     * @throws \Exception
     */
    public function providerDates(): array
    {
        return [
            'Week 5' => [
                new \DateTimeImmutable('2016-02-02'),
                ['start' => '2016-02-01', 'end' => '2016-02-14']
            ],
            'Week 7' => [
                new \DateTimeImmutable('2016-02-17'),
                ['start' => '2016-02-15', 'end' => '2016-02-28']
            ],
            'Week 6' => [
                new \DateTimeImmutable('2016-02-13'),
                ['start' => '2016-02-01', 'end' => '2016-02-14']
            ],
            'Week 53' => [
                new \DateTimeImmutable('2016-01-01'),
                ['start' => '2015-12-28', 'end' => '2016-01-10']
            ],
            'Week 5 again' => [
                new \DateTimeImmutable('2016-02-01'),
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
     * @throws \Exception
     */
    public function testDates(DateTimeInterface $date, $expected)
    {
        $result = $this->Fortnight->dates($date);

        $this->assertEquals($expected, $result);
    }

    /**
     * Test that a different format works
     *
     * @throws \Exception
     */
    public function testFormat()
    {
        $result = $this->Fortnight->dates(new \DateTimeImmutable('2016-02-02'), 'l jS F Y');
        $expected = [
            'start' => 'Monday 1st February 2016',
            'end' => 'Sunday 14th February 2016'
        ];

        $this->assertEquals($expected, $result);
    }


}
