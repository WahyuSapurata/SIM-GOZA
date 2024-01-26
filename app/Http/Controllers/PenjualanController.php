<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePenjualanRequest;
use App\Http\Requests\UpdatePenjualanRequest;
use App\Models\Penjualan;
use App\Models\User;

class PenjualanController extends BaseController
{
    public function index()
    {
        $module = 'Data Penjualan';
        return view('admin.penjualan.index', compact('module'));
    }

    public function get()
    {
        // Mengambil semua data pengguna
        $data = Penjualan::all();
        $dataUser = User::all();
        $combinedData = $data->map(function ($item) use ($dataUser) {
            $user = $dataUser->where('uuid', $item->uuid_user)->first();

            $item->user = $user->name;

            return $item;
        });

        // Mengembalikan response berdasarkan data yang sudah disaring
        return $this->sendResponse($combinedData, 'Get data success');
    }

    public function store(StorePenjualanRequest $storePenjualanRequest)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storePenjualanRequest->harga);
        $data = array();
        try {
            $data = new Penjualan();
            $data->uuid_user = auth()->user()->uuid;
            $data->metode_bayar = $storePenjualanRequest->metode_bayar;
            $data->material = $storePenjualanRequest->material;
            $data->mobil = $storePenjualanRequest->mobil;
            $data->harga = $numericValue;
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
            $data = Penjualan::where('uuid', $params)->first();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Show data success');
    }

    public function update(StorePenjualanRequest $storePenjualanRequest, $params)
    {
        $numericValue = (int) str_replace(['Rp', ',', ' '], '', $storePenjualanRequest->harga);
        try {
            $data = Penjualan::where('uuid', $params)->first();
            $data->uuid_user = auth()->user()->uuid;
            $data->metode_bayar = $storePenjualanRequest->metode_bayar;
            $data->material = $storePenjualanRequest->material;
            $data->mobil = $storePenjualanRequest->mobil;
            $data->harga = $numericValue;
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
            $data = Penjualan::where('uuid', $params)->first();
            $data->delete();
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), $e->getMessage(), 400);
        }
        return $this->sendResponse($data, 'Delete data success');
    }
}
