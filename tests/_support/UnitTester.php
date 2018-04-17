<?php
namespace recyger\test\encry\int;

/**
 * Inherited Methods
 * @method void wantToTest($text)
 * @method void wantTo($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method \Codeception\Lib\Friend haveFriend($name, $actorClass = NULL)
 *
 * @SuppressWarnings(PHPMD)
*/
class UnitTester extends \Codeception\Actor
{
    use _generated\UnitTesterActions;

   /**
    * Define custom actions here
    */

    /**
     * Получаем словари
     *
     * @return array
     */
    public function getDictionaries(): array
    {
        static $dictionaries = null;

        if (true === is_null($dictionaries)) {
            $dictionaries = require codecept_data_dir('dictionaries.php');
        }

        return $dictionaries;
    }

    /**
     * Получаем словарь по индексу
     *
     * @param int $index
     *
     * @return string
     */
    public function getDictionary(int $index): string
    {
        return $this->getDictionaries()[$index];
    }
}
