<div class="row">
    <div class="col-lg-6 fv-row">
        <select name="provinsi" aria-label="Select a Provinsi" data-control="select2" data-placeholder="Pilih Provinsi" class="form-select form-select-lg fw-semibold" id="provinsi_selector">
            <option value="">Pilih Provinsi</option>
            <?php
            foreach ($provinsi as $val) {
            ?>
                <option value="<?= $val['kode'] ?>"><?= $val['nama'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="col-lg-6 fv-row">
        <select name="kota" aria-label="Select a Kota" data-control="select2" data-placeholder="Pilih Kota" class="form-select form-select-lg fw-semibold" id="kota_selector">
            <option value="">Pilih Kota</option>
        </select>
    </div>
</div>

<div class="row mt-3">
    <div class="col-lg-6 fv-row">
        <select name="kecamatan" aria-label="Select a Kecamatan" data-control="select2" data-placeholder="Pilih Kecamatan" class="form-select form-select-lg fw-semibold" id="kecamatan_selector">
            <option value="">Pilih Kecamatan</option>
        </select>
    </div>

    <div class="col-lg-6 fv-row">
        <select name="kelurahan" aria-label="Select a Kelurahan" data-control="select2" data-placeholder="Pilih Kelurahan" class="form-select form-select-lg fw-semibold" id="kelurahan_selector">
            <option value="">Pilih Kelurahan</option>
        </select>
    </div>
</div>
