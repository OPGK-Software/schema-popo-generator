<?php
namespace Opgk\PopoGenerator\TypeGuesser;


class Result
{

    /**
     * @var string
     */
    private $typehint;
    /**
     * @var string|null
     */
    private $returnType;
    /**
     * @var bool
     */
    private $isCollection;

    public function __construct(string $typehint, ?string $returnType = null, bool $isCollection = false)
    {
        $this->typehint = $typehint;
        $this->returnType = $returnType;
        $this->isCollection = $isCollection;
    }

    /**
     * @return string
     */
    public function getTypehint(): string
    {
        return $this->typehint;
    }

    /**
     * @return string
     */
    public function getReturnType(): ?string
    {
        return $this->returnType;
    }

    /**
     * @return bool
     */
    public function isCollection(): bool
    {
        return $this->isCollection;
    }




}