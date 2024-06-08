<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pixel;

class PixelController extends Controller
{
    public function index()
    {
        $pixels = Pixel::all();
        return view('admin.pixel', compact('pixels'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'pixel_id' => 'required|string|max:255|unique:pixels,pixel_id',
            'name' => 'nullable|string|max:255',
        ]);

        Pixel::create([
            'pixel_id' => $request->pixel_id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Pixel do Facebook salvo com sucesso!');
    }

    public function destroy($id)
    {
        $pixel = Pixel::findOrFail($id);
        $pixel->delete();

        return redirect()->back()->with('success', 'Pixel deletado com sucesso!');
    }
}
