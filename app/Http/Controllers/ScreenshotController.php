<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ScreenshotController extends Controller
{
    public function store(Request $request)
    {
        if ($request->has('img')) {
            $image = $request->input('img'); // Get the base64 image data
            $image = str_replace('data:image/png;base64,', '', $image);
            $image = str_replace(' ', '+', $image);
            $imageName = time() . '.png';
            
            $path = public_path('images/' . $imageName);
            File::put($path, base64_decode($image));

            return response()->json(['message' => 'Screenshot saved successfully!', 'path' => asset('images/' . $imageName)]);
        }

        return response()->json(['error' => 'No image received'], 400);
    }
}
