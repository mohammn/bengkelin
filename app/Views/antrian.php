<?php $this->extend('template') ?>

<?php $this->section('content') ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Tambah Antrian</h4>
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Plat Nomor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="platNomor" name="platNomor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-2 col-form-label">Nama Motor</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>
                </form>
                <div class="form-group row">
                    <div class="col-sm-12 text-center">
                        <button class="btn btn-info" onclick="tambah()" id="tambah">Daftar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Daftar Antrian</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead class=" text-info">
                        <th>
                            ID
                        </th>
                        <th>
                            Plat Nomor
                        </th>
                        <th>
                            Nama
                        </th>
                        <th>
                            Bayar
                        </th>
                    </thead>
                    <tbody id="tabelAntrian">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade mbd-example-modal-lg" id="modalBayar" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bayar</h5>
            </div>
            <div class="modal-body">
                <input type="hidden" value="" id="idAntrian" name="idHapus">
                <p>Pilih jasa yang telah dilakukan untuk motor <b id="detailBayar">....</b>.</p>
                <h5>Total Biaya : <b id="totalHarga">Rp. 0</b></h5>
                <hr>
                <div id="tempatJasa">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="bayar" onclick="prosesPembayaran()" class="btn btn-info" disabled>Bayar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
            </div>
        </div>
    </div>
</div>

<script>
    muatData()
    tampilkanJasa()

    function muatData() {
        $("#tambah").html('<i class="fa fa-spinner fa-pulse"></i> Memproses...')
        $.ajax({
            url: '<?= base_url() ?>/antrian/muatData',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                var tabel = ''
                for (let i = 0; i < data.length; i++) {
                    tabel += "<tr><td>" + data[i].id + "</td><td>" + data[i].platNomor + "</td><td>" + data[i].namaMotor + "</td><td><button id='bayar" + data[i].id + "' class='badge badge-info p-2' onclick='tryBayar(" + data[i].id + ", \"" + data[i].platNomor + "\", \"" + data[i].namaMotor + "\")'><i class='fa fa-dollar'></i></button></td></tr>"

                }
                if (!tabel) {
                    tabel = '<td class="text-center" colspan="4">Antrian Masih kosong :)</td>'
                }
                $("#tabelAntrian").html(tabel)

                $("#tambah").html('Daftar')
            }
        });
    }

    function tambah() {
        if ($("#platNomor").val() == "") {
            $("#platNomor").focus();
        } else if ($("#nama").val() == "") {
            $("#nama").focus();
        } else {
            $.ajax({
                type: 'POST',
                data: 'platNomor=' + $("#platNomor").val() + '&nama=' + $("#nama").val(),
                url: '<?= base_url() ?>/antrian/tambah',
                dataType: 'json',
                success: function(data) {
                    $("#platNomor").val("");
                    $("#nama").val("");
                    muatData();
                }
            });
        }
    }

    var tindakanTerpilih = [];
    var hargaTerpilih = [];

    var indeksTindakan = 0;
    var indeksHarga = 0;
    var totalHarga = 0;

    function tryBayar(id, nama, netto) {
        $("#bayar" + id).html('<i class="fa fa-spinner fa-pulse"></i>')
        $("#idAntrian").val(id)
        $("#detailBayar").html(nama + " (" + netto + ") ")
        $("#bayar" + id).html('<i class="fa fa-dollar"></i>')
        $("#modalBayar").modal('show')


        $("#totalHarga").html("Rp. 0");
        for (let i = 0; i < tindakanTerpilih.length; i++) {
            $("#jasa" + tindakanTerpilih[i]).removeClass("btn-info")
            $("#jasa" + tindakanTerpilih[i]).addClass("btn-outline-info")
        }

        $("#bayar").html('Bayar')
        indeksHarga = 0;
        indeksTindakan = 0;
        totalHarga = 0;

        tindakanTerpilih = [];
        hargaTerpilih = [];
        aktifkanTombolBayar();
    }

    function tampilkanJasa() {
        $("#tempatJasa").html('<i class="fa fa-spinner fa-pulse"></i> Memuat...')
        var baris = ''
        baris += '<div class="row pt-4">'
        $.ajax({
            url: '<?= base_url() ?>/jasa/muatData',
            method: 'post',
            dataType: 'json',
            success: function(data) {
                for (let i = 0; i < data.length; i++) {
                    baris += '<div class="col-xl-3 col-md-3 col-sm-4 pt-2"><button onClick="updateHarga(' + data[i].id + ',' + data[i].biaya + ')" class="btn btn-outline-info" id="jasa' + data[i].id + '">' + data[i].nama + ' (Rp. ' + formatRupiah(data[i].biaya.toString()) + ') </button></div>'
                }
                baris += '</div>'
                $("#tempatJasa").html(baris);
            }
        });
    }

    function updateHarga(id, harga) {
        if ($("#jasa" + id).hasClass("btn-outline-info")) {
            $("#jasa" + id).removeClass("btn-outline-info")
            $("#jasa" + id).addClass("btn-info")
            tindakanTerpilih.push(id)
            hargaTerpilih.push(harga)
        } else {
            $("#jasa" + id).removeClass("btn-info")
            $("#jasa" + id).addClass("btn-outline-info")
            indeksTindakan = tindakanTerpilih.indexOf(id);
            tindakanTerpilih.splice(indeksTindakan, 1);
            indeksHarga = hargaTerpilih.indexOf(harga);
            hargaTerpilih.splice(indeksHarga, 1);
        }

        indeksHarga = 0;
        indeksTindakan = 0;
        totalHarga = 0;

        for (let i = 0; i < hargaTerpilih.length; i++) {
            totalHarga += hargaTerpilih[i];
        }
        $("#totalHarga").html("Rp. " + formatRupiah(totalHarga.toString()));
        aktifkanTombolBayar();
    }

    function aktifkanTombolBayar() {
        if (tindakanTerpilih.length) {
            $("#bayar").prop('disabled', false);
        } else {
            $("#bayar").prop('disabled', true);
        }
    }

    function prosesPembayaran() {
        $("#bayar").html('<i class="fa fa-spinner fa-pulse"></i> Memproses..')
        $("#bayar").prop('disabled', true);
        var idAntrian = $("#idAntrian").val()
        $.ajax({
            url: '<?= base_url() ?>/antrian/prosesPembayaran',
            method: 'post',
            data: {
                "idTindakan": tindakanTerpilih,
                "idAntrian": idAntrian
            },
            dataType: 'json',
            success: function(data) {
                console.log(data)
                $("#modalBayar").modal('hide')
                muatData()
            }
        });
    }

    function formatRupiah(angka, prefix) {
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>
<?php $this->endSection() ?>