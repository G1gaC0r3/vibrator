<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\User;
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
    $users = User::all(); // Fetch all users from the users table
    $totalJumlah = Barang::sum('jumlah_barang');
    return view('dashboard', compact('barangs', 'totalJumlah', 'users'));
   
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
        return view("dashboard");
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
<<<<<<< HEAD
        'jenis_barang' => 'required|in:Pack,Botol,Kaleng,Saset',
=======
        'jenis_barang' => 'required|in:Pack,Botol,Kaleng,Pcs,Box,Lembar,Unit',
>>>>>>> 2a02a5b3b9b37f9e304095566df9567d7466473c
        'jumlah_barang' => 'required|integer',
    ]);

    Barang::create($validatedData);

    return redirect('dashboard')->with('success', 'Barang Di Tambahkan!');
}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $barang = barang::find($id);
        
        return view('dashboard')->with('barang', $barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
{
    $barang = Barang::find($id);
    return view('keluar', compact('barang'))
    -> with('barang', $barang);
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|in:Pack,Botol,Kaleng,Saset',
        'jumlah_barang' => 'required|integer',
    ]);

    Barang::create($validatedData);

    return redirect()->route('masuk')->with('success', 'Barang Di Update!');
}


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Barang::destroy($id);
        return redirect('keluar')->with('success','Barang Di Hapus!');
    }
}
