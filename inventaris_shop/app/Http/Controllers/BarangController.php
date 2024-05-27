<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use Illuminate\Http\Request;
Use Illuminate\Http\Response;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
{
    $barangs = Barang::all();
    $totalJumlah = Barang::sum('jumlah_barang');
    return view('masuk', compact('barangs', 'totalJumlah'));
}

public function index1()
{
    $barangs = Barang::all();
    $totalJumlah = Barang::sum('jumlah_barang');
    return view('dashboard', compact('barangs', 'totalJumlah'));
   
}

public function index2()
{
    $barangs = Barang::all();
    $totalJumlah = Barang::sum('jumlah_barang');
    return view('keluar', compact('barangs', 'totalJumlah'));
   
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|in:Pack,Botol,Kaleng,Saset',
        'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'jumlah_barang' => 'required|integer',
    ]);

    // Handle the image upload
    if ($request->hasFile('gambar_barang')) {
        $image = $request->file('gambar_barang');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        $validatedData['gambar_barang'] = $imageName;
    }
    else {
        $validatedData['gambar_barang'] = 'images.jpeg';
    }

    Barang::create($validatedData);

    return redirect('dashboard')->with('success', 'Barang created successfully.');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $barang = Barang::findOrFail($id);
    return view('keluar', compact('barang')); 
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|in:Pack,Botol,Kaleng,Saset',
        'gambar_barang' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'jumlah_barang' => 'required|integer',
    ]);

    $barang = Barang::findOrFail($id);

    if ($request->hasFile('gambar_barang')) {
        $file = $request->file('gambar_barang');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('images'), $filename);
        $validatedData['gambar_barang'] = $filename;
    } else {
        $validatedData['gambar_barang'] = $barang->gambar_barang ?? 'images.jpeg'; // Keep existing value or set default to 0
    }

    $barang->update($validatedData);

    return redirect()->route('dashboard')->with('success', 'Barang updated successfully.');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
