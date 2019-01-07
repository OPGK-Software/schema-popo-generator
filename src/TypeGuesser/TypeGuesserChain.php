<?php
namespace Opgk\PopoGenerator\TypeGuesser;


use Opgk\PopoGenerator\Generator\Config;
use Opgk\PopoGenerator\StructPopulator\Property;

class TypeGuesserChain
{

    /**
     * @var TypeGuesserInterface[]
     */
    protected $guessers;
    /**
     * @var Config
     */
    private $config;

    /**
     * TypeGuesserChain constructor.
     * @param Config $config
     * @param TypeGuesserInterface[]|null $guessers
     */
    public function __construct(Config $config, array $guessers = [])
    {
        $this->config = $config;
        $this->guessers = $guessers ?: self::getDefaultGuessersList();
    }

    /**
     * @return TypeGuesserInterface[]
     */
    public static function getDefaultGuessersList(){
        return [
            new EmbeddedObjectGuesser(),
            new NumberGuesser(),
            new DefaultGuesser()
        ];
    }


    public function getTypeForProperty(Property $property): Result
    {
        foreach($this->guessers as $g){
            $result = $g->guessReturnTypes($this->config, $property);
            if($result){
                return $result;
            }
        }

        throw new \RuntimeException(sprintf('Cannot guess type for property "%s"', $property->getName()));
    }

}