<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SesiUjianController;

class UpdateSesiUjianDuration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sesi-ujian:update-duration';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all sesi ujian duration based on soal durasi_soal';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Updating all sesi ujian duration...');
        
        $result = SesiUjianController::updateAllDurasiSesiUjian();
        
        if ($result['success']) {
            $this->info($result['message']);
            $this->info("Updated {$result['updated_count']} sesi ujian");
            return Command::SUCCESS;
        } else {
            $this->error($result['message']);
            return Command::FAILURE;
        }
    }
}

