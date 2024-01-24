<?php

namespace Database\Seeders;

use App\Apix\Kernel\Installer;
use App\Apix\Register;
use App\Models\Extension;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\Console\Output\ConsoleOutput;

class ExtensionSeeder extends Seeder
{
    const EXTENSION_CREATED_FAILED = false;

    public $console;

    public $extensions;

    public function __construct()
    {
        $this->console = new ConsoleOutput();

        $this->extensions = Extension::all();
    }

    public function run()
    {
        $this->console->writeln("<question>INSTALLING APIX (Api-eXtensions)...</question>");

        foreach(Register::apiExtensions() as $installer)
        {
            if(! $extension = $this->create($installer) )
                continue;
            
            $this->migrate($installer->migrations(), $extension);
        }
    }

    public function create(Installer $installer)
    {
        if( $extension = $this->extensions->where('classname', $installer->classname())->first() )
        {
            $this->console->writeln("<comment>Already extension:</comment> {$extension->namespace}");
            return $extension;
        }

        if( $extension = Extension::create( $installer->data() ) )
        {
            $this->console->writeln("<info>Installed extension:</info> {$extension->namespace}");
            return $extension;
        }
        
        $this->console->writeln("<error>Error installing extension:</error> {$installer->classname()}");

        return self::EXTENSION_CREATED_FAILED;
    }

    public function migrate(array $migrations, Extension $extension)
    {
        foreach($migrations as $table => $migration)
        {
            if( Schema::hasTable($table) )
            {
                $this->console->writeln("<comment>Already migration:</comment> {$table}");
                continue;
            }
            
            (include($migration))->up();

            if(! Schema::hasTable($table) )
            {
                $this->console->writeln("<error>Error migration:</error> {$table}");

                $extension->delete();
                $this->console->writeln("<comment>Deleted extension:</comment> {$extension->title}");

                continue;
            }
            
            $this->console->writeln("<info>Created migration:</info> {$table}");
        }
    }
}
