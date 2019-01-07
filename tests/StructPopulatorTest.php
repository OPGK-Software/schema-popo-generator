<?php
/**
 * Created by PhpStorm.
 * User: ppawliczuk
 * Date: 04.01.2019
 * Time: 12:20
 */

namespace Opgk\PopoGenerator\Tests;


use Opgk\PopoGenerator\Generator;
use Opgk\PopoGenerator\StructPopulator;
use PHPUnit\Framework\TestCase;

class StructPopulatorTest extends TestCase
{

    public function testWorking()
    {

        $json = @json_decode(@file_get_contents(sprintf('%s/fixtures/test.schema.json', __DIR__)));

        $populator = new StructPopulator();
        $result = $populator->createStructForNode($json);

        $generator = new Generator();
        $structs = $generator->getAllStructs($result);

    }

}