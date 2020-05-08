<?php declare(strict_types = 1);

namespace PHPStan\Rules\PhpDoc;

/**
 * @extends \PHPStan\Testing\RuleTestCase<InvalidThrowsPhpDocValueRule>
 */
class InvalidThrowsPhpDocValueRuleTest extends \PHPStan\Testing\RuleTestCase
{

	protected function getRule(): \PHPStan\Rules\Rule
	{
		return new InvalidThrowsPhpDocValueRule();
	}

	public function testRule(): void
	{
		$this->analyse([__DIR__ . '/data/incompatible-throws.php'], [
			[
				'PHPDoc tag @throws with type Undefined is not subtype of Throwable',
				54,
			],
			[
				'PHPDoc tag @throws with type bool is not subtype of Throwable',
				61,
			],
			[
				'PHPDoc tag @throws with type DateTimeImmutable is not subtype of Throwable',
				68,
			],
			[
				'PHPDoc tag @throws with type DateTimeImmutable|Throwable is not subtype of Throwable',
				75,
			],
			[
				'PHPDoc tag @throws with type DateTimeImmutable&IteratorAggregate is not subtype of Throwable',
				82,
			],
			[
				'PHPDoc tag @throws with type Throwable|void is not subtype of Throwable',
				96,
			],
			[
				'PHPDoc tag @throws with type stdClass|void is not subtype of Throwable',
				103,
			],
		]);
	}

	public function testMergeInheritedPhpDocs(): void
	{
		$this->analyse([__DIR__ . '/data/merge-inherited-throws.php'], [
			[
				'PHPDoc tag @throws with type InvalidThrowsPhpDocMergeInherited\A is not subtype of Throwable',
				13,
			],
			[
				'PHPDoc tag @throws with type InvalidThrowsPhpDocMergeInherited\B is not subtype of Throwable',
				19,
			],
			[
				'PHPDoc tag @throws with type InvalidThrowsPhpDocMergeInherited\A|InvalidThrowsPhpDocMergeInherited\B|InvalidThrowsPhpDocMergeInherited\C|InvalidThrowsPhpDocMergeInherited\D is not subtype of Throwable',
				28,
			],
			[
				'PHPDoc tag @throws with type InvalidThrowsPhpDocMergeInherited\A|InvalidThrowsPhpDocMergeInherited\B|InvalidThrowsPhpDocMergeInherited\C|InvalidThrowsPhpDocMergeInherited\D is not subtype of Throwable',
				34,
			],
			[
				'PHPDoc tag @throws with type InvalidThrowsPhpDocMergeInherited\A|InvalidThrowsPhpDocMergeInherited\B|InvalidThrowsPhpDocMergeInherited\C|InvalidThrowsPhpDocMergeInherited\D is not subtype of Throwable',
				39,
			],
		]);
	}

}
