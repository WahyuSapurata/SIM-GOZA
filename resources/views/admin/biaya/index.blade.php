@php
    $role = auth()->user()->role;
@endphp
@extends('layouts.layout')
@section('button')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <button class="btn btn-primary btn-sm " data-kt-drawer-show="true" data-kt-drawer-target="#side_form"
                id="button-side-form"><i class="fa fa-plus-circle" style="color:#ffffff" aria-hidden="true"></i> Tambah
                Data</button>
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
            <a href="#" data-type="excel" class="btn btn-sm btn-success export">Export Excel</a>
            <a href="#" data-type="pdf" class="btn btn-sm btn-danger export">Cetak Laporan</a>
        </div> --}}
        <!--end::Actions-->
    </div>
@endsection
@section('content')
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container">
            <div class="row">

                <div class="card">
                    <div class="card-body p-0">
                        <div class="container">
                            <div class="py-5 table-responsive">
                                <table id="kt_table_data"
                                    class="table table-striped table-rounded border border-gray-300 table-row-bordered table-row-gray-300">
                                    <thead class="text-center">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <th>No</th>
                                            <th>Nama Karyawan</th>
                                            <th>Jenis Pengeluaran</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        <!--end::Container-->
    </div>
@endsection
@section('side-form')
    <div id="side_form" class="bg-white" data-kt-drawer="true" data-kt-drawer-activate="true"
        data-kt-drawer-toggle="#side_form_button" data-kt-drawer-close="#side_form_close" data-kt-drawer-width="500px">
        <!--begin::Card-->
        <div class="card w-100">
            <!--begin::Card header-->
            <div class="card-header pe-5">
                <!--begin::Title-->
                <div class="card-title">
                    <!--begin::Biaya-->
                    <div class="d-flex justify-content-center flex-column me-3">
                        <a href="#"
                            class="fs-4 fw-bolder text-gray-900 text-hover-primary me-1 lh-1 title_side_form"></a>
                    </div>
                    <!--end::Biaya-->
                </div>
                <!--end::Title-->
                <!--begin::Card toolbar-->
                <div class="card-toolbar">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="side_form_close">
                        <!--begin::Svg Icon | path: icons/duotone/Navigation/Close.svg-->
                        <span class="svg-icon svg-icon-2">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g transform="translate(12.000000, 12.000000) rotate(-45.000000) translate(-12.000000, -12.000000) translate(4.000000, 4.000000)"
                                    fill="#000000">
                                    <rect fill="#000000" x="0" y="7" width="16" height="2" rx="1" />
                                    <rect fill="#000000" opacity="0.5"
                                        transform="translate(8.000000, 8.000000) rotate(-270.000000) translate(-8.000000, -8.000000)"
                                        x="0" y="7" width="16" height="2" rx="1" />
                                </g>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Card toolbar-->
            </div>
            <!--end::Card header-->
            <!--begin::Card body-->
            <div class="card-body hover-scroll-overlay-y">
                <form class="form-data" enctype="multipart/form-data">

                    <input type="hidden" name="id">
                    <input type="hidden" name="uuid">

                    <div id="ContainerAwal">
                        <div class="mb-10">
                            <label class="form-label">Jenis Pengeluaran</label>
                            <select name="pengeluaran[]" class="form-select" id="form-select" data-control="select2"
                                data-placeholder="Pilih jenis inputan">
                            </select>
                            <small class="text-danger pengeluaran_error"></small>
                        </div>

                        <div class="mb-10">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control" id="harga" name="harga[]">
                            <small class="text-danger harga_error"></small>
                        </div>

                        <div class="mb-10">
                            <button type="button" class="btn w-100 btn-primary tambahInputBtn">Tambah inputan</button>
                        </div>
                    </div>

                    <div id="Container">

                    </div>

                    <div class="separator separator-dashed mt-8 mb-5"></div>
                    <div class="d-flex gap-5">
                        <button type="submit" class="btn btn-primary btn-sm btn-submit d-flex align-items-center"><i
                                class="bi bi-file-earmark-diff"></i> Simpan</button>
                        <button type="reset" id="side_form_close"
                            class="btn mr-2 btn-light btn-cancel btn-sm d-flex align-items-center"
                            style="background-color: #ea443e65; color: #EA443E"><i class="bi bi-trash-fill"
                                style="color: #EA443E"></i>Batal</button>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
    </div>
