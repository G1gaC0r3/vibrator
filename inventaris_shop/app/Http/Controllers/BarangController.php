<?php

namespace App\Http\Controllers;
use App\Models\Barang;
use App\Models\User;
use Illuminate\Http\Request;
Use Illuminate\Http\Response;
use App\Models\BarangTerpakai;

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
    foreach ($barangs as $barang) {
        $barang->tersisa = $barang->jumlah_barang - $barang->terpakai;
    }

    $totalJumlah = Barang::sum('jumlah_barang');
    $totalBarang = Barang::count('id_barang');
    $totalTerpakai = Barang::sum('terpakai');
    return response()->view('masuk', compact('barangs', 'totalJumlah', 'totalBarang', 'totalTerpakai'));
}

public function index1()
{
    $barangs = Barang::all();
    foreach ($barangs as $barang) {
        $barang->tersisa = $barang->jumlah_barang - $barang->terpakai;
    }

    $totalJumlah = Barang::sum('jumlah_barang');
    $totalBarang = Barang::count('id_barang');
    $totalTerpakai = Barang::sum('terpakai');
    return view('dashboard', compact('barangs', 'totalJumlah', 'totalBarang', 'totalTerpakai'));
   
}

    public function index2()
    {
        $barangs = Barang::all();
        foreach ($barangs as $barang) {
            $barang->tersisa = $barang->jumlah_barang - $barang->terpakai;
        }
    
        $totalJumlah = Barang::sum('jumlah_barang');
        $totalBarang = Barang::count('id_barang');
        $totalTerpakai = Barang::sum('terpakai');
        return view('keluar', compact('barangs', 'totalJumlah', 'totalBarang', 'totalTerpakai'));
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

    // Lanjutkan dengan metode lainnya di sini
 // Kurung kurawal ini menutup kelas BarangController
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
        'terpakai' => 'nullable|integer'
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
        $barang = Barang::find($id_barang);
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

    public function update(Request $request, $id_barang)
    {
        $validatedData = $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jenis_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer',
        ]);

        Barang::where('id_barang', $id_barang)->update($validatedData);
   
        return redirect()->route('keluar')->with('success', 'Barang updated successfully');
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

        return redirect('keluar')->with('success', 'Barang deleted successfully');
    }

    public function pakai(Request $request, $id_barang)
    {
        $barang = Barang::findOrFail($id_barang);
    
        $validatedData = $request->validate([
            'terpakai' => [
                'required',
                'integer',
                function ($attribute, $value, $fail) use ($barang) {
                    if ($value > $barang->jumlah_barang) {
                        $fail('Tidak bisa melebihi jumlah barang!');
                    }
                },
            ],
        ]);
    
        $barang->update($validatedData);
    
        return redirect('keluar')->with('success', 'Barang Di Update!');
    }
}