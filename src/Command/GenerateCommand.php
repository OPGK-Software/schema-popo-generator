<?php
namespace Opgk\PopoGenerator\Command;


use Doctrine\Common\Inflector\Inflector;
use Opgk\PopoGenerator\Generator;
use Opgk\PopoGenerator\SchemaLoader\FileLoader;
use Opgk\PopoGenerator\StructPopulator;
use Opgk\PopoGenerator\Writer;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateCommand extends Command
{
    protected function configure()
    {
        $this->setName('generate');
        $this->addArgument('schema-file', InputArgument::REQUIRED, 'JSON-schema file to process');
        $this->addArgument('output-dir', InputArgument::REQUIRED, 'Where generated classes should be written');
        $this->addArgument('namespace', InputArgument::REQUIRED, 'Generated classes namespace');
        $this->addOption('root-name', 'r', InputOption::VALUE_OPTIONAL, 'Generated base class name');
        parent::configure();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if(!file_exists($input->getArgument('schema-file'))){
            throw new \InvalidArgumentException('Schema file does not exist.');
        }

        if(!is_writable($input->getArgument('output-dir'))){
            throw new \InvalidArgumentException('Output directory not writable.');
        }

        $schemaLoader = new FileLoader($input->getArgument('schema-file'));
        $schema = $schemaLoader->parseJson();

        $className = $this->generateClassNameFromFileName($input->getArgument('schema-file'));

        $populator = new StructPopulator();
        $struct = $populator->createStructForNode($schema, $className);

        $generator = new Generator($input->getArgument('namespace'));
        $result = $generator->generate($struct);

        $writer = new Writer($input->getArgument('output-dir'), $input->getArgument('namespace'));
        foreach($writer->writeClasses($result) as $msg){
            $output->writeln($msg);
        }
    }

    private function generateClassNameFromFileName($filename){
        $work = basename($filename, '.json');

        if(substr($work, -7) == '.schema'){
            $work = substr($work, 0, -7);
        }

        $result = Inflector::singularize($work);
        $result = Inflector::classify($result);

        return $result;
    }


}