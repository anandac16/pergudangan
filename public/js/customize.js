
    function Deletefunction(id) {
        var txt;
        var r = confirm("Apakah anda yakin ingin menghapus data barang\ndengan id: " + id + "?");
        if (r == true) {
            window.location.href = "index/hapus/id/" + id;
        }
        document.getElementById("demo").innerHTML = txt;
    }

    function Barangkeluar(id) {
        var txt;
        var r = confirm("Apakah anda yakin barang \ndengan id: " + id + " sudah keluar dari gudang ?");
        if (r == true) {
            window.location.href = "index/editable/type/tglout/id/" + id;
        }
    }

    function someFunc() {

        $('#dtable').load("index");

    }


    $(document).ready(function() {
        $('.btn-danger').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apa kamu yakin ingin menghapus barang dengan id " + id + " dari gudang ?")) {
                $.ajax({
                    type: "POST",
                    url: "index/hapus",
                    data: ({
                        id: id
                    }),
                    cache: false,
                    success: function(html) {
                        $("#list-barang" + id).fadeOut('slow');
                    }
                });
            } else {
                return false;
            }
        });

        $('.btn-success').click(function() {
            var id = $(this).attr("id");
            if (confirm("Apa kamu yakin barang dengan id " + id + " sudah keluar dari gudang ?")) {
                $.ajax({
                    type: "GET",
                    url: "index/editable/type/tglout/id/" + id,
                    cache: false,
                    success: function(html) {
                        //var initialbutton = $('.btn-success '+id);
                        $('.btn' + id).remove(":contains('Tandai keluar')");
                        $('#td' + id).append('<div class="btn btn-warning disabled">Sudah Keluar</div>');
                    }
                });
            } else {
                return false;
            }
        });

        $('#tambahmodal').click(function() {
            $('#myModal').modal();
        });

        $("#tambahkan").click(function() {
            var data = $('#barang').serialize();
            $.ajax({
                type: 'POST',
                url: "index/tambah",
                data: data,
                success: function() {
                    reset();
                    alertify.log("Berhasil menambahkan data");
                    someFunc();
                    $('#myModal').modal('hide');
                    $('div').removeClass('modal-backdrop fade in');
                    return false;
                }
            });
        });

    });


    $(document).ready(function() {
        $(".jedit_kodebrg").editable("index/editable/type/kodebrg", {
            submit: "OK"
        });
        $(".jedit_namabrg").editable("index/editable/type/namabrg", {
            submit: "OK"
        });
        $(".jedit_qty").editable("index/editable/type/qty", {
            submit: "OK"
        });
        $(".jedit_harga").editable("index/editable/type/harga", {
            submit: "OK"
        });
        $(".jedit_kodegd").editable("index/editable/type/kodegd", {
            submit: "OK"
        });

        $(".jedit_satuan").editable("index/editable/type/satuan", {
            type: 'select',
            data: "{'kg':'kg','liter':'liter','buah':'buah'}",
            callback: function(value, settings) {
                $(this).html(jQuery.parseJSON(settings.data)[value]);
            },
            submit: 'OK'
        });
    });
