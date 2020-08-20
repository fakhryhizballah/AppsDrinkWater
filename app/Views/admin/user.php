<?= $this->extend('layout/admin_template'); ?>
<?= $this->section('admcontent'); ?>

<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <table class="table bg-white">
        <thead>
            <tr style="text-align: center;">
                <th scope="col">No</th>
                <th scope="col">ID User</th>
                <th scope="col">Nama</th>
                <th scope="col">Email</th>
                <th scope="col">No Telp</th>
                <th scope="col">Jumlah Debit</th>
                <th scope="col">Jumlah Kredit</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            <?php $i = 1; ?>
            <?php foreach ($user as $usr) : ?>
                <tr>
                    <th scope="row"><?= $i; ?></th>
                    <td><?= $usr['id_user']; ?></td>
                    <td><?= $usr['nama']; ?></td>
                    <td><?= $usr['email']; ?></td>
                    <td><?= $usr['telp']; ?></td>
                    <td><?= $usr['debit']; ?></td>
                    <td><?= $usr['kredit']; ?></td>
                </tr>
                <?php $i++;  ?>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?= $this->endSection('admcontent'); ?>