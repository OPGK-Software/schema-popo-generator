<?php
namespace Opgk\PopoGenerator\TypeGuesser;


use Opgk\PopoGenerator\Generator\Config;
use Opgk\PopoGenerator\StructPopulator\Property;

interface TypeGuesserInterface
{

    public function guessReturnTypes(Config $config, Property $property): ?Result;

}