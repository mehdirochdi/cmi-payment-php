<?php
namespace Mehdirochdi\CMI;

/**
 * Interface for a CMI client.
 */
interface CmiClientInterface {

    public function getDefaultOpts();

    public function getRequireOpts();

    public function generateHash($storeKey);

    public function dd(...$values);
}