<?php

namespace App\Http\Controllers;

use App\Models\Biaya;
use App\Models\Penjualan;
use Illuminate\Http\Request;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporan extends BaseController
{
    public function index()
    {
        $module = 'Laporan';
        return view('admin.laporan.index', compact('module'));
    }

    public function getLaporan($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        $mergedData = collect(); // Membuat koleksi kosong

        // Menggabungkan data dari PersetujuanPo
        $penjualan = Penjualan::all();
        $mergedData = $mergedData->merge($penjualan);

        // Menggabungkan data dari NonVendor
        $biaya = Biaya::all();
        $mergedData = $mergedData->merge($biaya);

        $combinedData = $mergedData->map(function ($item) {
            // Tambahkan logika modifikasi data di sini
            $item->tanggal = optional($item->created_at)->format('d-m-Y');

            if ($item instanceof Biaya) {
                // Jika sudah dalam bentuk array, gunakan langsung
                $jenisPengeluaranArray = collect($item->pengeluaran)->pluck('jenis_pengeluaran')->toArray();
                $item->deskripsi = $jenisPengeluaranArray;
                $hargaPengeluaranArray = collect($item->pengeluaran)->pluck('harga')->toArray();
                $item->keluar = $hargaPengeluaranArray;
            } elseif ($item instanceof Penjualan) {
                $item->deskripsi = [$item->metode_bayar, $item->material, $item->mobil] ?? '';
                $item->masuk = $item->harga ?? '';
            }

            return $item;
        });

        $filteredData = $combinedData->whereBetween('tanggal', [$startDateStr, $endDateStr]);
        // Mengurutkan data berdasarkan tanggal create yang terbaru
        $sortedData = $filteredData->sortBy('created_at')->values()->all();

        // Mengembalikan respon
        return $this->sendResponse($sortedData, 'Get data success');
    }

    public function exportToExcel($params)
    {
        // Memisahkan tanggal berdasarkan kata kunci "to"
        $dateParts = explode(' to ', $params);

        // $dateParts[0] akan berisi tanggal awal dan $dateParts[1] akan berisi tanggal akhir
        $startDateStr = trim($dateParts[0]);
        $endDateStr = trim($dateParts[1]);

        $mergedData = collect(); // Membuat koleksi kosong

        // Menggabungkan data dari PersetujuanPo
        $penjualan = Penjualan::all();
        $mergedData = $mergedData->merge($penjualan);

        // Menggabungkan data dari NonVendor
        $biaya = Biaya::all();
        $mergedData = $mergedData->merge($biaya);

        $combinedData = $mergedData->map(function ($item) {
            // Tambahkan logika modifikasi data di sini
            $item->tanggal = optional($item->created_at)->format('d-m-Y');

            if ($item instanceof Biaya) {
                // Jika sudah dalam bentuk array, gunakan langsung
                $jenisPengeluaranArray = collect($item->pengeluaran)->pluck('jenis_pengeluaran')->toArray();
                $item->deskripsi = $jenisPengeluaranArray;
                $hargaPengeluaranArray = collect($item->pengeluaran)->pluck('harga')->toArray();
                $item->keluar = $hargaPengeluaranArray;
            } elseif ($item instanceof Penjualan) {
                $item->deskripsi = [$item->metode_bayar, $item->material, $item->mobil] ?? '';
                $item->masuk = $item->harga ?? '';
            }

            return $item;
        });

        $filteredData = $combinedData->whereBetween('tanggal', [$startDateStr, $endDateStr]);
        // Mengurutkan data berdasarkan tanggal create yang terbaru
        $sortedData = $filteredData->sortBy('created_at')->values()->all();

        // Buat objek Spreadsheet
        $spreadsheet = new Spreadsheet();

        // Ambil objek aktif (sheet aktif)
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        $sheet->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_FOLIO);
        $sheet->getRowDimension(1)->setRowHeight(30);
        $spreadsheet->getDefaultStyle()->getFont()->setName('Times New Roman');
        $fontStyle = [
            'font' => [
                'name' => 'Times New Roman',
                'size' => 12,
            ],
        ];

        // Isi data ke dalam sheet

        $centerStyle = [
            'alignment' => [
                //'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ];
        $sheet->setCellValue('A1', 'LAPORAN')->mergeCells('A1:F1');
        $sheet->setCellValue('A2', 'MULAI DARI TANGGAL ' . $startDateStr . ' SAMPAI ' . $endDateStr)->mergeCells('A2:F2');

        $sheet->setCellValue('A3', 'NO');
        $sheet->setCellValue('B3', 'TANGGAL');
        $sheet->setCellValue('C3', 'KETERANGAN');
        $sheet->setCellValue('D3', 'KELUAR');
        $sheet->setCellValue('E3', 'MASUK');
        $sheet->setCellValue('F3', 'SALDO');

        // Memberikan warna pada sel-sel baris ke-3
        $sheet->getStyle('A3:F3')->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'acb9ca', // Warna Peach
                ],
            ],
        ]);

        $row = 4;
        $subtotalTotal = 0;

        foreach ($sortedData as $index => $lap) {
            $sheet->setCellValue('A' . $row, $index + 1);
            $sheet->setCellValue('B' . $row, $lap->tanggal);

            // Format deskripsi sebagai HTML dengan menggunakan tag <ul>
            $deskripsiHTML = implode(', ', $lap->deskripsi);
            $sheet->setCellValue('C' . $row, $deskripsiHTML);

            // Format keluar sebagai array
            $keluarArray = $lap->keluar;

            $value = '-';
            if ($keluarArray) {
                // Menggabungkan elemen-elemen array dengan koma sebagai pemisah
                $formattedValues = array_map(function ($y) {
                    return "Rp " . number_format($y, 0, ',', '.');
                }, $keluarArray);

                $value = implode(', ', $formattedValues);
            }

            $sheet->setCellValue('D' . $row, $value);
            $sheet->setCellValue('E' . $row, $lap->masuk ? "Rp " . number_format($lap->masuk, 0, ',', '.') : '-');

            // Format rupiah pada kolom F
            $saldo_keluar = 0;

            if ($lap->keluar) {
                foreach ($lap->keluar as $y) {
                    $parsedValue = floatval($y);
                    if (!is_nan($parsedValue)) {
                        $saldo_keluar += $parsedValue;
                    }
                }
            } else {
                $saldo_keluar = 0;
            }

            $masuk = isset($lap->masuk) ? floatval($lap->masuk) : 0;

            // Menghitung sisa saldo
            $sisa_saldo = $masuk - $saldo_keluar;

            // Menambahkan sisa saldo ke variabel kumulatif
            $subtotalTotal += $sisa_saldo;

            // Format rupiah pada kolom H
            $formattedSaldo = "Rp " . number_format($subtotalTotal, 0, ',', '.');
            $sheet->setCellValue('F' . $row, $formattedSaldo);

            $row++;
        }

        // Baris Total
        $sheet->setCellValue('A' . $row, 'Total Saldo'); // Gantilah 'Total' dengan label yang sesuai
        $sheet->mergeCells('A' . $row . ':E' . $row); // Gabungkan sel dari A hingga E
        $sheet->setCellValue('F' . $row, "Rp " . number_format($subtotalTotal, 0, ',', '.')); // Menghitung total
        // Menerapkan gaya untuk sel total
        $sheet->getStyle('A' . $row . ':F' . $row)->applyFromArray([
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => [
                    'rgb' => 'acb9ca', // Warna Peach
                ],
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ]);

        $row++; // Pindahkan ke baris berikutnya

        // Ambil objek kolom terakhir yang memiliki data (A, B, C, dst.)
        $lastColumn = $sheet->getHighestDataColumn();

        // Iterate melalui kolom-kolom yang memiliki data dan atur lebar kolomnya
        foreach (range('A', $lastColumn) as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Menerapkan style alignment untuk seluruh sel dalam spreadsheet
        $sheet->getStyle('A1:' . $lastColumn . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('C4:' . $lastColumn . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A3:I3')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A11:A' . $row)->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('A1:I1')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        $sheet->getStyle('E7:E8')->applyFromArray([
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);

        // Memberikan border ke seluruh sel di kolom
        for ($col = 'A'; $col <= 'F'; $col++) {
            $sheet->getStyle($col . '3:' . $col . ($row - 1))->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    ],
                ],
            ]);
        }

        $excelFileName = 'laporan_' . $params . '.xlsx';
        $excelFilePath = public_path($excelFileName);
        $writer = new Xlsx($spreadsheet);
        $writer->save($excelFilePath);

        // Kembalikan response dengan file PDF yang diunduh
        return response()->download(public_path($excelFileName));
    }
}
