<?= $this->extend('layouts/default'); ?>

<?= $this->section('content'); ?>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <h3 class="box-title">Form Edit Tempat</h3>
                </div>
                <!-- /.box-header -->
                <!-- form start -->
                <form role="form" action="<?= route_to('admin.tempat.update', $tempat['id_tempat']); ?>" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_tempat">Nama Tempat</label>
                            <input type="text" name="nama_tempat" id="nama_tempat" class="form-control" value="<?= $tempat['nama_tempat']; ?>">
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->

<?= $this->endSection(); ?>