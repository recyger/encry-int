<?php

namespace recyger\encry\int\exceptions;

use Throwable;

/**
 * Class OnInitException
 *
 * @package recyger\encry\int\exceptions
 * @since   0.1.0
 */
class OnInitException extends Exception
{

    /**
     * OnInitException constructor.
     *
     * @param string     $message
     * @param int        $code
     * @param \Throwable $previous
     */
    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code ?? 0x000010003, $previous);
    }
}