<?php
namespace Opgk\PopoGenerator\Example\Struct;

class Sub
{
	/** @var int|float */
	protected $id;

	/** @var string */
	protected $number;


	/**
	 * @return int|float
	 */
	public function getId()
	{
		return $this->id;
	}


	/**
	 * @param int|float id
	 */
	public function setId($id)
	{
		$this->id = $id;
	}


	/**
	 * @return string
	 */
	public function getNumber(): string
	{
		return $this->number;
	}


	/**
	 * @param string number
	 */
	public function setNumber(string $number)
	{
		$this->number = $number;
	}
}
