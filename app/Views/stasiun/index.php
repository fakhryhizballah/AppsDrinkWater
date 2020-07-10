<?= $this->extend('layout/template'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <<div class="col">
            <table class="table">
                <?= $i = 1; ?>
                <?php foreach ($stasiun as $s) : ?>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Lokasi</th>
                            <th scope="col">ID Mesin</th>
                            <th scope="col">Status</th>
                            <th scope="col">Isi (L)</th>
                            <th scope="col">Indikator</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <th scope="row"><?= $i++; ?></th>
                            <td><?= $s['lokasi']; ?></td>
                            <td><?= $s['id mesin']; ?></td>
                            <td><?= $s['status']; ?></td>
                            <td><?= $s['isi']; ?></td>
                            <td><?= $s['indikator']; ?></td>
                            <td>
                                <a href="" class="btn btn-success">Anter</a>
                            </td>
                        </tr>

                    </tbody>
                <?php endforeach; ?>
            </table>
    </div>
</div>
</div>

<?= $this->endSection('content'); ?>