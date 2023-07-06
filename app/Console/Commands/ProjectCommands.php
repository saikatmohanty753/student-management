<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Output\ConsoleOutput;

class ProjectCommands extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:project-data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'TO UPDATE PROJECT WITH ALL NEEDED DATA';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    protected $command;
    public function __construct()
    {
        $this->command = new ConsoleOutput();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        /* Artisan::call('migrate'); */
        Artisan::call('db:seed --class=PermissionTableSeeder');
        $style = new OutputFormatterStyle('green', '', array('bold', 'blink'));
        $this->command->getFormatter()->setStyle('fire', $style);
        $this->command->writeln('<fire>Updated succefully</fire>');
    }
}
