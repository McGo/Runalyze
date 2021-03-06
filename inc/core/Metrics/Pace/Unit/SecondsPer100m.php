<?php

namespace Runalyze\Metrics\Pace\Unit;

class SecondsPer100m extends AbstractPaceInTimeFormatUnit
{
    /**
     * @return string
     *
     * @codeCoverageIgnore
     */
    public function getAppendix()
    {
        return '/100m';
    }

    /**
     * @return float
     */
    public function getFactorFromBaseUnit()
    {
        return 0.1;
    }
}
