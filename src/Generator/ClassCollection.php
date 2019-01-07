<?php
namespace Opgk\PopoGenerator\Generator;


class ClassCollection implements \IteratorAggregate
{

    /**
     * @var Class_[]
     */
    private $classes = [];

    public function add(Class_ $class){
        $this->classes[] = $class;
    }

    /**
     * @return \ArrayIterator|\Traversable|Class_[]
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->classes);
    }
}