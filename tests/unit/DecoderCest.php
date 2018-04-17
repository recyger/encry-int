<?php

namespace recyger\test\encry\int;

use Codeception\Example;
use recyger\encry\int\Decoder;

class DecoderCest
{
    /**
     * @param \recyger\test\encry\int\UnitTester $I
     * @param \Codeception\Example               $example
     *
     * @throws \recyger\encry\int\exceptions\InProgressException
     * @dataProvider getDatumForPositiveTestDecoder
     */
    public function positiveTestDecode(UnitTester $I, Example $example)
    {
        // Arrange
        $object = new Decoder($I->getDictionary($example['dictionary']));

        // Act
        $actual = $object->decode($example['string']);

        // Assert
        $I->assertEquals($example['integer'], $actual);
    }

    /**
     * @return array
     */
    private function getDatumForPositiveTestDecoder(): array
    {
        return require codecept_data_dir('positiveFixtures.php');
    }
}