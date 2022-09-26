<?php

namespace Synerise\IntegrationCore\Mapper;

class Time
{
    const FORMAT_ISO_8601 = 'Y-m-d\TH:i:s.v\Z';

    public static function getCurrentTime(): string
    {
        return self::formatDateTimeAsIso8601(new \DateTime());
    }

    public static function formatDateTimeAsIso8601(\DateTime $dateTime): string
    {
        return $dateTime->format(self::FORMAT_ISO_8601);
    }
}
