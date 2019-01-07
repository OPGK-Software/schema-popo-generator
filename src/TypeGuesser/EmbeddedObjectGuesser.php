<?php
namespace Opgk\PopoGenerator\TypeGuesser;


use Opgk\PopoGenerator\Generator;
use Opgk\PopoGenerator\Generator\Config;
use Opgk\PopoGenerator\StructPopulator\Property;

class EmbeddedObjectGuesser implements TypeGuesserInterface
{

    public function guessReturnTypes(Config $config, Property $property): ?Result
    {
        $items = $property->getItems();
        if(!$items) {
            return null;
        }

        $returnType = Generator::getFqcnForStruct($items, $config);
        $typehint = sprintf('\\%s', $property->getType());
        $isCollection = false;

        if($property->getType() == 'array'){
            $typehint = sprintf('\\%s[]', $returnType);
            $returnType = 'array';
            $isCollection = true;
        }else if($property->getType() == 'object'){
            $returnType = 'object';
        }

        return new Result($typehint, $returnType, $isCollection);
    }

}