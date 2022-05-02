<?php

namespace App\Utils;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageServe
{
    public static function Base64($path)
    {
        try {
            if (Auth::check()) {
                $data = (Storage::disk('local')->get($path));
                return "data:image/png;base64," . base64_encode($data);
            } else {
                return asset('storage\Images\403.png');
            }
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
