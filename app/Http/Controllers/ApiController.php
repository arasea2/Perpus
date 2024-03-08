<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;

class ApiController extends Controller
{
    public function bookList()
    {
        $data = Buku::all();

        $response = [];
        foreach ($data as $buku) {
            $bukuData = $buku->toArray();
            $bukuData['stock_tersedia'] = $buku->stockTersedia();
            $response[] = $bukuData;
        }

        return response()->json($response);
    }
    public function insertPeminjam(Request $request)
    {

        $book = Buku::find($request->id_buku);

        $count = Peminjaman::where('id_buku', $request->id_buku)
            ->where(function ($query) {
                $query->where('status', 'dipinjam');
            })
            ->count();

        $available_stock = $book->dstock - $count;

        if ($available_stock <= 0) {
            return redirect()->back()->with('message', 'stock buku tiak tersedia mohon pinjam buku lain');
        } else {
            $request->validate([
                'id_user' => 'required',
                'id_buku' => 'required',
                'tglPinjam' => 'required|date',
                'tglKembali' => 'required|date|after:tglPinjam',
                'status' => 'required',
            ]);
            $post = Peminjaman::create([
                'id_user' => $request->id_user,
                'id_buku' => $request->id_buku,
                'tglPinjam' => $request->tglPinjam,
                'tglKembali' => $request->tglKembali,
                'status' => $request->status,
            ]);

            event(new Registered($post));

            // return redirect()->back()->with(['message' => 'Peminjaman Telah Berhasil Dilakukan']);
            return redirect('/')->with('message', 'Peminjaman Telah Berhasil Dilakukan');
        }
        // return response()->json($available_stock);
    }

    public function pinjamBuku(Request $request)
    {
        $book = Buku::find($request->id);

        // return response()->json($book);
        return (Inertia::render('Public/InsertPinjam', [
            'book' => $book
        ]));
    }

    public function listPinjaman(Request $request)
    {
        $data = Peminjaman::where('id_user', $request->id)->with('Book')->orderBy('id', 'desc')->get();

        return response()->json($data);
    }

    public function kelompok(Request $request)
    {
        $data = Peminjaman::where('status', $request->status)->where('id_user', $request->id_users)->with('Book')->orderBy('id', 'desc')->get();

        return response()->json($data);
    }

    public function infoBox()
    {
        $dataUser = User::count();
        $dataBuku = Buku::count();
        $dataResponse = Peminjaman::count();

        return response()->json([
            'user' => $dataUser,
            'buku' => $dataBuku,
            'response' => $dataResponse
        ]);
    }

    public function cartInfo(Request $request)
    {
        $data = Peminjaman::where('id_user', $request->id)->count();
        $dipinjam = Peminjaman::where('id_user', $request->id)->where('status', 'dipinjam')->count();

        return response()->json([
            'data' => $data,
            'dipinjam' => $dipinjam
        ]);
    }

    public function test()
    {
        $data = Buku::all();

        $response = [];
        foreach ($data as $buku) {
            $bukuData = $buku->toArray();
            $bukuData['stock_tersedia'] = $buku->stockTersedia();
            $response[] = $bukuData;
        }

        return response()->json($response);
    }
}
