<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Booking;
use App\Models\Unit;
use Carbon\Carbon;

class UpdateUnitStatus extends Command
{
    protected $signature = 'unit:update-status';
    protected $description = 'Update unit status to available after booking period ends';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get current date
        $now = Carbon::now();

        // Find all bookings that have ended
        $bookings = Booking::where('end_date', '<', $now)
        ->where('status', 'confirmed')
        ->get();

        foreach ($bookings as $booking) {
            // Update unit status to available
            $unit_id = $booking->unit_id;
            $unit = Unit::Findorfail($unit_id);
            $unit->update(['unit_status' => 'متاح']);

            // Optionally, update the booking status as well
            $booking->update(['status' => 'completed']);
        }

        $this->info('Unit statuses have been updated.');
    }
}
