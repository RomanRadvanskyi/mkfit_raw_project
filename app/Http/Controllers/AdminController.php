<?php

namespace App\Http\Controllers;
use App\Models\Membership;
use Illuminate\Http\Request;
use App\Models\Card;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function viewMemberships()
    {
        // Fetch memberships with status 'Pending Payment' first
        $pendingMemberships = Membership::where('status', 'Pending Payment')->get();

        // Fetch other memberships
        $otherMemberships = Membership::where('status', '!=', 'Pending Payment')->get();

        // Combine the two collections
        $memberships = $pendingMemberships->concat($otherMemberships);

        // Pass memberships to the view
        return view('admin.adminhome', compact('memberships'));
    }

    public function payMembership($id, Request $request)
    {
        // Find the membership
        $membership = Membership::find($id);

        if (!$membership) {
            return redirect()->route('admin.adminhome')->with('error', 'Membership not found.');
        }

        // Check if the membership is already paid
        if ($membership->status === 'Active') {
            return redirect()->route('admin.adminhome')->with('error', 'Membership is already paid.');
        }

        // Get the Card ID from the request
        $cardId = $request->input('cardId');

        // Check if the Card ID is already used in Membership table
        $existingMembership = Membership::where('card_id', $cardId)->first();
        if ($existingMembership) {
            $errorCardId = $existingMembership->card_id;
            return redirect()->route('admin.adminhome')->with('error', "Karta s ID({$errorCardId}) je už priradená k určitej permanentke. Je priradená používateľovi: {$existingMembership->user->name}.");
        }


        // Find or create the card
        $card = Card::firstOrNew(['id' => $cardId]);

        // Save the card to the database if it's new
        if (!$card->exists) {
            $card = new Card();  // Create a new Card instance
            $card->id = $cardId; // Set the $cardId to the id property of the Card instance
            $card->save();
        }

        // Set start date to current date
        $startDate = Carbon::now();

        // Calculate end date based on quantity of months
        $endDate = $startDate->copy()->addMonths($membership->quantity);

        // Update membership status to "Active" and set start/end dates
        $membership->status = 'Active';
        $membership->card_id = $card->id; // Associate the card_id with the membership
        // Check if membership type is Monthly
        if ($membership->membership_type === 'Monthly') {
            // Set start date as the current date
            $membership->start_date = now();

            // Calculate end date based on start date and quantity of months
            $membership->end_date = now()->addMonths($membership->quantity);
        }
        $membership->save();

        return redirect()->route('admin.adminhome')->with('success', 'Permanentka bola zaplatená.');
    }

    public function cancelMembership($id)
    {
        // Assuming you have a Membership model
        $membership = Membership::find($id);

        if (!$membership) {
            return redirect()->route('admin.adminhome')->with('error', 'Permanentka sa nenašla.');
        }

        // Delete the membership
        $membership->delete();

        return redirect()->route('admin.adminhome')->with('success', 'Permanentka bola vymazaná.');
    }

    public function updateMembership(Request $request, $membershipId)
    {
        // Validate the incoming request data
        $request->validate([
            'card_id' => 'required|integer',
        ]);

        // Find the membership based on the ID
        $membership = Membership::find($membershipId);

        if (!$membership) {
            return response()->json(['error' => 'Membership not found'], 404);
        }

        // Update the card_id
        $membership->card_id = $request->input('card_id');
        $membership->save();

        // Construct the HTML string for the updated row
        $updatedRow = '<tr data-membership-id="' . $membership->id . '">';
        $updatedRow .= '<td class="text-center border bg-gray-100">' . $membership->id . '</td>';
        $updatedRow .= '<td class="text-center border">' . $membership->created_at . '</td>';
        $updatedRow .= '<td class="text-center border bg-gray-100">' . $membership->user->name . '</td>';
        $updatedRow .= '<td class="text-center border">' . $membership->user->phone . '</td>';
        $updatedRow .= '<td class="text-center border bg-gray-100">' . $membership->user->email . '</td>';
        $updatedRow .= '<td class="text-center border">';

        if ($membership->membership_type === 'Single') {
            $updatedRow .= 'Vstupová';
        } elseif ($membership->membership_type === 'Monthly') {
            $updatedRow .= 'Mesačná';
        } else {
            $updatedRow .= $membership->membership_type;
        }

        $updatedRow .= '</td>';
        $updatedRow .= '<td class="text-center border bg-gray-100">' . $membership->quantity . '</td>';
        $updatedRow .= '<td class="text-center border">';

        if ($membership->status === 'Pending Payment') {
            $updatedRow .= 'Čaká sa na platbu';
        } elseif ($membership->status === 'Active') {
            $updatedRow .= 'Aktívna';
        } elseif ($membership->status === 'Inactive') {
            $updatedRow .= 'Ukončená';
        } else {
            $updatedRow .= $membership->status;
        }
        $updatedRow .= '</td>';
        $updatedRow .= '<td class="text-center border bg-gray-100">' . ($membership->start_date ?? 'N/A') . '</td>';
        $updatedRow .= '<td class="text-center border">' . ($membership->end_date ?? 'N/A') . '</td>';
        // Add other columns as needed
        $updatedRow .= '<td class="text-center border bg-gray-100">' . ($membership->card_id ? $membership->card_id : 'N/A') . '</td>';
        $updatedRow .= '<td class="text-center border">';
        $updatedRow .= '<form onclick="editMembership(' . $membership->id . ', ' . $membership->card_id . ')">';
        $updatedRow .= '<button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300">Upraviť</button>';
        $updatedRow .= '</form>';
        $updatedRow .= '<form action="' . route('admin.cancel.membership', ['id' => $membership->id]) . '" method="POST" onsubmit="return confirm(\'Naozaj chcete odstrániť túto permanentku?\');">';
        $updatedRow .= csrf_field();
        $updatedRow .= '<button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition duration-300">Odstrániť</button>';
        $updatedRow .= '</form>';
        // Add other actions or buttons as needed
        $updatedRow .= '</td>';
        $updatedRow .= '</tr>';

        return response()->json(['message' => 'Membership updated successfully', 'updatedRow' => $updatedRow]);
    }

    public function checkMembershipCardId($cardId)
    {
        // Check if any membership already has the given card_id
        $exists = Membership::where('card_id', $cardId)->exists();

        return response()->json(['exists' => $exists]);
    }

}
