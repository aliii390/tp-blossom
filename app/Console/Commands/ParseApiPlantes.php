<?php

namespace App\Console\Commands;

use App\Interfaces\PlantesServiceInterface;
use Illuminate\Console\Command;

class ParseApiPlantes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:parse-api-plantes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'mettre les plantes de l api  en bdd';

  
    protected PlantesServiceInterface $plantesService;
  

    public function __construct(PlantesServiceInterface $plantService)
    {
        parent::__construct();

        $this->plantesService = $plantService;
      
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Fetching plants...');
        $this->plantesService->fetchAndStorePlantes();
        $this->info('Plants fetched and stored successfully.');
    }
}
