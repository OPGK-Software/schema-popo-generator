<?php
namespace Opgk\PopoGenerator\Generator\StatementProducer;


use Nette\PhpGenerator\ClassType;
use Opgk\PopoGenerator\StructPopulator\Property;
use Opgk\PopoGenerator\TypeGuesser\Result;

class SetterProducer extends AccessorProducer
{

    public function produce(ClassType $class, Property $property, Result $type)
    {
        $setter = $class
            ->addMethod(sprintf('set%s', $this->getPropertyNameForAccessor($property)))
            ->setBody(sprintf('$this->%s = $%s;', $property->getName(), $property->getName()));

        $setterArg = $setter->addParameter($property->getName());

        if($type->isCollection()){
            $setterArg->setTypeHint('array');
        }else{
            $setterArg->setTypeHint($type->getReturnType());
        }

        $setter->addComment(sprintf('@param %s %s', $type->getTypehint(), $property->getName()));
    }
}