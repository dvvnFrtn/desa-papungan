<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\BeritaCollection;
use App\Http\Resources\BeritaResource;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class BeritaController extends Controller
{
    public function getAll(Request $request) 
    {
        if (!empty($request->judul)){
            $beritas = Berita::where('judul', 'LIKE', "%{$request->judul}%")
                ->orderBy('created_at', 'DESC')
                ->get();
        } else {
            $beritas = Berita::orderBy('created_at', 'DESC')->get();
        }

        $resources = (new BeritaCollection($beritas));
        return ApiResponseClass::sendResponse($resources, 'Data berita berhasil diambil!', 200);
    }

    public function getById($id) 
    {
        $berita = Berita::where('id', $id)->first();
        
        if (!$berita) {
            return ApiResponseClass::sendError('Data berita tidak ditemukan!', 400);
        }

        $resource = new BeritaResource($berita);
        return ApiResponseClass::sendResponse($resource, 'Data berita berhasil diambil!', 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul' => 'required',
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::sendError($validator->errors(), 422);
        }

        $image = $request->file('foto');
        $image->storeAs('public/berita', $image->hashName());

        $berita = Berita::create([
            'foto' => $image->hashName(),
            'judul' => $request->judul,
            'isi' => $request->isi
        ]);
        $resource = new BeritaResource($berita);

        return ApiResponseClass::sendResponse($resource, 'Data berita berhasil ditambahkan!', 201);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'foto' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'judul' => 'required',
            'isi' => 'required',
            'isAccepted' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::sendError($validator->errors(), 422);
        }

        $berita = Berita::where('id', $id)->first();
        if (!$berita) {
            return ApiResponseClass::sendError('Data berita tidak ditemukan!', 404);
        }
                    
        $image = $request->file('foto');
        $image->storeAs('public/berita', $image->hashName());
        
        Storage::delete('public/berita/'.$berita->foto);
        
        $berita->update([
            'foto' => $image->hashName(),
            'judul'  => $request->judul,
            'isi'  => $request->isi,
            'isAccepted'  => $request->isAccepted,
        ]);
        $berita->save();

        $resource = new BeritaResource($berita);
        return ApiResponseClass::sendResponse($resource, 'Data berita berhasil diperbarui!', 200);
    }

    public function destroy(string $id)
    {
        $isDeleted = Berita::destroy(intval($id));
        
        if (!$isDeleted) {
            return ApiResponseClass::sendError('Data berita gagal dihapus!', 400);
        }

        return ApiResponseClass::sendResponse(null, 'Data berita berhasil dihapus!', 200);
    }
}
