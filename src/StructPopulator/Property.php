<?php
namespace Opgk\PopoGenerator\StructPopulator;


class Property
{

    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $type;
    /**
     * @var array|null
     */
    private $attributes = [];

    /**
     * @var Struct
     */
    private $items;

    /**
     * @var bool
     */
    private $required = false;

    public function __construct(string $name, string $type, ?array $attributes = [])
    {
        $this->name = $name;
        $this->type = $type;
        $this->attributes = $attributes;
    }

    public function createItems(Struct $struct)
    {
        $this->items = $struct;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return array|null
     */
    public function getAttributes(): ?array
    {
        return $this->attributes;
    }

    /**
     * @return Struct|null
     */
    public function getItems(): ?Struct
    {
        return $this->items;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @param bool $required
     */
    public function setRequired(bool $required): void
    {
        $this->required = $required;
    }

}