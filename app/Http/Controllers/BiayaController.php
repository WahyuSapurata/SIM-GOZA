<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBiayaRequest;
use App\Http\Requests\UpdateBiayaRequest;
use App\Models\Biaya;
use App\Models\User;
use Illuminate\Http\Request;

class BiayaController extends BaseController
{
    public function index()
    {
        $module = 'Data Biaya';
        return view('admin.biaya.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $data = Biaya::all();
        $dataUser = User::all();
        $combinedData = $data->map(function ($item) use ($dataUser) {
            $user = $dataUser->where('uuid', $item->uuid_user)->first();

            $item->user = $user->name;

            return $item;
        });

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($combinedData, 'Get data success');
    }

    public function store(Request $request)
    {
        $data = array();
        try {
            $data = new Biaya();
            $data->uuid_user = auth()->user()->uuid;
            $data->pengeluaran = $request->pengeluaran;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Added data success');
    }

    public function show($params)
    {
        $data = array();
        try {
            $data = Biaya::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(Request $request, $params)
    {
        try {
            $data = Biaya::where('uuid', $params)->first();
            $data->pengeluaran = $request->pengeluaran;
            $data->save();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }

        return $this->sendResponse($data, 'Update data success');
    }

    public function delete($params)
    {
        $data = array();
        try {
            $data = Biaya::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
