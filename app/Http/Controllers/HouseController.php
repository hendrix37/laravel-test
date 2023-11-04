<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HouseController extends Controller
{
    public function store(Request $request)
    {

        $file = $request->file('photo');
        $originalName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $filename = "{$originalName}.{$extension}";
        $storedFile = $file->storeAs($filename);

        House::create([
            'name' => $request->name,
            'photo' => $filename,
        ]);

        return 'Success';
    }

    public function update(Request $request, House $house)
    {
        $oldPhoto = $house->photo;

        // Delete the old file
        Storage::delete($oldPhoto);

        $file = $request->file('photo');
        $originalName = Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME));
        $extension = $file->getClientOriginalExtension();
        $filename = "{$originalName}.{$extension}";
        $storedFile = $file->storeAs('houses', $filename);

        $house->update([
            'name' => $request->name,
            'photo' => $filename,
        ]);
    }

    public function download(House $house)
    {
        $filePath = storage_path("app/houses/{$house->photo}");
        // dd($filePath,Storage::exists($house->photo));
        if (!Storage::exists($house->photo)) {
            abort(404);
        }
    
        return response()->download($filePath, $house->photo);
    }
}
