<?php
namespace Opgk\PopoGenerator\StructPopulator;


class Struct
{

    /**
     * @var Property[]
     */
    private $properties = [];
    /**
     * @var string
     */
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return Property[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param Property $properties
     */
    public function addProperty(Property $properties): void
    {
        $this->properties[] = $properties;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Struct[]
     */
    public function getChildrenStructs(){
        $result = [];
        foreach($this->properties as $p){
            $items = $p->getItems();
            if($items){
                $result = array_merge($result, [$items], $items->getChildrenStructs());
            }
        }
        return $result;
    }

}