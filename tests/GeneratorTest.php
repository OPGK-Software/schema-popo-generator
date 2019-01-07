<?php
/**
 * Created by PhpStorm.
 * User: ppawliczuk
 * Date: 04.01.2019
 * Time: 10:52
 */

namespace Opgk\PopoGenerator\Tests;


use Opgk\PopoGenerator\Generator;
use Opgk\PopoGenerator\StructPopulator;
use Opgk\PopoGenerator\Writer;
use PHPUnit\Framework\TestCase;

class GeneratorTest extends TestCase
{

    public function testGenerator()
    {
        $generator = new Generator('Opgk\\PopoGenerator\\Example\\Struct');

        $json = @json_decode(@file_get_contents(sprintf('%s/fixtures/test.schema.json', __DIR__)));

        $populator = new StructPopulator();
        $struct = $populator->createStructForNode($json, 'ClientPeopleItem');

        $result = $generator->generate($struct);

        $writer = new Writer(sprintf('%s/../example', __DIR__), 'Opgk\\PopoGenerator\\Example');
        foreach($writer->writeClasses($result) as $msg){
            print($msg.PHP_EOL);
        }
    }

}