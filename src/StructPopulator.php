<?php
namespace Opgk\PopoGenerator;


use Doctrine\Common\Inflector\Inflector;
use Opgk\PopoGenerator\StructPopulator\Property;
use Opgk\PopoGenerator\StructPopulator\Struct;

class StructPopulator
{

    public function createStructForNode($node, ?string $name = null)
    {
        $result = new Struct(
            $this->getNameForNode($node, $name)
        );

        foreach($node->properties as $k=>$item){
            $type = $item->type;

            $property = new Property($k, $type);

            if(isset($item->items)){
                $property->createItems(
                    $this->createStructForNode($item->items, $k)
                );
            }

            $result->addProperty($property);
        }

        return $result;
    }

    private function getNameForNode($node, ?string $name = null): string
    {
        if(!empty($node->title)){
            return $node->title;
        }

        if($name) {
            $result = Inflector::classify($name);
            $result = Inflector::singularize($result);
            return $result;
        }

        return sprintf('Object_%s', uniqid());
    }

}