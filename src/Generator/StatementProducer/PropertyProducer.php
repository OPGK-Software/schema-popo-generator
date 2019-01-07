<?php
namespace Opgk\PopoGenerator\Generator\StatementProducer;


use Nette\PhpGenerator\ClassType;
use Opgk\PopoGenerator\StructPopulator\Property;
use Opgk\PopoGenerator\TypeGuesser\Result;

class PropertyProducer implements ProducerInterface
{

    public function produce(ClassType $class, Property $property, Result $type)
    {
        $class
            ->addProperty($property->getName())
            ->setVisibility('protected')
            ->addComment(sprintf('@var %s', $type->getTypehint()));
    }
}