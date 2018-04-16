<?php

namespace recyger\encry\int;

/**
 * Class Encoder
 *
 * @package recyger\encry\int
 * @since 0.1.0
 */
class Encoder extends AbstractBase
{
    /**
     * Кодируем число
     *
     * @param int $value
     *
     * @return string
     * @throws \recyger\encry\int\exceptions\InProgressException
     */
    public function encode(int $value): string
    {
        $out = '';

        $offset =  $this->getDictionarySize() - 1;
        $bytePerBlock = $this->getBytePerBlock();

        // Разбиваем число на блоки и кодируем через словарь
        for ($blockIndex = $this->getBlockCount(); $blockIndex >= 0; $blockIndex--) {
            $index = $value >> $blockIndex * $bytePerBlock & $offset;
            $out  .= $this->getCodeByIndex($index);
        }

        return $out;
    }
}