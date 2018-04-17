<?php

namespace recyger\test\encry\int;

use Codeception\Example;
use Codeception\Util\Stub;
use recyger\encry\int\AbstractBase;
use recyger\encry\int\exceptions\InProgressException;
use ReflectionObject;

class AbstractBaseCest
{
    /**
     * @param \recyger\test\encry\int\UnitTester $I
     * @param \Codeception\Example               $example
     *
     * @dataProvider getDatumForPositiveTest
     * @throws \Exception
     */
    public function positiveTest(UnitTester $I, Example $example)
    {
        // Arrange && Act
        $actual = $this->run($I, $example);


        // Assert
        $I->assertEquals($example['expected'], $actual);
    }

    /**
     * @param \recyger\test\encry\int\UnitTester $I
     * @param \Codeception\Example               $example
     *
     * @dataProvider getDatumForNegativeTest
     * @throws \Exception
     */
    public function negativeTest(UnitTester $I, Example $example)
    {
        // Assert
        $I->expectException($example['exception'], function () use ($I, $example){
            // Arrange && Act
            $this->run($I, $example);
        });
    }

    /**
     * @return array
     */
    private function getDatumForPositiveTest(): array
    {
        return [
            // getDictionarySize
            [
                'method'     => 'getDictionarySize',
                'dictionary' => 0,
                'expected'   => 64,
            ],
            [
                'method'     => 'getDictionarySize',
                'dictionary' => 1,
                'expected'   => 32,
            ],
            [
                'method'     => 'getDictionarySize',
                'dictionary' => 2,
                'expected'   => 16,
            ],
            // getBytePerBlock
            [
                'method'     => 'getBytePerBlock',
                'dictionary' => 0,
                'expected'   => 6,
            ],
            [
                'method'     => 'getBytePerBlock',
                'dictionary' => 1,
                'expected'   => 5,
            ],
            [
                'method'     => 'getBytePerBlock',
                'dictionary' => 2,
                'expected'   => 4,
            ],
            // getBlockCount
            [
                'method'     => 'getBlockCount',
                'dictionary' => 0,
                'expected'   => 5,
            ],
            [
                'method'     => 'getBlockCount',
                'dictionary' => 1,
                'expected'   => 6,
            ],
            [
                'method'     => 'getBlockCount',
                'dictionary' => 2,
                'expected'   => 8,
            ],
            // getCodeByIndex
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 0,
                'arguments'  => [1],
                'expected'   => '-',
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 0,
                'arguments'  => [63],
                'expected'   => 'W',
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 1,
                'arguments'  => [1],
                'expected'   => 'K',
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 1,
                'arguments'  => [31],
                'expected'   => 'G',
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 2,
                'arguments'  => [1],
                'expected'   => 'W',
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 2,
                'arguments'  => [15],
                'expected'   => 'Z',
            ],
            // getIndexByCode
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 0,
                'arguments'  => ['a'],
                'expected'   => 56,
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 0,
                'arguments'  => ['.'],
                'expected'   => 15,
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 1,
                'arguments'  => ['K'],
                'expected'   => 1,
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 1,
                'arguments'  => ['G'],
                'expected'   => 31,
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 2,
                'arguments'  => ['W'],
                'expected'   => 1,
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 2,
                'arguments'  => ['Z'],
                'expected'   => 15,
            ],
        ];
    }

    private function getDatumForNegativeTest(): array
    {
        return [
            // getCodeByIndex
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 0,
                'arguments'  => [64],
                'exception'   => new InProgressException('The 64 out of range in dictionary!'),
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 0,
                'arguments'  => [-1],
                'exception'   => new InProgressException('The -1 out of range in dictionary!'),
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 1,
                'arguments'  => [32],
                'exception'   => new InProgressException('The 32 out of range in dictionary!'),
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 1,
                'arguments'  => [-1],
                'exception'   => new InProgressException('The -1 out of range in dictionary!'),
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 2,
                'arguments'  => [16],
                'exception'   => new InProgressException('The 16 out of range in dictionary!'),
            ],
            [
                'method'     => 'getCodeByIndex',
                'dictionary' => 2,
                'arguments'  => [-1],
                'exception'   => new InProgressException('The -1 out of range in dictionary!'),
            ],
            // getIndexByCode
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 0,
                'arguments'  => ['%'],
                'exception'   => new InProgressException('The % out of bounds in dictionary!'),
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 1,
                'arguments'  => ['~'],
                'exception'   => new InProgressException('The ~ out of bounds in dictionary!'),
            ],
            [
                'method'     => 'getIndexByCode',
                'dictionary' => 2,
                'arguments'  => ['`'],
                'exception'   => new InProgressException('The ` out of bounds in dictionary!'),
            ],
        ];
    }

    /**
     * @param \recyger\test\encry\int\UnitTester $I
     * @param \Codeception\Example               $example
     *
     * @return mixed
     * @throws \Exception
     */
    private function run(UnitTester $I, Example $example)
    {
        /** @var \recyger\encry\int\AbstractBase $object */
        $object     = Stub::construct(
            AbstractBase::class,
            [
                $I->getDictionary($example['dictionary']),
            ]
        );
        $reflection = new ReflectionObject($object);
        $method     = $reflection->getMethod($example['method']);
        $method->setAccessible(true);
        $actual = $method->invokeArgs($object, $example->offsetExists('arguments') ? $example['arguments'] : []);

        return $actual;
}
}
