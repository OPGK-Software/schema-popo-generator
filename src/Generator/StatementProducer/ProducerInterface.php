<?php
namespace Opgk\PopoGenerator\Generator\StatementProducer;


use Nette\PhpGenerator\ClassType;
use Opgk\PopoGenerator\StructPopulator\Property;
use Opgk\PopoGenerator\TypeGuesser\Result;

interface ProducerInterface
{
    public function produce(ClassType $class, Property $property, Result $type);
}