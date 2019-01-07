<?php
namespace Opgk\PopoGenerator;


use Opgk\PopoGenerator\Generator\Class_;
use Opgk\PopoGenerator\Generator\ClassCollection;
use Opgk\PopoGenerator\Generator\StatementProducer;
use Opgk\PopoGenerator\Generator\Config;
use Opgk\PopoGenerator\StructPopulator\Struct;
use Opgk\PopoGenerator\TypeGuesser\TypeGuesserChain;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpNamespace;

class Generator
{

    /**
     * @var Config
     */
    private $config;

    public function __construct(string $namespace)
    {
        $this->config = new Config($namespace);
    }

    public function generate(Struct $struct)
    {
        $structs = $this->getAllStructs($struct);

        $result = new ClassCollection();

        foreach($structs as $struct){
            $item = new Class_(self::getFqcnForStruct($struct, $this->config), $this->renderStruct($struct));
            $result->add($item);
        }

        return $result;
    }

    private function renderStruct(Struct $struct){
        $ns = new PhpNamespace($this->config->getNamespace());
        $class = new ClassType($struct->getName(), $ns);
        $guesser = new TypeGuesserChain($this->config);
        $statementProducer = new StatementProducer();

        foreach($struct->getProperties() as $property){
            $type = $guesser->getTypeForProperty($property);
            $statementProducer->produce($class, $property, $type);
        }

        return (string)$class;
    }

    /**
     * @param Struct $struct
     * @return Struct[]
     */
    public function getAllStructs(Struct $struct){
        $structs = array_merge([$struct], $struct->getChildrenStructs());
        return $structs;
    }

    public static function getFqcnForStruct(Struct $struct, Config $config){
        return sprintf('%s\\%s', $config->getNamespace(), $struct->getName());
    }

}