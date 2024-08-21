<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\DetailComment;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class commentController extends Controller
{
    public function store(Request $request, $id)
    {
        try {
            $validator = Validator::make($request->all(), [
                'fullname' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone_number' => 'required|string|max:20',
                'address' => 'required|string|max:255',
                'content' => 'required|string',
                'isAttending' => 'required|boolean',
            ]);

            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 400);
            }

            $comment = Comment::create($validator->validated());

            DetailComment::create([
                'wedding_id' => $id,
                'comment_id' => $comment->comment_id,
            ]);

            return response()->json([
                'message' => 'Comment created successfully',
                'data' => $comment
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while creating the comment',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    public function index($id)
    {
        try {
            $comments = Comment::whereHas('detailComment', function($query) use ($id) {
                $query->where('wedding_id', $id);
            })->get();

            return response()->json($comments, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while retrieving comments',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    public function show($wedding_id, $comment_id)
    {
        try {
            $comment = Comment::whereHas('detailComment', function($query) use ($wedding_id) {
                $query->where('wedding_id', $wedding_id);
            })->find($comment_id);

            if (!$comment) {
                return response()->json(['message' => 'Comment not found'], 404);
            }

            return response()->json($comment, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while retrieving the comment',
                'error_message' => $e->getMessage()
            ], 500);
        }
    }
}
