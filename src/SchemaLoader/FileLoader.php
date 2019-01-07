<?php
namespace Opgk\PopoGenerator\SchemaLoader;


use Opgk\PopoGenerator\SchemaLoader;

class FileLoader extends SchemaLoader
{

    public function __construct(string $filename)
    {
        $data = @file_get_contents($filename);
        if(!$data){
            throw new LoaderException(sprintf('Cannot read file "%s"', $filename));
        }

        parent::__construct($data);
    }

}