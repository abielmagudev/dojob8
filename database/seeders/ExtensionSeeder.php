<?php

namespace Database\Seeders;

use App\Apix\Stocker;
use App\Models\Extension;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Output\ConsoleOutput;

class ExtensionSeeder extends Seeder
{
    public $console;

    public function __construct()
    {
        $this->console = new ConsoleOutput();
    }

    public function run()
    {
        $this->console->writeln("<question> APIX (Api-eXtensions) seeders </question>");

        foreach(Stocker::all() as $apix => $setup_path)
        {
            $setup = include($setup_path);
            
            $this->console->writeln("<comment> Seeding {$apix} </comment>");

            Extension::create([
                'name' => $setup->name(),
                'description' => $setup->description(),
                'classname' => $setup->classname(),
            ]);

            $this->console->writeln("<info> Seeded {$apix} </info>");
        }
    }
}
