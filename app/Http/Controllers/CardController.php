<?php

namespace App\Http\Controllers;
use App\Models\Card;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CardController extends Controller
{
    /**
     * Display the card management page.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $cards = Card::all();
        return view('admin.admincards', compact('cards'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'id' => 'required|integer|unique:cards,id',
            'rfid_card_number' => 'required|string',
        ]);

        // Create a new card with specified id
        Card::create([
            'id' => $validatedData['id'],
            'rfid_card_number' => $validatedData['rfid_card_number'],
        ]);

        // Redirect back with a success message
        return redirect()->route('admin.cards')->with('success', 'Karta bola úspešne pridaná.');
    }


    public function update(Request $request, Card $card)
    {
        $request->validate([
            'rfid_card_number' => 'required',
            // Add validation for other fields as needed
        ]);

        $card->update($request->all());

        // Set flash message
        session()->flash('success', 'Karta bola úspešne aktualizovaná.');
        return response()->json(['message' => 'Card updated successfully']);
    }

    public function deleteCard($id)
    {
        try {
            // Find the card
            $card = DB::table('cards')->find($id);

            if (!$card) {
                return response()->json(['message' => 'Card not found'], 404);
            }

            // Check if the card is associated with a membership
            $membership = DB::table('memberships')->where('card_id', $card->id)->first();

            if ($membership) {
                return response()->json(['message' => 'Card is associated with a membership, cannot be deleted'], 400);
            }

            // Delete the card
            DB::table('cards')->where('id', $card->id)->delete();

            session()->flash('success', 'Karta bola úspešne odstránená.');
            return response()->json(['message' => 'Card deleted successfully'], 200);
        } catch (\Exception $e) {
            // Handle exceptions, log errors, etc.
            return response()->json(['message' => 'Failed to delete card'], 500);
        }
    }

}
