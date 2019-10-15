<?php

/**
 *  fake function for blade @inject
 *
 *  @param  string $class
 *  @return object
 */
function app($class)
{
    return new $class();
}
