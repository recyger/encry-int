<?php

namespace recyger\test\encry\int;

use Codeception\Example;
use recyger\encry\int\Encoder;

class EncoderCest
{
    /**
     * @param \recyger\test\encry\int\UnitTester $I
     * @param \Codeception\Example               $example
     *
     * @throws \recyger\encry\int\exceptions\InProgressException
     * @dataProvider getDatumForPositiveTestEncoder
     */
    public function positiveTestEncode(UnitTester $I, Example $example)
    {
        // Arrange
        $object = new Encoder($I->getDictionary($example['dictionary']));

        // Act
        $actual = $object->encode($example['integer']);

        // Assert
        $I->assertEquals($example['string'], $actual);
    }

    /**
     * @return array
     */
    private function getDatumForPositiveTestEncoder(): array
    {
        return require codecept_data_dir('positiveFixtures.php');
    }
}
