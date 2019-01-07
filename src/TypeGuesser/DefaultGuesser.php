<?php
namespace Opgk\PopoGenerator\TypeGuesser;


use Opgk\PopoGenerator\Generator\Config;
use Opgk\PopoGenerator\StructPopulator\Property;

class DefaultGuesser implements TypeGuesserInterface
{

    public function guessReturnTypes(Config $config, Property $property): ?Result
    {
        return new Result(
            $property->getType(), $property->getType()
        );
    }
}