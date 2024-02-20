<?php

use App\Apix\Stocker;
use Illuminate\Database\Migrations\Migration;
use Symfony\Component\Console\Output\ConsoleOutput;

class CreateApixTables extends Migration
{
    public $console;

    public function __construct()
    {
        $this->console = new ConsoleOutput();
    }

    public function up()
    {
        $this->console->writeln("<question> APIX: API eXtension migrations </question>");

        foreach(Stocker::all() as $apix => $setup_path)
        {
            $this->console->writeln("<comment> {$apix}... </comment>");
            
            $setup = include($setup_path);

            foreach($setup->migrations() as $table_name => $migration_path)
            {
                $this->console->writeln("<comment>Migrating {$table_name}</comment>");

                $migration = include($migration_path);
                
                $migration->up();
                
                $this->console->writeln("<info>Migrated {$table_name}</info>");
            }
        }
    }

    public function down()
    {
        $this->console->writeln("<question> APIX: API eXtension migrations </question>");

        foreach(Stocker::all() as $apix => $setup_path)
        {
            $this->console->writeln("<comment> {$apix}... </comment>");
            
            $setup = include($setup_path);

            foreach($setup->migrations() as $table_name => $migration_path)
            {
                $this->console->writeln("<comment>Downing {$table_name}</comment>");

                $migration = include($migration_path);
                
                $migration->down();
                
                $this->console->writeln("<info>Downed {$table_name}</info>");
            }
        }
    }
}


/**
 * 
 * ConsoleOutput Color Tags
 * 
    Background CYAN = <question></question>
    Background RED = <error></error>
    Color Yellow = <comment></comment>
    Color Green = <info></info>
 

 * 
 * Verify table with Schema facade:
 *
    Schema::hasTable($table_name)


 * 
 * Migrate with Artisan facade:
 *
    use Illuminate\Support\Facades\Artisan;

    Artisan::call('migrate', [
        '--path' => str_replace(base_path(), '', $migration),
    ]);
 
    
 */
