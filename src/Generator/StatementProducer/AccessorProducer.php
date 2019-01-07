<?php
namespace Opgk\PopoGenerator\Generator\StatementProducer;


use Doctrine\Common\Inflector\Inflector;
use Opgk\PopoGenerator\StructPopulator\Property;

abstract class AccessorProducer implements ProducerInterface
{

    protected function getPropertyNameForAccessor(Property $property){
        $name = $property->getName();
        $name = Inflector::classify($name);
        return $name;
    }

}