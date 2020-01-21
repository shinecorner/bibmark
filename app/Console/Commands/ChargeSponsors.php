<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SponsorService;

class ChargeSponsors extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'charge:sponsors';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Charge Sponsors';

    protected $sponsorService;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SponsorService $sponsorService)
    {
        parent::__construct();

        $this->sponsorService = $sponsorService;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->sponsorService->chargeSpnsors();
    }
}
