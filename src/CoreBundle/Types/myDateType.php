<?php
namespace CoreBundle\Types;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;


class myDateType entends DateTimeType
{
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $dateTime = parent::convertToPHPValue($value, $platform);

        if ( ! $dateTime) {
            return $dateTime;
        }

        return new MyDateTime('@' . $dateTime->format('U'));
    }

    public function getName()
    {
        return 'mydate';
    }


}