@endsection
@section('script')
    <script>
        let control = new Control();

        let dataArray = [];
        var pengeluaranarray = [];

        $('#harga').on('input', function() {
            let value = $(this).val();
            if (value !== "") {
                value = numeral(value).format('0,0'); // Format to rupiah
                $(this).val('Rp ' + value);
            }
        });

        $(document).on('click', '#button-side-form', function() {
            control.overlay_form('Tambah', 'Biaya');
            hapusSemuaInputan();
            $("#ContainerAwal").html(containerAwalHTML);
        });

        const penjualan = [{
                text: "solar"
            },
            {
                text: "pengawas"
            },
            {
                text: "operator"
            },
            {
                text: "konsumsi"
            },
            {
                text: "dirut/taktis"
            },
            {
                text: "saringan"
            },
            {
                text: "oli"
            },
            {
                text: "material"
            },
            {
                text: "sewa alat"
            },
            {
                text: "izin"
            },
            {
                text: "lain - lain"
            },
        ];

        $(function() {
            control.push_select3(penjualan, '#form-select');
        });

        function tambahInput() {
            // Menentukan nomor urut untuk id unik
            var uniqueId = new Date().getTime();
            var newInput = `
                            <div class="mb-10">
                                <label class="form-label">Jenis Pengeluaran</label>
                                <div class="jenis-pengeluaran-container">
                                    <select name="pengeluaran[]" class="form-select" data-control="select2" data-placeholder="Pilih jenis inputan" id="form-select-${uniqueId}"></select>
                                    <input type="text" class="form-control keterangan-input-${uniqueId}" name="pengeluaran[]" style="display: none;" placeholder="Masukkan jenis pengeluaran">
                                </div>
                                <small class="text-danger pengeluaran_error"></small>
                            </div>

                            <div class="mb-10">
                                <label class="form-label">Harga</label>
                                <input type="text" class="form-control harga-input-${uniqueId}" name="harga[]">
                                <small class="text-danger harga_error"></small>
                            </div>

                            <div class="mb-10 d-flex gap-5">
                                <button type="button" class="btn btn-primary w-100 tambahInputBtn">Tambah inputan</button>
                                <button type="button" class="btn btn-danger w-100 hapusInputBtn">Hapus inputan</button>
                            </div>
                        `;

            // Tambahkan inputan baru ke dalam div "Container"
            $("#Container").append(newInput);

            $(function() {
                $(`#form-select-${uniqueId}`).html("");
                let html = "<option>Pilih jenis inputan</option>";
                $.each(penjualan, function(x, y) {
                    html += `<option value="${y.text}">${y.text}</option>`;
                });
                $(`#form-select-${uniqueId}`).html(html);

                // Tangani perubahan pada form select
                $(`#form-select-${uniqueId}`).on('change', function() {
                    // Jika yang dipilih adalah "lain - lain"
                    if ($(this).val().toLowerCase() === 'lain - lain') {
                        // Sembunyikan select dan tampilkan input teks keterangan
                        $(this).parent().find('select').hide();
                        $(this).parent().find('input').show();

                        // Tambahkan data inputan ke dalam array
                        var newInputData = {
                            jenis_pengeluaran: `.keterangan-input-${uniqueId}`,
                            harga: `.harga-input-${uniqueId}` // Gunakan id unik untuk identifikasi elemen harga
                        };

                        pengeluaranarray.push(newInputData);
                    } else {
                        // Jika yang dipilih bukan "lain - lain", tampilkan select dan sembunyikan input teks keterangan
                        $(this).parent().find('select').show();
                        $(this).parent().find('input').hide();

                        // Tambahkan data inputan ke dalam array
                        var newInputData = {
                            jenis_pengeluaran: `#form-select-${uniqueId}`,
                            harga: `.harga-input-${uniqueId}` // Gunakan id unik untuk identifikasi elemen harga
                        };

                        pengeluaranarray.push(newInputData);
                    }
                });

                // Tangani perubahan pada input harga
                $(`.harga-input-${uniqueId}`).on('input', function() {
                    let value = $(this).val();
                    if (value !== "") {
                        value = numeral(value).format('0,0'); // Format to rupiah
                        $(this).val('Rp ' + value);
                    }
                });
            });
        }

        // Tangani klik pada tombol "Tambah Inputan"
        $("#ContainerAwal").on("click", ".tambahInputBtn", function() {
            tambahInput();
        });

        $("#Container").on("click", ".tambahInputBtn", function() {
            tambahInput();
        });

        // Tangani klik pada tombol "Hapus Inputan"
        $("#Container").on("click", ".hapusInputBtn", function() {
            // Hapus elemen yang merupakan inputan terakhir
            $(this).parent().prev().prev().remove(); // Hapus elemen Jenis Pengeluaran
            $(this).parent().prev().remove(); // Hapus elemen Harga
            $(this).parent().remove(); // Hapus elemen tombol "Tambah" dan "Hapus"

            // Hapus data inputan terakhir dari array
            pengeluaranarray.pop();
        });

        $(document).on('submit', ".form-data", function(e) {
            e.preventDefault();
            let type = $(this).attr('data-type');

            if (type === 'add') {
                var dataInputan = [];

                var pengeluaran = {
                    jenis_pengeluaran: $('#form-select').val(),
                    harga: $('#harga').val().replace(/\D/g, ''),
                }
                dataInputan.push(pengeluaran)

                // Loop melalui array penjualanarray
                pengeluaranarray.forEach(function(inputData) {
                    // Hapus keterangan_pengeluaran jika tidak diperlukan
                    if (inputData.jenis_pengeluaran.endsWith('lain - lain')) {
                        delete inputData.keterangan_pengeluaran;
                    }

                    var nilaiInput = {
                        jenis_pengeluaran: $(inputData.jenis_pengeluaran).val(),
                        harga: $(inputData.harga).val().replace(/\D/g, ''),
                    };

                    // Tambahkan nilai input ke dalam array dataInputan
                    dataInputan.push(nilaiInput);
                });

                // Hasilnya berupa objek yang berisi nilai dari semua inputan
                var postData = {
                    pengeluaran: dataInputan
                };

                var formdata = JSON.stringify(postData)

                // Hasilnya berupa array dataInputan yang berisi nilai dari semua inputan
                control.submitForm('/admin/add-pengeluaran', 'Tambah',
                    'Biaya',
                    'POST', formdata);
                hapusSemuaInputan();
            } else {
                var dataInputanUpdate = [];
                console.log(pengeluaranarray);

                pengeluaranarray.forEach(function(inputData) {
                    // Hapus keterangan_pengeluaran jika tidak diperlukan
                    if (inputData.jenis_pengeluaran.endsWith('lain - lain')) {
                        delete inputData.keterangan_pengeluaran;
                    }

                    var nilaiInput = {
                        jenis_pengeluaran: $(inputData.jenis_pengeluaran).val(),
                        harga: $(inputData.harga).val().replace(/\D/g, ''),
                    };

                    // Tambahkan nilai input ke dalam array dataInputanUpdate
                    dataInputanUpdate.push(nilaiInput);
                });

                // Hasilnya berupa objek yang berisi nilai dari semua inputan
                var postDataUpdate = {
                    pengeluaran: dataInputanUpdate
                };

                var formdataUpdate = JSON.stringify(postDataUpdate)

                let uuid = $("input[name='uuid']").val();
                // Hasilnya berupa array dataInputanUpdate yang berisi nilai dari semua inputan
                control.submitForm('/admin/update-pengeluaran/' + uuid, 'Update',
                    'Biaya',
                    'POST', formdataUpdate);
                hapusSemuaInputan();
            }
        });

        // Variabel untuk menyimpan HTML Container sementara
        let containerAwalHTML;

        $(document).on('click', '.button-update', function(e) {
            e.preventDefault();
            let url = '/admin/show-pengeluaran/' + $(this).attr('data-uuid');
            $("input[name='uuid']").val($(this).attr('data-uuid'));
            $(".title_side_form").html(`Update Biaya`);
            $(".form-data").attr("data-type", "update");

            $.ajax({
                url: url,
                method: "GET",
                success: function(res) {
                    if (res.success == true) {
                        // Ambil semua data pengeluaran
                        let dataPengeluaran = res.data.pengeluaran;

                        // Simpan HTML awal sebelum dihapus
                        containerAwalHTML = $("#ContainerAwal").html();
                        // Kosongkan elemen Container sebelum menambahkan data baru
                        $("#ContainerAwal").empty();
                        $("#Container").empty();

                        // Loop untuk menangani semua data pengeluaran
                        dataPengeluaran.forEach(function(data, index) {
                            // HTML untuk setiap data pengeluaran
                            // Fungsi untuk membuat uniqueId dengan timestamp dan karakter acak
                            function generateUniqueId() {
                                const timestamp = new Date().getTime();
                                const randomChars = Math.random().toString(36).substring(2, 8);
                                return `input-${timestamp}-${randomChars}`;
                            }
                            // Gunakan generateUniqueId untuk mendapatkan uniqueId
                            var uniqueId = generateUniqueId();

                            var newInput = `
                                                <div class="mb-10">
                                                    <label class="form-label">Jenis Pengeluaran</label>
                                                    <div class="jenis-pengeluaran-container">
                                                        <select name="pengeluaran[]" class="form-select" data-control="select2" data-placeholder="Pilih jenis inputan" id="form-select-${uniqueId}">
                                                        </select>
                                                        <input type="text" class="form-control keterangan-input-${uniqueId}" name="pengeluaran[]" style="${data.jenis_pengeluaran ? 'display: none;' : ''}" placeholder="Masukkan jenis pengeluaran" value="${data.jenis_pengeluaran}">
                                                    </div>
                                                    <small class="text-danger pengeluaran_error"></small>
                                                </div>

                                                <div class="mb-10">
                                                    <label class="form-label">Harga</label>
                                                    <input type="text" class="form-control harga-input-${uniqueId}" name="harga[]" value="Rp ${numeral(data.harga).format('0,0')}">
                                                    <small class="text-danger harga_error"></small>
                                                </div>

                                                <div class="mb-10 d-flex gap-5">
                                                    <button type="button" class="btn btn-primary w-100 tambahInputBtn">Tambah inputan</button>
                                                    <button type="button" class="btn btn-danger w-100 hapusInputBtn">Hapus inputan</button>
                                                </div>
                                            `;

                            // Tambahkan HTML baru ke dalam elemen Container
                            $("#Container").append(newInput);

                            $(function() {
                                $(`#form-select-${uniqueId}`).html("");
                                let html =
                                    "<option value=''>Pilih jenis inputan</option>";

                                $.each(penjualan, function(x, y) {
                                    // Tambahkan kondisi untuk menandai opsi yang dipilih
                                    if (y.text == data.jenis_pengeluaran) {
                                        html +=
                                            `<option value="${y.text}" selected>${y.text}</option>`;
                                    } else {
                                        html +=
                                            `<option value="${y.text}">${y.text}</option>`;
                                    }
                                });

                                $(`#form-select-${uniqueId}`).html(html);

                                // Tangani perubahan pada form select
                                $(`#form-select-${uniqueId}`).on('change', function() {
                                    // Jika yang dipilih adalah "lain - lain"
                                    if ($(this).val().toLowerCase() ===
                                        'lain - lain') {
                                        // Sembunyikan select dan tampilkan input teks keterangan
                                        $(this).parent().find('select').hide();
                                        $(this).parent().find('input').show();
                                    } else {
                                        // Jika yang dipilih bukan "lain - lain", tampilkan select dan sembunyikan input teks keterangan
                                        $(this).parent().find('select').show();
                                        $(this).parent().find('input').hide();
                                    }
                                });

                                // Tambahkan kondisi untuk menetapkan input sebagai type text jika tidak sesuai dengan data pengeluaran
                                if (!penjualan.find(option => option.text === data
                                        .jenis_pengeluaran)) {
                                    $(`#form-select-${uniqueId}`).parent().find(
                                        'select').hide();
                                    $(`#form-select-${uniqueId}`).parent().find('input')
                                        .show().val(data.jenis_pengeluaran);

                                    // Tambahkan data inputan ke dalam array
                                    var newInputData = {
                                        jenis_pengeluaran: `.keterangan-input-${uniqueId}`,
                                        harga: `.harga-input-${uniqueId}` // Gunakan id unik untuk identifikasi elemen harga
                                    };
                                } else {
                                    // Tambahkan data inputan ke dalam array
                                    var newInputData = {
                                        jenis_pengeluaran: `#form-select-${uniqueId}`,
                                        harga: `.harga-input-${uniqueId}` // Gunakan id unik untuk identifikasi elemen harga
                                    };
                                }

                                pengeluaranarray.push(newInputData);

                                // Tangani perubahan pada input harga
                                $(`.harga-input-${uniqueId}`).on('input', function() {
                                    let value = $(this).val();
                                    if (value !== "") {
                                        value = numeral(value).format(
                                            '0,0'); // Format to rupiah
                                        $(this).val('Rp ' + value);
                                    }
                                });
                            });
                        });
                    }
                },
                error: function(xhr) {
                    alert("gagal");
                },
            });
        });

        // Fungsi untuk menghapus semua inputan
        function hapusSemuaInputan() {
            // Hapus semua elemen input di dalam Container
            $("#Container").empty();

            // Kosongkan array pengeluaranarray
            pengeluaranarray = [];
        }


        $(document).on('click', '.button-delete', function(e) {
            e.preventDefault();
            let url = '/admin/delete-pengeluaran/' + $(this).attr('data-uuid');
            let label = $(this).attr('data-label');
            control.ajaxDelete(url, label)
        })

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        })

        let columns = [{
            data: null,
            className: 'text-center',
            render: function(data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        }, {
            data: 'user',
            className: 'text-center',
        }, {
            data: null,
            render: function(data, type, row, meta) {
                let pengeluaranHTML = '<ul>';
                $.each(row.pengeluaran, function(x, y) {
                    pengeluaranHTML += `<li>${y.jenis_pengeluaran}</li>`;
                });
                pengeluaranHTML += '</ul>';
                return pengeluaranHTML;
            }
        }, {
            data: null,
            render: function(data, type, row, meta) {
                let pengeluaranHTML = '<ul>';
                $.each(row.pengeluaran, function(x, y) {
                    pengeluaranHTML += `<li>Rp ${numeral(y.harga).format(
                        '0,0')}</li>`;
                });
                pengeluaranHTML += '</ul>';
                return pengeluaranHTML;
            }
        }, {
            data: 'uuid',
        }];
        let columnDefs = [{
            targets: -1,
            title: 'Aksi',
            width: '8rem',
            orderable: false,
            render: function(data, type, full, meta) {
                return `
            <a href="javascript:;" type="button" data-uuid="${data}" data-kt-drawer-show="true" data-kt-drawer-target="#side_form" class="btn btn-primary button-update btn-icon btn-sm">

            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M3.5 16.2738C3.5 17.8891 4.80945 19.1986 6.42474 19.1986H10.8479L11.1681 17.9178C11.3139 17.3347 11.6155 16.8022 12.0405 16.3771L17.3522 11.0655C17.9947 10.423 18.8591 10.138 19.6986 10.2103V5.92474C19.6986 4.30945 18.3891 3 16.7738 3H10.6994V7.27463C10.6994 8.88992 9.38992 10.1994 7.77463 10.1994H3.5V16.2738ZM9.34949 3.39597L3.89597 8.84949H7.77463C8.6444 8.84949 9.34949 8.1444 9.34949 7.27463V3.39597ZM17.9886 11.7018L12.6769 17.0135C12.3672 17.3231 12.1475 17.7112 12.0412 18.1361L11.6293 19.7836C11.4503 20.5 12.0993 21.1491 12.8157 20.9699L14.4632 20.558C14.8881 20.4518 15.2761 20.2321 15.5859 19.9224L20.8975 14.6107C21.7008 13.8074 21.7008 12.5051 20.8975 11.7018C20.0943 10.8984 18.7919 10.8984 17.9886 11.7018Z" fill="white"/>
            <mask id="mask0_1953_23043" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="3" width="19" height="18">
            <path d="M3.5 16.2738C3.5 17.8891 4.80945 19.1986 6.42474 19.1986H10.8479L11.1681 17.9178C11.3139 17.3347 11.6155 16.8022 12.0405 16.3771L17.3522 11.0655C17.9947 10.423 18.8591 10.138 19.6986 10.2103V5.92474C19.6986 4.30945 18.3891 3 16.7738 3H10.6994V7.27463C10.6994 8.88992 9.38992 10.1994 7.77463 10.1994H3.5V16.2738ZM9.34949 3.39597L3.89597 8.84949H7.77463C8.6444 8.84949 9.34949 8.1444 9.34949 7.27463V3.39597ZM17.9886 11.7018L12.6769 17.0135C12.3672 17.3231 12.1475 17.7112 12.0412 18.1361L11.6293 19.7836C11.4503 20.5 12.0993 21.1491 12.8157 20.9699L14.4632 20.558C14.8881 20.4518 15.2761 20.2321 15.5859 19.9224L20.8975 14.6107C21.7008 13.8074 21.7008 12.5051 20.8975 11.7018C20.0943 10.8984 18.7919 10.8984 17.9886 11.7018Z" fill="white"/>
            </mask>
            <g mask="url(#mask0_1953_23043)">
            <rect x="0.5" width="24" height="24" fill="white"/>
            </g>
            </svg>


            </a>

            <a href="javascript:;" type="button" data-uuid="${data}" data-label="Biaya" class="btn btn-danger button-delete btn-icon btn-sm ${full.role === "{{ $role }}" ? 'disabled-link' : ''}">

                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.78571 3H20.2143C20.9244 3 21.5 3.58547 21.5 4.30769V4.96154C21.5 5.68376 20.9244 6.26923 20.2143 6.26923H4.78571C4.07563 6.26923 3.5 5.68376 3.5 4.96154V4.30769C3.5 3.58547 4.07563 3 4.78571 3ZM5.07475 7.60448C5.11609 7.58598 5.16081 7.57654 5.20598 7.57679H19.792C19.8372 7.57654 19.8819 7.58598 19.9232 7.60448C19.9646 7.62299 20.0016 7.65016 20.0319 7.6842C20.0623 7.71825 20.0852 7.75842 20.0992 7.80208C20.1133 7.84575 20.1181 7.89193 20.1134 7.93763L19.0579 18.259V18.2676C19.0027 18.7448 18.7772 19.1848 18.4241 19.5041C18.0711 19.8235 17.6151 19.9999 17.1426 19.9999H7.85776C7.38517 20.0001 6.92897 19.8237 6.57575 19.5044C6.22252 19.1851 5.99688 18.745 5.94165 18.2676C5.94143 18.2646 5.94143 18.2616 5.94165 18.2586L4.88455 7.93763C4.87986 7.89193 4.8847 7.84575 4.89874 7.80208C4.91278 7.75842 4.93571 7.71825 4.96604 7.6842C4.99637 7.65016 5.03341 7.62299 5.07475 7.60448ZM15.3481 15.173C15.3146 15.0933 15.2659 15.0211 15.2048 14.9608L13.4092 13.1345L15.2048 11.3082C15.3224 11.185 15.3877 11.0196 15.3864 10.8479C15.3851 10.6761 15.3175 10.5118 15.198 10.3903C15.0786 10.2689 14.917 10.2002 14.7481 10.1989C14.5792 10.1977 14.4167 10.2641 14.2956 10.3838L12.5004 12.2097L10.7048 10.3838C10.5837 10.2641 10.4211 10.1977 10.2523 10.1989C10.0834 10.2002 9.9218 10.2689 9.80237 10.3903C9.68293 10.5118 9.61527 10.6761 9.614 10.8479C9.61273 11.0196 9.67795 11.185 9.79557 11.3082L11.5912 13.1345L9.79557 14.9608C9.67795 15.084 9.61273 15.2494 9.614 15.4211C9.61527 15.5929 9.68293 15.7572 9.80237 15.8786C9.9218 16 10.0834 16.0688 10.2523 16.07C10.4211 16.0712 10.5837 16.0048 10.7048 15.8851L12.5004 14.0593L14.2956 15.8851C14.3549 15.9473 14.4258 15.9969 14.5042 16.0309C14.5826 16.065 14.6668 16.0829 14.752 16.0835C14.8372 16.0842 14.9217 16.0676 15.0005 16.0347C15.0794 16.0019 15.151 15.9534 15.2113 15.8921C15.2716 15.8309 15.3193 15.758 15.3516 15.6778C15.3839 15.5977 15.4003 15.5117 15.3997 15.4251C15.3991 15.3384 15.3815 15.2527 15.3481 15.173Z" fill="white"/>
                <mask id="mask0_1953_23051" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="3" y="3" width="19" height="17">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M4.78571 3H20.2143C20.9244 3 21.5 3.58547 21.5 4.30769V4.96154C21.5 5.68376 20.9244 6.26923 20.2143 6.26923H4.78571C4.07563 6.26923 3.5 5.68376 3.5 4.96154V4.30769C3.5 3.58547 4.07563 3 4.78571 3ZM5.07475 7.60448C5.11609 7.58598 5.16081 7.57654 5.20598 7.57679H19.792C19.8372 7.57654 19.8819 7.58598 19.9232 7.60448C19.9646 7.62299 20.0016 7.65016 20.0319 7.6842C20.0623 7.71825 20.0852 7.75842 20.0992 7.80208C20.1133 7.84575 20.1181 7.89193 20.1134 7.93763L19.0579 18.259V18.2676C19.0027 18.7448 18.7772 19.1848 18.4241 19.5041C18.0711 19.8235 17.6151 19.9999 17.1426 19.9999H7.85776C7.38517 20.0001 6.92897 19.8237 6.57575 19.5044C6.22252 19.1851 5.99688 18.745 5.94165 18.2676C5.94143 18.2646 5.94143 18.2616 5.94165 18.2586L4.88455 7.93763C4.87986 7.89193 4.8847 7.84575 4.89874 7.80208C4.91278 7.75842 4.93571 7.71825 4.96604 7.6842C4.99637 7.65016 5.03341 7.62299 5.07475 7.60448ZM15.3481 15.173C15.3146 15.0933 15.2659 15.0211 15.2048 14.9608L13.4092 13.1345L15.2048 11.3082C15.3224 11.185 15.3877 11.0196 15.3864 10.8479C15.3851 10.6761 15.3175 10.5118 15.198 10.3903C15.0786 10.2689 14.917 10.2002 14.7481 10.1989C14.5792 10.1977 14.4167 10.2641 14.2956 10.3838L12.5004 12.2097L10.7048 10.3838C10.5837 10.2641 10.4211 10.1977 10.2523 10.1989C10.0834 10.2002 9.9218 10.2689 9.80237 10.3903C9.68293 10.5118 9.61527 10.6761 9.614 10.8479C9.61273 11.0196 9.67795 11.185 9.79557 11.3082L11.5912 13.1345L9.79557 14.9608C9.67795 15.084 9.61273 15.2494 9.614 15.4211C9.61527 15.5929 9.68293 15.7572 9.80237 15.8786C9.9218 16 10.0834 16.0688 10.2523 16.07C10.4211 16.0712 10.5837 16.0048 10.7048 15.8851L12.5004 14.0593L14.2956 15.8851C14.3549 15.9473 14.4258 15.9969 14.5042 16.0309C14.5826 16.065 14.6668 16.0829 14.752 16.0835C14.8372 16.0842 14.9217 16.0676 15.0005 16.0347C15.0794 16.0019 15.151 15.9534 15.2113 15.8921C15.2716 15.8309 15.3193 15.758 15.3516 15.6778C15.3839 15.5977 15.4003 15.5117 15.3997 15.4251C15.3991 15.3384 15.3815 15.2527 15.3481 15.173Z" fill="white"/>
                </mask>
                <g mask="url(#mask0_1953_23051)">
                <rect x="0.5" width="24" height="24" fill="white"/>
                </g>
                </svg>

            </a>


            `;
            },
        }];

        $(function() {
            control.initDatatable('/admin/get-pengeluaran', columns, columnDefs);
        })
    </script>
@endsection