<?php

namespace App\Http\Controllers\api;

use App\Classes\ApiResponseClass;
use App\Http\Controllers\Controller;
use App\Http\Resources\PengumumanCollection;
use App\Http\Resources\PengumumanResource;
use App\Models\Pengumuman;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator as FacadesValidator;

class PengumumanController extends Controller
{
    public function getAll(Request $request)
    {
        $pengumumans = Pengumuman::orderBy('created_at', 'DESC');

        if ($request->pub == '1'){
            $pengumumans = $pengumumans->where('isAccepted', 1);
        } else if ($request->pub == '0'){
            $pengumumans = $pengumumans->where('isAccepted', 0);
        }
        if (!empty($request->judul)){
            $pengumumans = $pengumumans->where('judul', 'LIKE', "%{$request->judul}%");
        }
        $pengumumans = $pengumumans->get();

        $resource = new PengumumanCollection($pengumumans);
        return ApiResponseClass::sendResponse($resource, 'Data pengumuman berhasil diambil!', 200);
    }

    public function getById($id)
    {
        $pengumuman = Pengumuman::where('id', $id)->first();
        if (!$pengumuman){
            return ApiResponseClass::sendError('Data pengumuman tidak ditemukan!', 404);
        }

        $resource = new PengumumanResource($pengumuman);
        return ApiResponseClass::sendResponse($resource, 'Data pengumuman berhasil diambil!', 200);
    }

    public function store(Request $request)
    {
        $validator = FacadesValidator::make($request->all(), [
            'judul' => 'required',
            'isi' => 'required',
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::sendError($validator->errors(), 422);
        }

        $pengumuman = Pengumuman::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'nama' => $request->nama
        ]);
        $resource = new PengumumanResource($pengumuman);

        return ApiResponseClass::sendResponse($resource, 'Data pengumuman berhasil ditambahkan', 201);
    }

    public function update(Request $request, $id)
    {
        $validator = FacadesValidator::make($request->all(), [
            'judul' => 'required',
            'isi' => 'required'
        ]);

        if ($validator->fails()) {
            return ApiResponseClass::sendError($validator->errors(), 422);
        }

        $pengumuman = Pengumuman::where('id', $id)->first();
        if (!$pengumuman) {
            return ApiResponseClass::sendError('Data pengumuman tidak ditemukan!', 404);
        }

        $pengumuman->update([
            'judul'  => $request->judul,
            'isi'  => $request->isi,
            'nama' => $request->nama,
            'isAccepted'  => intval($request->isAccepted)
        ]);
        $pengumuman->save();

        $resource = new PengumumanResource($pengumuman);
        return ApiResponseClass::sendResponse($resource, 'Data pengumuman berhasil diperbarui!', 200);
    }

    public function getAccepted($id)
    {   
        $pengumuman = Pengumuman::where('id', $id)->first();
        if (!$pengumuman){
            return ApiResponseClass::sendError('Data pengumuman tidak ditemukan!', 404);
        }

        $pengumuman->update([
            'isAccepted' => 1
        ]);
        $pengumuman->save();

        $resource = new PengumumanResource($pengumuman);
        return ApiResponseClass::sendResponse($resource, 'Data pengumuman berhasil diperbarui!', 200);
    }

    public function destroy(string $id)
    {
        $isDeleted = Pengumuman::destroy(intval($id));
        if(!$isDeleted){
            return ApiResponseClass::sendError('Data pengumuman gagal dihapus!', 400);
        }

        return ApiResponseClass::sendResponse(null, 'Data pengumuman berhasil dihapus!', 200);
    }
}
