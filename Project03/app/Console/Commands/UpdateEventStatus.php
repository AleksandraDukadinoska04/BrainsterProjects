<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use Carbon\Carbon;

class UpdateEventStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update event statuses from active to completed for events that have passed';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentDate = Carbon::now();

        Event::where('status', 'active')
            ->where('date', '<', $currentDate)
            ->update(['status' => 'completed']);

        $this->info('Event statuses have been updated successfully.');
    }
}
