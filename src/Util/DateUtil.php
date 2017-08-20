<?php

namespace Fousky\Component\iDoklad\Util;

/**
 * @author Lukáš Brzák <brzak@fousky.cz>
 */
class DateUtil
{
    /**
     * @param string $date
     *
     * @return false|\DateTime
     */
    public static function convertDateTime(string $date)
    {
        return \DateTime::createFromFormat('Y-m-d\TH:i:s', $date);
    }
}
