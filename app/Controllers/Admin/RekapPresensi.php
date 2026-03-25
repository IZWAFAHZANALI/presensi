<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use Codeigniter\HTTP\ResponseInterface;
use App\Models\PresensiModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// Import model lokasi jika diperlukan, atau ambil via db langsung
class RekapPresensi extends BaseController
{
    public function rekap_harian()
    {
        $presensi_model = new PresensiModel();
        $filter_tanggal = $this->request->getVar('filter_tanggal');
        
        // Logika Filter (Menit [00:04:29])
        if ($filter_tanggal) {
            // Cek apakah yang diklik tombol Excel (Menit [00:08:06])
            if (isset($_GET['excel'])) {
                $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
                
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                
                // Judul & Header (Menit [00:18:12] - [00:21:15])
                $sheet->mergeCells('A1:C1');
                $sheet->mergeCells('A3:B3');
                $sheet->mergeCells('C3:E3');

                $sheet->setCellValue('A1', 'Rekap Presensi Harian');
                $sheet->setCellValue('A3', 'Tanggal');
                $sheet->setCellValue('C3', $filter_tanggal);
                
                $sheet->setCellValue('A4', 'No');
                $sheet->setCellValue('B4', 'Nama Pegawai');
                $sheet->setCellValue('C4', 'Tanggal Masuk');
                $sheet->setCellValue('D4', 'Jam Masuk');
                $sheet->setCellValue('E4', 'Tanggal Keluar');
                $sheet->setCellValue('F4', 'Jam Keluar');
                $sheet->setCellValue('G4', 'Total Jam Kerja');
                $sheet->setCellValue('H4', 'Total Terlambat');

                // Looping Data (Menit [00:24:22])
                $row = 5;
                $no = 1;
                foreach ($rekap_harian as $rekap) {
                    // 1. MENGHITUNG JUMLAH JAM KERJA (Menit 27:37)
                    $timestamp_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                    $timestamp_pulang = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                    $selisih = $timestamp_pulang - $timestamp_masuk;

                    $jam = floor($selisih / 3600);
                    $selisih_menit = $selisih - ($jam * 3600);
                    $menit = floor($selisih_menit / 60);

                    // 2. MENGHITUNG JAM KETERLAMBATAN (Menit 28:50)
                    // Ambil jam masuk real dan bandingkan dengan jam masuk kantor (08:00)
                    $jam_masuk_real = strtotime($rekap['jam_masuk']);
                    $jam_masuk_kantor = strtotime('08:00:00');

                    if ($jam_masuk_real > $jam_masuk_kantor) {
                        $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
                        $jam_terlambat = floor($selisih_terlambat / 3600);
                        $selisih_menit_terlambat = $selisih_terlambat - ($jam_terlambat * 3600);
                        $menit_terlambat = floor($selisih_menit_terlambat / 60);
                    } else {
                        $jam_terlambat = 0;
                        $menit_terlambat = 0;
                    }
                    
                    $sheet->setCellValue('A' . $row, $no++);
                    $sheet->setCellValue('B' . $row, $rekap['nama']);
                    $sheet->setCellValue('C' . $row, $rekap['tanggal_masuk']);
                    $sheet->setCellValue('D' . $row, $rekap['jam_masuk']);
                    $sheet->setCellValue('E' . $row, $rekap['tanggal_keluar']);
                    $sheet->setCellValue('F' . $row, $rekap['jam_keluar']);
                    $sheet->setCellValue('G' . $row, $jam. 'jam' . $menit . 'menit');
                    $sheet->setCellValue('H' . $row, $jam_terlambat. 'jam' . $menit_terlambat . 'menit');
                    $row++;
                }

                // Header HTTP untuk Download Otomatis (Menit [00:14:34])
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="rekap_harian.xlsx"');
                header('Cache-Control: max-age=0');

                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xlsx');
                $writer = new Xlsx($spreadsheet);
                $writer->save('php://output'); // Langsung ke browser, bukan folder public
                exit();
            } else {
                // Jika tombol Tampilkan yang diklik
                $rekap_harian = $presensi_model->rekap_harian_filter($filter_tanggal);
            }
        } else {
            $rekap_harian = $presensi_model->rekap_harian();
        }

        // ... ambil data lokasi dan return view ...
        $db = \Config\Database::connect();
        $lokasi_presensi = $db->table('lokasi_presensi')->get()->getRowArray();

        $data = [
            'title'           => 'Rekap Harian',
            'rekap_harian'    => $rekap_harian,
            'tanggal'         => $filter_tanggal,
            'lokasi_presensi' => $lokasi_presensi
        ];

        return view('Admin/rekap_presensi/rekap_harian', $data);
    }

