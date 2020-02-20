<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class AbstractUnitTestCase extends TestCase
{
    /**
     * getPrivateMethod
     *
     * @param    string $className
     * @param    string $methodName
     * @return   \ReflectionMethod
     */
    public function getPrivateMethod($className, $methodName)
    {
        $reflector = new \ReflectionClass($className);
        $method = $reflector->getMethod($methodName);
        $method->setAccessible(true);
<<<<<<< HEAD

=======
        
>>>>>>> 5506437284d4b5494fbe0d17f19d8e19950c4f84
        return $method;
    }
}
