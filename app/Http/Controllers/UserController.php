<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\Media;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return UserResource::collection(User::with('media')->paginate(10));
    }

    public function show(User $user)
    {
        return new UserResource($user->load('media'));
    }

    public function addToCollection(Request $request, User $user)
    {
        $request->validate([
            'media_id' => 'required|exists:media,id',
        ], [
            'media_id.required' => 'ID media wajib diisi',
            'media_id.exists' => 'Media tidak ditemukan di sistem',
        ]);

        if ($user->media()->where('media_id', $request->media_id)->exists()) {
            return response()->json([
                'message' => 'Media sudah ada di koleksi pengguna',
            ], 409);
        }

        $user->media()->attach($request->media_id);

        return response()->json([
            'message' => 'Media berhasil ditambahkan ke koleksi',
            'data' => new UserResource($user->load('media')),
        ], 201);
    }

    public function removeFromCollection(User $user, Media $media)
    {
        if (!$user->media()->where('media_id', $media->id)->exists()) {
            return response()->json([
                'message' => 'Media tersebut tidak ditemukan di dalam koleksi pengguna',
            ], 404);
        }

        $user->media()->detach($media->id);

        return response()->json([
            'message' => 'Media berhasil dihapus dari koleksi',
            'data' => new UserResource($user->load('media')),
        ]);
    }
}
