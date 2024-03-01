<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MembershipController extends Controller
{
    public function orderSingleMembership(Request $request)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Continue with the logic to create a new membership
        $membership = Membership::create([
            'user_id' => Auth::user()->id,
            'membership_type' => 'Single', // Adjust as needed
            'quantity' => $request->input('quantity'),
            'status' => 'Pending Payment',
        ]);

        return redirect()->route('dashboard')->with('success', 'Úspešne objednaná vstupová permanentka.');
    }

    public function orderMonthlyMembership(Request $request)
    {
        // Validate the request
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Continue with the logic to create a new membership
        $membership = Membership::create([
            'user_id' => Auth::user()->id,
            'membership_type' => 'Monthly', // Adjust as needed
            'quantity' => $request->input('quantity'),
            'status' => 'Pending Payment',
        ]);

        return redirect()->route('dashboard')->with('success', 'Úspešne objednaná mesačná permanentka.');
    }

    public function deleteMembership()
    {
        // Check if the user has an active membership
        if (!Auth::user()->membership) {
            return redirect()->route('dashboard')->with('error', 'You do not have an active membership to delete.');
        }

        // Continue with the logic to delete the membership
        Auth::user()->membership->delete();

        return redirect()->route('dashboard')->with('success', 'Úspešné zrušenie tvojej permanentky.');
    }

}
