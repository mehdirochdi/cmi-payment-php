<?php
namespace CMI;

/**
 * Interface for a CMI client.
 */
interface CmiClientInterface {

    public function getDefaultOpts();

    public function getRequireOpts();

    // public function validateConfig();

    public function generateHash($storeKey);
}