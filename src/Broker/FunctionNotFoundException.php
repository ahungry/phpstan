<?php declare(strict_types = 1);

namespace PHPStan\Broker;

class FunctionNotFoundException extends \PHPStan\AnalysedCodeException
{

	/** @var string */
	private $functionName;

	public function __construct(string $functionName)
	{
		parent::__construct(sprintf('Function %s not found.', $functionName));
		$this->functionName = $functionName;
	}

	public function getFunctionName(): string
	{
		return $this->functionName;
	}

}
