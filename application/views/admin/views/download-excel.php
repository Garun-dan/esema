<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

function generateExcel($dataKuesioner, $dataRekomendasi)
{
    $spreadsheet = new Spreadsheet();

    $sheetKuesioner = $spreadsheet->getActiveSheet();
    $sheetKuesioner->setTitle('Data Kuesioner');

    $headerKuesioner = [
        'Nama Responden', 'Instrumen', 'Nilai D', 'Nilai I', 'Nilai F', 'Rata-rata', 'Keterangan'
    ];

    $sheetKuesioner->fromArray($headerKuesioner, NULL, 'A1');

    $rowDataKuesioner = [];
    foreach ($dataKuesioner as $item) {
        $rowDataKuesioner[] = [
            $item->nama,
            $item->instrumen,
            $item->jwb_d,
            $item->jwb_i,
            $item->jwb_f,
            number_format($item->total, 2),
            $item->rekom
        ];
    }

    $sheetKuesioner->fromArray($rowDataKuesioner, NULL, 'A2');

    $sheetRekomendasi = $spreadsheet->createSheet();
    $sheetRekomendasi->setTitle('Data Rekomendasi');

    $headerRekomendasi = [
        'Nama Responden', 'Instrumen', 'Nilai D', 'Nilai I', 'Nilai F', 'Rata-rata', 'Nilai', 'Rekomendasi'
    ];

    $sheetRekomendasi->fromArray($headerRekomendasi, NULL, 'A1');

    $rowDataRekomendasi = [];
    foreach ($dataRekomendasi as $item) {
        $rowDataRekomendasi[] = [
            $item->nama ?? '',
            $item->instrumen ?? '',
            $item->jwb_d ?? '',
            $item->jwb_i ?? '',
            $item->jwb_f ?? '',
            number_format($item->total ?? 0, 2),
            sprintf('(%s / %s) x 100%% = %s%%', number_format($item->total ?? 0, 2), $maxCount, number_format($nilai)),
            $rekomendasi
        ];
    }

    $sheetRekomendasi->fromArray($rowDataRekomendasi, NULL, 'A2');

    $writer = new Xlsx($spreadsheet);
    $filename = 'data_tna.xlsx';
    $writer->save($filename);

    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="' . $filename . '"');
    header('Cache-Control: max-age=0');
    $writer->save('php://output');
    exit;
}
