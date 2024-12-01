<?= $this->extend('template'); ?>
<?= $this->section('content'); ?>

<?php if (session()->getFlashdata('success')) : ?>
    <script>
        Swal.fire({
            title: "Berhasil!",
            text: "<?= session()->getFlashdata('success') ?>",
            icon: "success"
        });
    </script>
<?php endif ?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Data Soal</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#tambahModal">+ Tambah Data Soal</button>
                    <div class="col mt-2 d-flex justify-content-end">
                        <form action="<?= base_url('admin/pengaturan') ?>" method="POST">
                            <div class="form-inline">
                                <label for="">
                                    Jumlah Soal Tampil:
                                </label>
                                <input type="text" value="<?= $jumlah_soal ?>" class="form-control mx-sm-3" name="jumlah_soal">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Soal</th>
                                    <th>Pilihan A</th>
                                    <th>Pilihan B</th>
                                    <th>Pilihan C</th>
                                    <th>Pilihan D</th>
                                    <th>Jawaban</th>
                                    <th>Bobot Nilai</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($soal as $data) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['soal'] ?></td>
                                        <td><?= $data['pilihan_a'] ?></td>
                                        <td><?= $data['pilihan_b'] ?></td>
                                        <td><?= $data['pilihan_c'] ?></td>
                                        <td><?= $data['pilihan_d'] ?></td>
                                        <td><?= $data['jawaban'] ?></td>
                                        <td><?= $data['bobot_nilai'] ?></td>
                                        <td>
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal<?= $data['id'] ?>">Edit</button>
                                            <button class="btn btn-danger" onclick="deleteSoal(<?= $data['id'] ?>)">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="tambahModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Soal</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- form tambah soal -->
                    <form action="<?= base_url('admin/soal/store') ?>" method="POST">
                        <div class="form-group">
                            <label for="soal">Soal</label>
                            <input type="text" class="form-control" placeholder="Masukan Soal" name="soal">
                        </div>
                        <div class="form-group">
                            <label for="soal">Pilihan A</label>
                            <input type="text" class="form-control" placeholder="Masukan Piilihan A" name="pilihan_a">
                        </div>
                        <div class="form-group">
                            <label for="soal">Pilihan B</label>
                            <input type="text" class="form-control" placeholder="Masukan Pilihan B" name="pilihan_b">
                        </div>
                        <div class="form-group">
                            <label for="soal">Pilihan C</label>
                            <input type="text" class="form-control" placeholder="Masukan Pilihan C" name="pilihan_c">
                        </div>
                        <div class="form-group">
                            <label for="soal">Pilihan D</label>
                            <input type="text" class="form-control" placeholder="Masukan Pilihan D" name="pilihan_d">
                        </div>
                        <div class="form-group">
                            <label for="soal">Jawaban</label>
                            <input type="text" class="form-control" placeholder="Masukan Jawaban" name="jawaban">
                        </div>
                        <div class="form-group">
                            <label for="soal">Bobot Nilai</label>
                            <input type="text" class="form-control" placeholder="Masukan Bobot Nilai" name="bobot_nilai">
                        </div>

                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal-->
    <?php foreach ($soal as $s) : ?>
        <div class="modal fade" id="editModal<?= $s['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Soal</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- form tambah soal -->
                        <form action="<?= base_url('admin/soal/update/' . $s['id']) ?>" method="POST">
                            <div class="form-group">
                                <label for="soal">Soal</label>
                                <input type="text" class="form-control" value="<?= $s['soal'] ?>" name="soal">
                            </div>
                            <div class="form-group">
                                <label for="soal">Pilihan A</label>
                                <input type="text" class="form-control" value="<?= $s['pilihan_a'] ?>" name="pilihan_a">
                            </div>
                            <div class="form-group">
                                <label for="soal">Pilihan B</label>
                                <input type="text" class="form-control" value="<?= $s['pilihan_b'] ?>" name="pilihan_b">
                            </div>
                            <div class="form-group">
                                <label for="soal">Pilihan C</label>
                                <input type="text" class="form-control" value="<?= $s['pilihan_c'] ?>" name="pilihan_c">
                            </div>
                            <div class="form-group">
                                <label for="soal">Pilihan D</label>
                                <input type="text" class="form-control" value="<?= $s['pilihan_d'] ?>" name="pilihan_d">
                            </div>
                            <div class="form-group">
                                <label for="soal">Jawaban</label>
                                <input type="text" class="form-control" value="<?= $s['jawaban'] ?>" name="jawaban">
                            </div>
                            <div class="form-group">
                                <label for="soal">Bobot Nilai</label>
                                <input type="text" class="form-control" value="<?= $s['bobot_nilai'] ?>" name="bobot_nilai">
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>

    <script>
        function deleteSoal(id) {
            Swal.fire({
                title: 'Apakah Anda yakin akan menghapus data ini?',
                text: "Data yang sudah dihapus tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = "<?= base_url('admin/soal/delete/') ?>" + id;
                }
            })

        }
    </script>
    <?= $this->endSection(); ?>