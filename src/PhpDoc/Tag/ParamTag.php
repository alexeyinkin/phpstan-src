<?php declare(strict_types = 1);

namespace PHPStan\PhpDoc\Tag;

use PHPStan\Type\Type;

class ParamTag implements TypedTag
{

	/** @var \PHPStan\Type\Type */
	private $type;

	/** @var bool */
	private $isVariadic;

	public function __construct(Type $type, bool $isVariadic)
	{
		$this->type = $type;
		$this->isVariadic = $isVariadic;
	}

	public function getType(): Type
	{
		return $this->type;
	}

	public function isVariadic(): bool
	{
		return $this->isVariadic;
	}

	/**
	 * @param Type $type
	 * @return static
	 */
	public function withType(Type $type): self
	{
		$clone = clone $this;
		$clone->type = $type;
		return $clone;
	}

	/**
	 * @param mixed[] $properties
	 * @return self
	 */
	public static function __set_state(array $properties): self
	{
		return new self(
			$properties['type'],
			$properties['isVariadic']
		);
	}

}
