<?php

namespace App\Models;

use CodeIgniter\Model;

class PresensiModel extends Model
{
    protected $table            = 'presensi';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['id_pegawai', 'tanggal_masuk', 'jam_masuk', 'foto_masuk', 'tanggal_keluar', 'jam_keluar', 'foto_keluar'];

    public function rekap_harian()
    {
        return $this->db->table('presensi')
            ->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor')
            ->join('pegawai', 'pegawai.id = presensi.id_pegawai')
            ->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi')
            ->where('presensi.tanggal_masuk', date('Y-m-d'))
            ->get()->getResultArray();
    }

    public function rekap_harian_filter($tanggal)
    {
        return $this->db->table('presensi')
            ->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor')
            ->join('pegawai', 'pegawai.id = presensi.id_pegawai')
            ->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi')
            ->where('presensi.tanggal_masuk', $tanggal)
            ->get()->getResultArray();
    }

    public function rekap_bulanan($filter_bulan = null, $filter_tahun = null)
    {
        $bulan = $filter_bulan ?: date('m');
        $tahun = $filter_tahun ?: date('Y');

        return $this->db->table('presensi')
            ->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor')
            ->join('pegawai', 'pegawai.id = presensi.id_pegawai')
            ->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi')
            ->where('MONTH(tanggal_masuk)', $filter_bulan)
            ->where('YEAR(tanggal_masuk)', $filter_tahun)
            ->get()->getResultArray();
    }

    public function rekap_bulanan_filter($filter_bulan, $filter_tahun)
    {
        return $this->rekap_bulanan($filter_bulan, $filter_tahun);
    }

    public function rekap_presensi_pegawai()
    {
        $id_pegawai = session()->get('id_pegawai');
        $db      = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('id_pegawai', $id_pegawai);
        return $builder->get()->getResultArray();
    }

    public function rekap_presensi_pegawai_filter($filter_tanggal)
    {
        $id_pegawai = session()->get('id_pegawai');
        $db      = \Config\Database::connect();
        $builder = $db->table('presensi');
        $builder->select('presensi.*, pegawai.nama, lokasi_presensi.jam_masuk as jam_masuk_kantor');
        $builder->join('pegawai', 'pegawai.id = presensi.id_pegawai');
        $builder->join('lokasi_presensi', 'lokasi_presensi.id = pegawai.lokasi_presensi');
        $builder->where('id_pegawai', $id_pegawai);
        $builder->where('tanggal_masuk', $filter_tanggal);
        return $builder->get()->getResultArray();
    }
}