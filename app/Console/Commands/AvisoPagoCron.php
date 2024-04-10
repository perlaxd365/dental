<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class AvisoPagoCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'demo:pago';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command para aviso de pago';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        
        info("Cron Job corriendo a las  ". now());
        $texto = "[" . date("Y-m-d H:i:s") ."]: Hola, soy raul";
        Storage::append("archivo.txt", $texto);
    }

    public function __construct()
    {
        parent::__construct();
        
    }
}
