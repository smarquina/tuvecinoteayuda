<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Docs extends Command {
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'docs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate docs';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $this->info('limpiando..');
        $this->call('clear');

        $this->call('ide-helper:eloquent');
        $this->call('ide-helper:generate');

        $this->info('Generando documentacion interna');
        $this->call('ide-helper:models', ['-W' => 'yes', '--no-interaction' => true,]);
        $this->call('ide-helper:meta');

        return true;
    }
}
