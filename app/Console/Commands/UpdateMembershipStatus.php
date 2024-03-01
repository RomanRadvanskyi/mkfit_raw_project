<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Membership;

class UpdateMembershipStatus extends Command
{
    protected $signature = 'membership:update-status';
    protected $description = 'Update membership statuses based on specific conditions';

    public function handle()
    {
        $this->updateMonthlyMemberships();
        $this->updateSingleMemberships();

        $this->info('Membership statuses updated successfully.');
    }

    protected function updateMonthlyMemberships()
    {
        $monthlyMemberships = Membership::where('membership_type', 'Monthly')
            ->where('status', 'Active')
            ->where('end_date', '<=', now())
            ->get();

        foreach ($monthlyMemberships as $membership) {
            $membership->status = 'Inactive';
            $membership->save();
        }
    }

    protected function updateSingleMemberships()
    {
        $singleMemberships = Membership::where('membership_type', 'Single')
            ->where('status', 'Active')
            ->where('quantity', 0)
            ->get();

        foreach ($singleMemberships as $membership) {
            $membership->status = 'Inactive';
            $membership->save();
        }
    }
}
