<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use app\Models\Leaderboard\Leaderboard;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LeaderboardController extends Controller
{
    public function show(string $id): JsonResponse
    {

        // order by highest first
        $leaderboard = Leaderboard::with(['entries' => function ($query) {
            $query->orderBy('score', 'desc');
        }])->findOrFail($id);

        return response()->json([
            'id' => $leaderboard->id,
            'name' => $leaderboard->name,
            'slug' => $leaderboard->slug,
            'reset_schedule' => $leaderboard->reset_schedule,
            'entries' => $leaderboard->entries->map(function ($entry) {
                return [
                    'id' => $entry->id,
                    'user_id' => $entry->user_id,
                    'display_name' => $entry->display_name,
                    'score' => $entry->score,
                    'metadata' => $entry->metadata,
                    'created_at' => $entry->created_at,
                ];
            }),
        ]);
    }

    public function store(Request $request, string $id): JsonResponse
    {
        $leaderboard = Leaderboard::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'display_name' => 'required|string|max:255',
            'score' => 'required|integer',
            'metadata' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $entry = $leaderboard->entries()->create([
            'display_name' => $request->input('display_name'),
            'score' => $request->input('score'),
            'metadata' => $request->input('metadata', []),
        ]);

        return response()->json([
            'message' => 'Score submitted successfully',
            'entry' => [
                'id' => $entry->id,
                'score' => $entry->score,
                'display_name' => $entry->display_name,
                'created_at' => $entry->created_at,
            ],
        ], 201);
    }

    public function destroy(string $id, string $entryId): JsonResponse
    {
        $leaderboard = Leaderboard::findOrFail($id);

        $entry = $leaderboard->entries()->findOrFail($entryId);

        $entry->delete();

        return response()->json([
            'message' => 'Entry deleted successfully'
        ], 200);
    }
}
