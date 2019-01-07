<?php
namespace Opgk\PopoGenerator\Generator;


class Class_
{
    /**
     * @var string
     */
    private $fqcn;
    /**
     * @var string
     */
    private $blob;

    public function __construct(string $fqcn, string $blob)
    {
        $this->fqcn = $fqcn;
        $this->blob = $blob;
    }

    /**
     * @return string
     */
    public function getFqcn(): string
    {
        return $this->fqcn;
    }

    /**
     * @return string
     */
    public function getBlob(): string
    {
        return $this->blob;
    }

}