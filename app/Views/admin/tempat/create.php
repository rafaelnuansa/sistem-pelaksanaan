<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Tambah Tempat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <form action="<?= route_to('admin.tempat.store');?>" method="post">
                    <div class="form-group">
                        <label for="nama_tempat">Nama Tempat</label>
                        <input type="text" name="nama_tempat" id="nama_tempat" class="form-control">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->

<?= $this->endSection(); ?>