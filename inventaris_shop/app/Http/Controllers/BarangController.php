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
    $totalBarang = Barang::sum('id_barang');
    return response()->view('masuk', compact('barangs', 'totalJumlah', 'totalBarang'));
}

public function index1()
{
    $barangs = Barang::all();
    $users = User::all(); // Fetch all users from the users table
    $totalJumlah = Barang::sum('jumlah_barang');
    $totalBarang = Barang::sum('id_barang');
    return view('dashboard', compact('barangs', 'totalJumlah', 'totalBarang', 'users'));
   
}

public function index2()
{
    $barangs = Barang::all();
    $totalJumlah = Barang::sum('jumlah_barang');
    $totalBarang = Barang::sum('id_barang');
    return view('keluar', compact('barangs', 'totalJumlah', 'totalBarang'));
   
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view("dashboard");
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
        'id_barang' => 'required|int|max:10|unique:barangs',
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|string|max:255',
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
    public function show($id_barang)
    {
        $barang = barang::find($id_barang);
        $totalJumlah = Barang::sum('jumlah_barang');

        
        return view('dashboard')->with('barang', $barang);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_barang)
{
    $barang = Barang::find($id_barang);
    

    return view('keluar')->with('barang', $barang);
}

public function update(Request $request, $id)
{
    $validatedData = $request->validate([
        'nama_barang' => 'required|string|max:255',
        'jenis_barang' => 'required|string|max:255',
        'jumlah_barang' => 'required|integer',
    ]);

    Barang::where('id_barang', $id)->update($validatedData);

    return redirect()->route('keluar')->with('success', 'Barang Di Update!');

}



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
        $barang->delete();
    
        return redirect('/keluar')->with('success', 'Barang deleted successfully');
    }
}

