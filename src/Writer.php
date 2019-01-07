<?php
namespace Opgk\PopoGenerator;


use Opgk\PopoGenerator\Generator\ClassCollection;

class Writer
{

    /**
     * @var string
     */
    private $baseDir;
    /**
     * @var string|null
     */
    private $baseNamespace;
    /**
     * @var bool
     */
    private $overwrite;

    public function __construct(string $baseDir, ?string $baseNamespace = null, bool $overwrite = false)
    {
        $this->baseDir = $baseDir;
        $this->baseNamespace = $baseNamespace;
        $this->overwrite = $overwrite;
    }

    public function writeClasses(ClassCollection $classes)
    {
        foreach($classes as $class){
            $path = $this->getPath($class->getFqcn());

            if(!$this->overwrite && file_exists($path)){
                yield sprintf('Class "%s" exists', $class->getFqcn());
                continue;
            }

            @mkdir(dirname($path), 0777, true);

            file_put_contents($path, sprintf(<<<tpl
<?php
namespace %s;

%s
tpl
, $this->getNamespace($class->getFqcn()), $class->getBlob()));

            yield $path;
        }
    }

    private function getNamespace($fqcn){
        $components = explode('\\', $fqcn);
        array_pop($components);

        return implode('\\', $components);
    }

    private function getPath($fqcn){

        if(strpos($fqcn, $this->baseNamespace) === 0){
            $fqcn = substr($fqcn, strlen($this->baseNamespace)+1);
        }

        $path = sprintf('%s/%s.php', $this->baseDir, $fqcn);
        $path = str_replace('\\', '/', $path);
        return $path;
    }

}