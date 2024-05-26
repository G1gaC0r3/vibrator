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
    return view('masuk', compact('barangs'))->with('dashboard', view('dashboard', compact('barangs')));
   
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
        'gambar_barang' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'jumlah_barang' => 'required|integer',
    ]);

    // Handle the image upload
    if ($request->hasFile('gambar_barang')) {
        $image = $request->file('gambar_barang');
        $imageName = time().'.'.$image->extension();
        $image->move(public_path('images'), $imageName);
        $validatedData['gambar_barang'] = $imageName;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
