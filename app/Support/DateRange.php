<?php

namespace App\Support;

class DateRange
{
    protected $startDate;
    protected $endDate;

    public function __construct(string $startDate, string $endDate)
    {
        $this->startDate = $this->format($startDate);
        $this->endDate   = $this->format($endDate);
    }

    public function getStartDate()
    {
        return $this->startDate;
    }

    public function getEndDate()
    {
        return $this->endDate;
    }

    public function getRange(string $timeFormat = 'U', bool $isIncludeEnd = false, string $intervalSpec = 'P1D')
    {
        $dateRange = [];

        if ($isIncludeEnd) {
            $startDate = date('Ymd', strtotime($this->endDate . '+1 day'));
        } else {
            $startDate = $this->startDate;
        }

        try {
            $period = new \DatePeriod(
                new \DateTime($startDate),
                new \DateInterval($intervalSpec),
                new \DateTime($this->endDate)
            );
        } catch (\Exception $e) {
            return [];
        }

        foreach ($period as $date) {
            $dateRange[] = (int) $date->format($timeFormat);
        }

        return $dateRange;
    }

    private function format(string $date)
    {
        if ($this->isValidTimeStamp($date)) {
            $date = date('Ymd', $date);
        }

        return $date;
    }

    private function isValidTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
}