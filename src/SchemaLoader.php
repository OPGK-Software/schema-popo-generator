<?php
namespace Opgk\PopoGenerator;


use Opgk\PopoGenerator\SchemaLoader\LoaderException;

class SchemaLoader
{
    /**
     * @var string
     */
    private $schemaData;

    public function __construct(string $schemaData)
    {
        $this->schemaData = $schemaData;
    }

    public function parseJson(){
        $blob = @json_decode($this->schemaData);

        if(!$blob){
            throw new LoaderException('Unparseable JSON data specified');
        }

        if(empty($blob->type) || (empty($blob->properties) && empty($blob->items))){
            throw new LoaderException('Specified data is not JSON-schema');
        }

        return $blob;
    }

}