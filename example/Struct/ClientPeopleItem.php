<?php
namespace Opgk\PopoGenerator\Example\Struct;

class ClientPeopleItem
{
	/** @var int|float */
	protected $id;

	/** @var string */
	protected $first_name;

	/** @var string */
	protected $last_name;

	/** @var \Opgk\PopoGenerator\Example\Struct\Sub[] */
	protected $subs;


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
	public function getFirstName(): string
	{
		return $this->first_name;
	}


	/**
	 * @param string first_name
	 */
	public function setFirstName(string $first_name)
	{
		$this->first_name = $first_name;
	}


	/**
	 * @return string
	 */
	public function getLastName(): string
	{
		return $this->last_name;
	}


	/**
	 * @param string last_name
	 */
	public function setLastName(string $last_name)
	{
		$this->last_name = $last_name;
	}


	/**
	 * @return \Opgk\PopoGenerator\Example\Struct\Sub[]
	 */
	public function getSubs(): array
	{
		return $this->subs;
	}


	/**
	 * @param \Opgk\PopoGenerator\Example\Struct\Sub[] subs
	 */
	public function setSubs(array $subs)
	{
		$this->subs = $subs;
	}
}
