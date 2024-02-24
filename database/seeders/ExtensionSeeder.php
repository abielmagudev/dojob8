<?php

namespace Database\Seeders;

use App\Models\Extension;
use App\Xapis\Stocker;
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
        $this->console->writeln("<question> XAPI: eXtension API Seeders </question>");

        foreach(Stocker::all() as $xapi => $setup_path)
        {
            $setup = include($setup_path);
            
            $this->console->writeln("<comment> Seeding {$xapi} </comment>");

            Extension::create([
                'name' => $setup->name(),
                'description' => $setup->description(),
                'spacename' => $setup->spacename(),
                'abbr' => $setup->abbr(),
                'has_settings' => $setup->hasSettings(),
            ]);

            $this->console->writeln("<info> Seeded {$xapi} </info>");
        }
    }
}
