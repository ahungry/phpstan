<?php

namespace ClosureReturnTypes;

use SomeOtherNamespace\Baz;

function () {
	return 1;
	return 'foo';
	return;
};

function (): int {
	return 1;
	return 'foo';
	return;
};

function (): string {
	return 'foo';
	return 1;
	return;
};

function (): Foo {
	return new Foo();
	return new Bar();
};

function (): \SomeOtherNamespace\Foo {
	return new Foo();
	return new \SomeOtherNamespace\Foo();
};

function (): Baz {
	return new Foo();
	return new Baz();
};
