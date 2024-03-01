<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Membership;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function checkCard(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'id' => 'required|string', // Assuming 'id' is the RFID card number
        ]);

        $rfidCardNumber = $request->input('id');

        // Find the card in the database based on RFID card number
        $card = Card::where('rfid_card_number', $rfidCardNumber)->first();

        if ($card) {
            // If the card is found, check its membership status
            $membership = Membership::where('card_id', $card->id)->first();

            if ($membership) {
                // Check membership type and update quantity if Single
                if ($membership->membership_type === 'Single' && $membership->quantity > 0) {
                    $membership->decrement('quantity'); // Decrease quantity by 1
                }

                // Check membership status
                if ($membership->status === 'Active') {
                    return response()->json(['message' => 'Card is active'], 200);
                } else {
                    return response()->json(['message' => 'Card is not active'], 400);
                }
            } else {
                return response()->json(['message' => 'Membership not found for the card'], 400);
            }
        } else {
            return response()->json(['message' => 'Card not found'], 400);
        }
    }
}
