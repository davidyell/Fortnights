<?php

/**
 * Fortnight.php
 *
 * @author David Yell <neon1024@gmail.com>
 */

namespace Fortnight;

use DateTimeImmutable;
use DateTimeInterface;

class Fortnight
{
    /**
     * Get the start and end dates for the fortnight using a date
     *
     * @param \DateTimeInterface|null $date The date to calculate for or null for the current date
     * @param string $format A valid date format from http://php.net/manual/en/function.date.php
     *
     * @return array
     * @throws \Exception When an error is encountered
     */
    public function dates(?DateTimeInterface $date = null, string $format = 'Y-m-d'): array
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

        if ($weekNo % 2 === 0) {
            $start = $monday->sub(new \DateInterval('P7D'));
            $end = $start->add(new \DateInterval('P13D'));

        } else {
            $start = $monday;
            $end = $start->add(new \DateInterval('P13D'));
        }

        return [
            'start' => $start->format($format),
            'end' => $end->format($format)
        ];
    }
}
