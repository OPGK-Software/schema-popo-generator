<?php
namespace Opgk\PopoGenerator\TypeGuesser;


use Opgk\PopoGenerator\Generator\Config;
use Opgk\PopoGenerator\StructPopulator\Property;

class NumberGuesser implements TypeGuesserInterface
{

    public function guessReturnTypes(Config $config, Property $property): ?Result
    {
        if($property->getType() == 'number'){
            return new Result('int|float');
        }

        return null;
    }
}