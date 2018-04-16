<?php

namespace recyger\encry\int;

/**
 * Class Decoder
 *
 * @package recyger\encry\int
 * @since   0.1.0
 */
class Decoder extends AbstractBase
{
    /**
     * Декодирования числа из строки
     *
     * @param string $value
     *
     * @return int
     * @throws \recyger\encry\int\exceptions\InProgressException
     */
    public function decode(string $value): int {
        $out = 0;
        $bytePerBlock = $this->getBytePerBlock();

        foreach (str_split(strrev($value)) as $index => $char) {
            $out +=  $this->getIndexByCode($char) << $index * $bytePerBlock;
        }

        return $out;
    }
}