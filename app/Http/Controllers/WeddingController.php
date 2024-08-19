<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wedding;
use Illuminate\Support\Facades\Auth;

class WeddingController extends Controller
{
    public function index()
    {
        $weddings = Auth::user()->weddings()->get();

        return response()->json([
            'message' => 'Weddings retrieved successfully',
            'data' => $weddings
        ], 200);
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'groom_name' => 'required|string|max:255',
                'groom_father_name' => 'required|string|max:255',
                'groom_mother_name' => 'required|string|max:255',
                'bride_name' => 'required|string|max:255',
                'bride_father_name' => 'required|string|max:255',
                'bride_mother_name' => 'required|string|max:255',
                'ceremony_time' => 'required|date',
                'ceremony_location' => 'required|string|max:255',
                'ceremony_coordinates.latitude' => 'required|numeric',
                'ceremony_coordinates.longitude' => 'required|numeric',
                'reception_time' => 'required|date',
                'reception_location' => 'required|string|max:255',
                'reception_coordinates.latitude' => 'required|numeric',
                'reception_coordinates.longitude' => 'required|numeric',
            ]);

            $validated['ceremony_coordinates'] = json_encode($request->input('ceremony_coordinates'));
            $validated['reception_coordinates'] = json_encode($request->input('reception_coordinates'));

            $wedding = Auth::user()->weddings()->create($validated);

            return response()->json([
                'message' => 'Wedding created successfully',
                'data' => $wedding
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error creating wedding: ' . $e->getMessage());

            return response()->json([
                'message' => 'An error occurred while creating the wedding',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }



    public function show($id)
    {
        $wedding = Wedding::find($id);

        if (!$wedding) {
            return response()->json([
                'message' => 'Wedding not found'
            ], 404);
        }

        return response()->json([
            'message' => 'Wedding retrieved successfully',
            'data' => $wedding
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $wedding = Auth::user()->weddings()->find($id);

        if (!$wedding) {
            return response()->json([
                'message' => 'Wedding not found'
            ], 404);
        }

        $validated = $request->validate([
            'groom_name' => 'sometimes|string|max:255',
            'groom_father_name' => 'sometimes|string|max:255',
            'groom_mother_name' => 'sometimes|string|max:255',
            'bride_name' => 'sometimes|string|max:255',
            'bride_father_name' => 'sometimes|string|max:255',
            'bride_mother_name' => 'sometimes|string|max:255',
            'ceremony_time' => 'sometimes|date',
            'ceremony_location' => 'sometimes|string|max:255',
            'ceremony_coordinates.latitude' => 'sometimes|numeric',
            'ceremony_coordinates.longitude' => 'sometimes|numeric',
            'reception_time' => 'sometimes|date',
            'reception_location' => 'sometimes|string|max:255',
            'reception_coordinates.latitude' => 'sometimes|numeric',
            'reception_coordinates.longitude' => 'sometimes|numeric',
        ]);

        $wedding->update($validated);

        return response()->json([
            'message' => 'Wedding updated successfully',
            'data' => $wedding
        ], 200);
    }

    public function destroy($id)
    {
        $wedding = Auth::user()->weddings()->find($id);

        if (!$wedding) {
            return response()->json([
                'message' => 'Wedding not found'
            ], 404);
        }

        $wedding->delete();

        return response()->json([
            'message' => 'Wedding deleted successfully'
        ], 200);
    }
}
