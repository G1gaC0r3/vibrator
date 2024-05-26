<?php

namespace App\Http\Controllers;

use App\Models\barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $barang = Barang::all();
        return view('barang.index', compact('barang'));
    }

    public function create()
    {
        return view('barang.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_barang' => 'required', 'unique',
            'name' => 'required',
            'image' => 'required|image|max:2048',
            'jumlah' => 'required|integer',
            'deskripsi' => 'nullable',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        Barang::create([
            'name' => $request->name,
            'image' => $imagePath,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('barang.index')->with('success', 'Item created successfully.');
    }

    public function show(Barang $barang)
    {
        return view('barang.show', compact('barang'));
    }

    public function edit(Barang $barang)
    {
        return view('barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|max:2048',
            'quantity' => 'required|integer',
            'description' => 'nullable',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $barang->update(['image' => $imagePath]);
        }

        $barang->update([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'description' => $request->description,
        ]);

        return redirect()->route('barang.index')->with('success', 'Item updated successfully.');
    }

    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('barang.index')->with('success', 'Item deleted successfully.');
    }
}
