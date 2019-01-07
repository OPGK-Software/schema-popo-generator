<?php

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

require __DIR__.'/../vendor/autoload.php';

$normalizer = new ObjectNormalizer(null, null, null, new \Symfony\Component\PropertyInfo\Extractor\PhpDocExtractor());
$arrayDenormalizer = new ArrayDenormalizer();
$serializer = new Serializer([$normalizer, new \Symfony\Component\Serializer\Normalizer\PropertyNormalizer(), $arrayDenormalizer], ['json' => new JsonEncoder()]);

$arrayDenormalizer->setSerializer($serializer);

/**
 * @var \Opgk\PopoGenerator\Example\Struct\ClientPeopleItem $obj
 */
$obj = $serializer->deserialize(
    file_get_contents(sprintf('%s/test.json', __DIR__)),
    \Opgk\PopoGenerator\Example\Struct\ClientPeopleItem::class, 'json'
);

foreach($obj->getSubs() as $sub){
    var_dump($sub->getNumber());
}
