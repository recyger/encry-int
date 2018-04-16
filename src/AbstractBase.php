<?php

namespace recyger\encry\int;

use recyger\encry\int\exceptions\InProgressException;

/**
 * Class AbstractBase
 *
 * @package recyger\encry\int
 * @since   0.1.0
 * @TODO    : Реализовать шифр подстановки
 */
class AbstractBase
{
    /**
     * Типы целочисленных
     * Является максимальным количеством битов которое будет занято максимальным числом в этой категориии
     */
    const TYPE_BYTE           = 8;
    const TYPE_WORD           = 16;
    const TYPE_LONG_WORD      = 32;
    const TYPE_LONG_LONG_WORD = 64;

    /**
     * @var string Словарь из уникальных символов с помощью которго будет закодировано число
     */
    private $dictionary;

    /**
     * @var int Размер словаря
     */
    private $dictionarySize;

    /**
     * Количество байт в одном блоке. Блок будет заменен на символ из словаря.
     * Вычисляется исходя из размера словаря, чем больше словарь, тем больше
     *
     * @var int
     */
    private $bytePerBlock;

    /**
     * Количество блоков необходимых для того что бы закодировать целочисленое число выбранного типа
     *
     * @var int
     */
    private $blockCount;

    /**
     * AbstractBase constructor.
     *
     * @param string     $dictionary Словарь из уникальных символов с помозью которго будет закодировано число
     * @param int        $type       Тип числа, является количеством байт которые будут заняты максимальным числов в
     *                               этом типе.
     * @param array|null $offset     Смещения для шифра подстановки. Не реализовано
     */
    public function __construct(string $dictionary, int $type = self::TYPE_LONG_WORD, array $offset = null)
    {
        //FIXME: Добавить проверок на входные данные
        $this->dictionarySize = mb_strlen($dictionary);
        $this->bytePerBlock   = floor(log($this->dictionarySize - 1, 2) + 1);
        $this->blockCount     = intdiv($type, $this->bytePerBlock);
        $this->dictionary     = $dictionary;
    }

    /**
     * Получаем размер словаря
     *
     * @see $dictionarySize
     *
     * @return int
     */
    public function getDictionarySize(): int
    {
        return $this->dictionarySize;
    }

    /**
     * Получаем количество блоков
     *
     * @see $blockCount
     *
     * @return int
     */
    public function getBlockCount(): int
    {
        return $this->blockCount;
    }

    /**
     * Получаем количество байт на блок
     *
     * @see $bytePerBlock
     *
     * @return int
     */
    public function getBytePerBlock(): int
    {
        return $this->bytePerBlock;
    }

    /**
     * Получаем код из словаря по индексу
     *
     * @param int $index
     *
     * @return string
     * @throws \recyger\encry\int\exceptions\InProgressException
     */
    protected function getCodeByIndex(int $index): string
    {
        if ($index < 0 || $index > $this->dictionarySize - 1) {
            throw new InProgressException('The ' . $index . ' out of range in dictionary!');
        }

        return $this->dictionary[$index];
    }

    /**
     * Получение индекса кода в словаре
     *
     * @param string $code
     *
     * @return int
     * @throws \recyger\encry\int\exceptions\InProgressException
     */
    protected function getIndexByCode(string $code): int
    {
        $index = mb_stripos($this->dictionary, $code);

        if (-1 === $index) {
            throw new InProgressException('The ' . $code . ' out of bounds in dictionary!');
        }

        return $index;
    }
}