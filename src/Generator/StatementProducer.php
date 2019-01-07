<?php
namespace Opgk\PopoGenerator\Generator;


use Nette\PhpGenerator\ClassType;
use Opgk\PopoGenerator\Generator\StatementProducer\GetterProducer;
use Opgk\PopoGenerator\Generator\StatementProducer\ProducerInterface;
use Opgk\PopoGenerator\Generator\StatementProducer\PropertyProducer;
use Opgk\PopoGenerator\Generator\StatementProducer\SetterProducer;
use Opgk\PopoGenerator\StructPopulator\Property;
use Opgk\PopoGenerator\TypeGuesser\Result;

class StatementProducer
{

    /**
     * @var array|ProducerInterface[]
     */
    private $producers;

    public function __construct(?array $producers = null)
    {
        $this->producers = $producers ?: self::getDefaultProducers();
    }

    public static function getDefaultProducers()
    {
        return [
            new PropertyProducer(),
            new GetterProducer(),
            new SetterProducer()
        ];
    }

    public function produce(ClassType $class, Property $property, Result $type){

        foreach($this->producers as $p){
            $p->produce($class, $property, $type);
        }

    }

}