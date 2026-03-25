<?= $this->extend('admin/layout.php') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-dark fw-bold">Data Pegawai</h4>
        <a href="<?= base_url('Admin/data_pegawai/create') ?>" class="btn btn-primary shadow-sm d-flex align-items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="currentColor">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4.929 4.929a10 10 0 1 1 14.141 14.141a10 10 0 0 1 -14.14 -14.14m8.071 4.071a1 1 0 1 0 -2 0v2h-2a1 1 0 1 0 0 2h2v2a1 1 0 1 0 2 0v-2h2a1 1 0 1 0 0 -2h-2v-2z" />
            </svg>
            Tambah Pegawai
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0"> <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="Table">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>NIP</th>
                            <th>Nama Pegawai</th>
                            <th>Jabatan</th>
                            <th>Lokasi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($pegawai as $peg) : ?>    
                        <tr>
                            <td class="ps-4"><?= $no++ ?></td>
                            <td><span class="badge bg-light text-dark border"><?= $peg['nip'] ?></span></td>
                            <td class="fw-bold text-dark"><?= $peg['nama'] ?></td>
                            <td><?= $peg['jabatan'] ?></td>
                            <td>
                                <small class="text-muted"><i class="bi bi-geo-alt"></i> <?= $peg['lokasi_presensi'] ?></small>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-1">
                                    <a href="<?= base_url('Admin/data_pegawai/detail/' . $peg['id']) ?>" 
                                       class="btn btn-sm btn-info text-white" title="Detail">
                                       Detail
                                    </a>
                                    
                                    <a href="<?= base_url('Admin/data_pegawai/edit/' . $peg['id']) ?>" 
                                       class="btn btn-sm btn-warning text-white" title="Edit">
                                       Edit
                                    </a>

                                    <a href="<?= base_url('Admin/data_pegawai/delete/' . $peg['id']) ?>" 
                                       class="btn btn-sm btn-danger tombol-hapus" 
                                       onclick="return confirm('Yakin ingin menghapus data <?= $peg['nama'] ?>?')" title="Hapus">
                                       Hapus
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody> 
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>