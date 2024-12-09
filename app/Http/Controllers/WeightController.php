<?php

namespace App\Http\Controllers;

use App\Models\Weight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WeightController extends Controller
{
    //
    public function index()
    {
        $weights = Weight::where('user_id', Auth::id())->firstOrFail();
        return view('weights.index', compact('weights'));
    }

    // Update weights
    public function update(Request $request, $id)
    {
        $request->validate([
            'content_based' => 'required|numeric|between:0,1',
            'collaborative' => 'required|numeric|between:0,1',
            'collaborative_likes' => 'required|numeric|between:0,1',
            'demographic' => 'required|numeric|between:0,1',
        ]);

        $weight = Weight::findOrFail($id);
        $weight->update($request->only(['content_based', 'collaborative', 'collaborative_likes', 'demographic']));

        return redirect()->route('weights.index')->with('success', 'Weights updated successfully.');
    }
}