    public function rekap_bulanan()
{
    $presensi_model = new PresensiModel();
    $filter_bulan = $this->request->getVar('filter_bulan') ?: date('m');
    $filter_tahun = $this->request->getVar('filter_tahun') ?: date('Y');

    $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
    if ($filter_bulan && $filter_tahun) {
        
        // Cek apakah tombol Excel diklik (Menit 33:54)
        if (isset($_GET['excel'])) {
            $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);

            $spreadsheet = new Spreadsheet();
            $sheet = $spreadsheet->getActiveSheet();

            // Judul & Header (Menit 34:29)
            $sheet->mergeCells('A1:C1');
            $sheet->setCellValue('A1', 'Rekap Presensi Bulanan');
            $sheet->setCellValue('A3', 'Bulan / Tahun');
            $sheet->setCellValue('C3', date('F Y', strtotime($filter_bulan . $filter_tahun)));

            $sheet->setCellValue('A4', 'No');
            $sheet->setCellValue('B4', 'Nama Pegawai');
            $sheet->setCellValue('C4', 'Tanggal Masuk');
            $sheet->setCellValue('D4', 'Jam Masuk');
            $sheet->setCellValue('E4', 'Tanggal Keluar');
            $sheet->setCellValue('F4', 'Jam Keluar');
            $sheet->setCellValue('G4', 'Total Jam Kerja');
            $sheet->setCellValue('H4', 'Total Terlambat');

            $row = 5;
            $no = 1;

            foreach ($rekap_bulanan as $rekap) {
                // 1. HITUNG TOTAL JAM KERJA (Logika Menit 27:37)
                $timestamp_masuk = strtotime($rekap['tanggal_masuk'] . ' ' . $rekap['jam_masuk']);
                $timestamp_pulang = strtotime($rekap['tanggal_keluar'] . ' ' . $rekap['jam_keluar']);
                $selisih = $timestamp_pulang - $timestamp_masuk;

                $jam = floor($selisih / 3600);
                $selisih_menit = $selisih - ($jam * 3600);
                $menit = floor($selisih_menit / 60);

                // 2. HITUNG JAM KETERLAMBATAN (Logika Menit 28:50)
                $jam_masuk_real = strtotime($rekap['jam_masuk']);
                $jam_masuk_kantor = strtotime('08:00:00');

                if ($jam_masuk_real > $jam_masuk_kantor) {
                    $selisih_terlambat = $jam_masuk_real - $jam_masuk_kantor;
                    $jam_terlambat = floor($selisih_terlambat / 3600);
                    $selisih_menit_terlambat = $selisih_terlambat - ($jam_terlambat * 3600);
                    $menit_terlambat = floor($selisih_menit_terlambat / 60);
                } else {
                    $jam_terlambat = 0;
                    $menit_terlambat = 0;
                }

                // Masukkan data ke sel Excel (Menit 39:40)
                $sheet->setCellValue('A' . $row, $no++);
                $sheet->setCellValue('B' . $row, $rekap['nama']);
                $sheet->setCellValue('C' . $row, $rekap['tanggal_masuk']);
                $sheet->setCellValue('D' . $row, $rekap['jam_masuk']);
                $sheet->setCellValue('E' . $row, $rekap['tanggal_keluar']);
                $sheet->setCellValue('F' . $row, $rekap['jam_keluar']);
                $sheet->setCellValue('G' . $row, $jam . ' Jam ' . $menit . ' Menit');
                $sheet->setCellValue('H' . $row, $jam_terlambat . ' Jam ' . $menit_terlambat . ' Menit');
                $row++;
            }

            // Pengaturan download otomatis (Menit 35:35)
            header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
            header('Content-Disposition: attachment;filename="rekap_bulanan.xlsx"');
            header('Cache-Control: max-age=0');

            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
            exit();

        } else {
            // Jika tombol Tampilkan yang diklik
            $rekap_bulanan = $presensi_model->rekap_bulanan_filter($filter_bulan, $filter_tahun);
        }
    } else {
        $filter_bulan = date('m');
        $filter_tahun = date('Y');
        $rekap_bulanan = $presensi_model->rekap_bulanan($filter_bulan, $filter_tahun);
    }

    $db = \Config\Database::connect();
    $lokasi_presensi = $db->table('lokasi_presensi')->get()->getRowArray();

    $data = [
        'title'           => 'Rekap Bulanan',
        'rekap_bulanan'   => $rekap_bulanan,
        'lokasi_presensi' => $lokasi_presensi,
        'bulan'           => $filter_bulan, 
        'tahun'           => $filter_tahun  
    ];

    return view('Admin/rekap_presensi/rekap_bulanan', $data);
}
}