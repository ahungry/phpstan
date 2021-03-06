<?php declare(strict_types = 1);

namespace PHPStan\Type;

class IterableIterableType implements IterableType
{

	use IterableTypeTrait;

	public function __construct(
		Type $itemType,
		bool $nullable
	)
	{
		$this->itemType = $itemType;
		$this->nullable = $nullable;
	}

	public function combineWith(Type $otherType): Type
	{
		if ($otherType instanceof IterableType) {
			return new self(
				$this->getItemType()->combineWith($otherType->getItemType()),
				$this->isNullable() || $otherType->isNullable()
			);
		}

		if ($otherType instanceof NullType) {
			return $this->makeNullable();
		}

		return new MixedType($this->isNullable() || $otherType->isNullable());
	}

	public function makeNullable(): Type
	{
		return new self($this->getItemType(), true);
	}

	public function accepts(Type $type): bool
	{
		if ($type instanceof self) {
			return $this->getItemType()->accepts($type->getItemType());
		}

		if ($type instanceof MixedType) {
			return true;
		}

		if ($this->isNullable() && $type instanceof NullType) {
			return true;
		}

		return false;
	}

	public function describe(): string
	{
		return sprintf('iterable(%s[])', $this->getItemType()->describe());
	}

}
