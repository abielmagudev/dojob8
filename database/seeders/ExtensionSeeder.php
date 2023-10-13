<?php

namespace Database\Seeders;

use App\Apix\Installer;
use App\Apix\Register;
use App\Models\Extension;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;
use Illuminate\Support\Facades\Schema;

class ExtensionSeeder extends Seeder
{
    public $console;

    public $extensions;

    public function __construct()
    {
        $this->console = new ConsoleOutput();

        $this->extensions = Extension::all();
    }

    public function run()
    {
        $this->console->writeln("<question>INSTALLING API-EXTENSIONS...</question>");

        foreach(Register::apiExtensions() as $installer)
        {
            if(! $extension = $this->create($installer) )
                continue;
            
            $this->migrate($installer->migrations(), $extension);
        }
    }

    public function create(Installer $installer)
    {
        if( $extension = $this->extensions->where('namespace', $installer->namespace())->first() )
        {
            $this->console->writeln("<comment>Already extension:</comment> {$installer->namespace()}");
            return $extension;
        }

        if(! $extension = Extension::create( $installer->toCreate() ) )
        {
            $this->console->writeln("<error>Error creating extension:</error> {$installer->namespace()}");
            return;
        }

        $this->console->writeln("<info>Created extension:</info> {$installer->namespace()}");

        return $extension;
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
                $this->console->writeln("<error>Error installing migration:</error> {$table}");
                $this->console->writeln("<comment>Deleted extension:</comment> {$extension->title}");
                $extension->delete();
                continue;
            }
            
            $this->console->writeln("<info>Installed migration:</info> {$table}");
        }
    }
}
