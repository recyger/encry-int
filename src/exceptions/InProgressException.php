<?php

namespace recyger\encry\int\exceptions;

use Throwable;

/**
 * Class InProgressException
 *
 * @package recyger\encry\int\exceptions
 * @since   0.1.0
 */
class InProgressException extends Exception
{
    /**
     * InProgressException constructor.
     *
     * @param string     $message
     * @param int        $code
     * @param \Throwable $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code ?? 0x000010002, $previous);
    }
}