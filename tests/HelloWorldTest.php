<?php

namespace Paroki\Tests;

use PHPUnit\Framework\TestCase;
/**
 * Hello World test
 */
class HelloWorld extends TestCase
{

  public function testHelloWorld()
  {
    $foo = 'hello world';
    $this->assertEquals('hello world', $foo);
  }
}
