<?php

namespace App\Exports;

use App\Models\M_SuratMasuk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DisposisiExport implements FromCollection, WithHeadings, ShouldAutoSize, WithStyles
{
    /**
     * Ambil data untuk diekspor.
     */
    public function collection()
    {
        return M_SuratMasuk::with('disposisi.bagian')
            ->where('status_disposisi', 'y')
            ->get()
            ->map(function ($item) {
                return [
                    'No Surat' => $item->no_surat,
                    'Asal Surat' => $item->asal_surat,
                    'Jenis Surat' => $item->jenis_surat,
                    'Bagian Disposisi' => $item->disposisi->bagian->nama_bagian ?? '-',
                    'Sifat' => $item->disposisi->sifat ?? '-',
                    'Isi Disposisi' => $item->disposisi->isi_disposisi ?? '-',
                    'Catatan' => $item->disposisi->catatan ?? '-',
                ];
            });
    }

    /**
     * Menambahkan header kolom.
     */
    public function headings(): array
    {
        return [
            'No Surat',
            'Asal Surat',
            'Jenis Surat',
            'Bagian Disposisi',
            'Sifat',
            'Isi Disposisi',
            'Catatan',
        ];
    }

    /**
     * Menerapkan gaya pada worksheet.
     */
    public function styles(Worksheet $sheet)
    {
        // Terapkan gaya pada seluruh kolom dengan border dan warna latar belakang
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['argb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['argb' => '4CAF50'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Terapkan border ke semua baris data
        $sheet->getStyle('A2:G' . ($sheet->getHighestRow()))->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['argb' => '000000'],
                ],
            ],
        ]);

        // Menambahkan filter pada header
        $sheet->setAutoFilter('A1:G1');
    }
}
