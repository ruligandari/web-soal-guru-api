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
        <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Content Column -->
        <div class="col-lg-12 mb-4">

            <!-- Project Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <span>Data Siswa</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTabelSoal" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Waktu Pengerjaan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($siswa as $data) : ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['nama_siswa'] ?></td>
                                        <td><?= $data['nilai'] ?></td>
                                        <td><?= $data['waktu_pengerjaan'] ?></td>
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

    <?= $this->endSection(); ?>

    <?= $this->section('script'); ?>

    <script>
        new DataTable('#dataTabelSoal', {
            layout: {
                topStart: {
                    buttons: ['excel', 'pdf', ],
                },
            },
            paging: false
        });
    </script>
    <?= $this->endSection(); ?>