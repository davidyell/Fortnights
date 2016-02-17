<?php

/**
 * Fortnight.php
 *
 * @author David Yell <dyell@ukwebmedia.com>
 * @copyright 2016 UK Web Media Ltd
 */

namespace App\Lib;

use DateTimeImmutable;
use DateTimeInterface;

class Fortnight
{

    /**
     * Get the start and end dates for the fortnight using a date
     *
     * @param \DateTimeInterface|null $date The date to calculate for or null for the current date
     *
     * @return array
     */
    public function dates(DateTimeInterface $date = null)
    {
        if ($date === null) {
            $date = new DateTimeImmutable();
        }

        if (date('N', $date->format('U')) == 1) {
            $timestamp = '@' . $date->format('U');
        } else {
            $timestamp = '@' . strtotime('last monday', $date->format('U'));
        }

        $monday = new DateTimeImmutable($timestamp);
        $weekNo = (int)date('W', $monday->format('U'));

        if ($weekNo % 2 === 0) { // Even
            $start = $monday->sub(new \DateInterval('P7D'));
            $end = $start->add(new \DateInterval('P13D'));

        } else { // Odd
            $start = $monday;
            $end = $start->add(new \DateInterval('P13D'));
        }

        return [
            'start' => $start->format('Y-m-d'),
            'end' => $end->format('Y-m-d')
        ];
    }

}