<?php
namespace CMI\Exception;

if (\interface_exists(\Throwable::class, false)) {
    /**
     * The base interface for all CMI exceptions.
     */
    interface ExceptionInterface extends \Throwable
    {
    }
} else {
    /**
     * The base interface for all CMI exceptions.
     */
    // phpcs:disable PSR1.Classes.ClassDeclaration.MultipleClasses
    interface ExceptionInterface
    {
    }
    // phpcs:enable
}