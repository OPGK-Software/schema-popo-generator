<?php
namespace Opgk\PopoGenerator\Generator\StatementProducer;


use Nette\PhpGenerator\ClassType;
use Opgk\PopoGenerator\StructPopulator\Property;
use Opgk\PopoGenerator\TypeGuesser\Result;

class GetterProducer extends AccessorProducer
{

    public function produce(ClassType $class, Property $property, Result $type)
    {
        $getter = $class
            ->addMethod(sprintf('get%s', $this->getPropertyNameForAccessor($property)))
            ->setBody(sprintf('return $this->%s;', $property->getName()))
            ->addComment(sprintf('@return %s', $type->getTypehint()));

        if($type->getReturnType()){
            $getter->setReturnType($type->getReturnType());
        }
    }
}