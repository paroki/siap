<?php


namespace Paroki\Core;


use ApiPlatform\Operation\PathSegmentNameGeneratorInterface;
use ApiPlatform\Util\Inflector;

class SingularPathSegmentNameGenerator implements PathSegmentNameGeneratorInterface
{
    public function getSegmentName(string $name, bool $collection = true): string
    {
        return Inflector::tableize($name);
    }
}