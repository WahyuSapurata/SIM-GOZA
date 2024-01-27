@php
    $role = auth()->user()->role;
@endphp
@extends('layouts.layout')
@section('button')
    <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack gap-2">
        <!--begin::Page title-->
        <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
            data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
            class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
            <!--begin::Title-->
            <input type="text" id="tanggal" class="form-control kt_datepicker_7" name="tanggal"
                placeholder="Filer Tanggal">
            <!--end::Title-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <button type="button" id="export-excel" class="btn btn-sm btn-success d-flex align-items-center gap-1">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M9.14933 1.3335H4.44445C3.97295 1.3335 3.52076 1.50909 3.18737 1.82165C2.85397 2.13421 2.66667 2.55814 2.66667 3.00016V13.0002C2.66667 13.4422 2.85397 13.8661 3.18737 14.1787C3.52076 14.4912 3.97295 14.6668 4.44445 14.6668H11.5556C12.0271 14.6668 12.4792 14.4912 12.8126 14.1787C13.146 13.8661 13.3333 13.4422 13.3333 13.0002V5.256C13.3333 5.035 13.2396 4.82307 13.0729 4.66683L9.77778 1.57766C9.61112 1.42137 9.38506 1.33354 9.14933 1.3335ZM9.33333 4.25016V2.5835L12 5.0835H10.2222C9.98648 5.0835 9.76038 4.9957 9.59368 4.83942C9.42698 4.68314 9.33333 4.47118 9.33333 4.25016ZM6.11911 6.90016L8 9.016L9.88089 6.89933C9.95645 6.81446 10.0649 6.76121 10.1823 6.75128C10.2998 6.74136 10.4166 6.77558 10.5071 6.84641C10.5976 6.91725 10.6544 7.0189 10.665 7.129C10.6756 7.23909 10.6391 7.34863 10.5636 7.4335L8.57867 9.66683L10.5636 11.9002C10.6357 11.9854 10.6694 12.0936 10.6575 12.2018C10.6456 12.3101 10.5891 12.4096 10.4999 12.4792C10.4108 12.5489 10.2961 12.5831 10.1805 12.5745C10.0648 12.566 9.95729 12.5154 9.88089 12.4335L8 10.3177L6.11911 12.4343C6.04355 12.5192 5.93513 12.5725 5.81769 12.5824C5.70025 12.5923 5.58342 12.5581 5.49289 12.4872C5.40236 12.4164 5.34556 12.3148 5.33497 12.2047C5.32439 12.0946 5.36089 11.985 5.43645 11.9002L7.42133 9.66683L5.43645 7.4335C5.39742 7.39168 5.36772 7.34297 5.34907 7.29023C5.33043 7.2375 5.32322 7.18179 5.32788 7.12641C5.33254 7.07102 5.34896 7.01706 5.37619 6.96772C5.40342 6.91837 5.4409 6.87462 5.48642 6.83906C5.53195 6.80349 5.58461 6.77681 5.64129 6.76061C5.69798 6.7444 5.75755 6.73898 5.8165 6.74467C5.87545 6.75037 5.93259 6.76706 5.98456 6.79376C6.03653 6.82046 6.08228 6.85664 6.11911 6.90016Z"
                        fill="white" />
                    <mask id="mask0_198_8745" style="mask-type:luminance" maskUnits="userSpaceOnUse" x="2" y="1"
                        width="12" height="14">
                        <path
                            d="M9.14933 1.3335H4.44445C3.97295 1.3335 3.52076 1.50909 3.18737 1.82165C2.85397 2.13421 2.66667 2.55814 2.66667 3.00016V13.0002C2.66667 13.4422 2.85397 13.8661 3.18737 14.1787C3.52076 14.4912 3.97295 14.6668 4.44445 14.6668H11.5556C12.0271 14.6668 12.4792 14.4912 12.8126 14.1787C13.146 13.8661 13.3333 13.4422 13.3333 13.0002V5.256C13.3333 5.035 13.2396 4.82307 13.0729 4.66683L9.77778 1.57766C9.61112 1.42137 9.38506 1.33354 9.14933 1.3335ZM9.33333 4.25016V2.5835L12 5.0835H10.2222C9.98648 5.0835 9.76038 4.9957 9.59368 4.83942C9.42698 4.68314 9.33333 4.47118 9.33333 4.25016ZM6.11911 6.90016L8 9.016L9.88089 6.89933C9.95645 6.81446 10.0649 6.76121 10.1823 6.75128C10.2998 6.74136 10.4166 6.77558 10.5071 6.84641C10.5976 6.91725 10.6544 7.0189 10.665 7.129C10.6756 7.23909 10.6391 7.34863 10.5636 7.4335L8.57867 9.66683L10.5636 11.9002C10.6357 11.9854 10.6694 12.0936 10.6575 12.2018C10.6456 12.3101 10.5891 12.4096 10.4999 12.4792C10.4108 12.5489 10.2961 12.5831 10.1805 12.5745C10.0648 12.566 9.95729 12.5154 9.88089 12.4335L8 10.3177L6.11911 12.4343C6.04355 12.5192 5.93513 12.5725 5.81769 12.5824C5.70025 12.5923 5.58342 12.5581 5.49289 12.4872C5.40236 12.4164 5.34556 12.3148 5.33497 12.2047C5.32439 12.0946 5.36089 11.985 5.43645 11.9002L7.42133 9.66683L5.43645 7.4335C5.39742 7.39168 5.36772 7.34297 5.34907 7.29023C5.33043 7.2375 5.32322 7.18179 5.32788 7.12641C5.33254 7.07102 5.34896 7.01706 5.37619 6.96772C5.40342 6.91837 5.4409 6.87462 5.48642 6.83906C5.53195 6.80349 5.58461 6.77681 5.64129 6.76061C5.69798 6.7444 5.75755 6.73898 5.8165 6.74467C5.87545 6.75037 5.93259 6.76706 5.98456 6.79376C6.03653 6.82046 6.08228 6.85664 6.11911 6.90016Z"
                            fill="white" />
                    </mask>
                    <g mask="url(#mask0_198_8745)">
                        <rect width="16" height="16" fill="white" />
                    </g>
                </svg>
                Export Excel
            </button>
        </div>
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
                                            <th>Tanggal</th>
                                            <th>Keterangan</th>
                                            <th>Keluar</th>
                                            <th>Masuk</th>
                                            <th>Kas</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                    <tfoot class="bg-primary rounded">
                                        <tr class="fw-bolder fs-6 text-gray-800">
                                            <td style="text-align: left !important;" colspan="5">Total Saldo</td>
                                            <td style="text-align: left !important;" colspan="1" id="total-saldo">
                                                Rp 0
                                            </td>
                                        </tr>
                                    </tfoot>
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
@section('script')
    <script>
        let control = new Control();

        $(".kt_datepicker_7").flatpickr({
            altInput: true,
            altFormat: "d-m-Y",
            dateFormat: "d-m-Y",
            mode: "range",
            onClose: function(selectedDates, dateStr, instance) {
                // Tangkap perubahan tanggal dan kirimkan data ke server
                $('.tanggal-proide').empty();
                sendDataToServer(dateStr);
            }
        });

        $(document).on('keyup', '#search_', function(e) {
            e.preventDefault();
            control.searchTable(this.value);
        })

        function sendDataToServer(sateStr) {
            let cumulativeSaldo = 0;
            let columns = [{
                data: null,
                className: 'text-center',
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            }, {
                data: 'tanggal',
                className: 'text-center',
            }, {
                data: null,
                render: function(data, type, row, meta) {
                    let deskripsiHTML = '<ul>';
                    $.each(row.deskripsi, function(x, y) {
                        deskripsiHTML += `<li>${y}</li>`;
                    });
                    deskripsiHTML += '</ul>';
                    return deskripsiHTML;
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row, meta) {
                    let value = '-';

                    if (row.keluar) {
                        value = '<ul>';
                        row.keluar.forEach(y => {
                            value += `<li>Rp ${numeral(y).format('0,0')}</li>`;
                        });
                        value += '</ul>';
                    }

                    return value;
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row, meta) {
                    let value;
                    if (row.masuk) {
                        value = 'Rp ' + numeral(row.masuk).format(
                            '0,0'); // Format to rupiah
                    } else {
                        value = '-';
                    }
                    return value;
                }
            }, {
                data: null,
                className: 'text-center',
                render: function(data, type, row) {
                    let keluar = 0;
                    let masuk = 0;

                    if (row.keluar) {
                        $.each(row.keluar, function(x, y) {
                            // Pastikan y berisi angka sebelum di-parse ke float
                            let parsedValue = parseFloat(y);
                            if (!isNaN(parsedValue)) {
                                keluar += parsedValue;
                            }
                        });
                    } else {
                        keluar = 0;
                    }

                    if (row.masuk) {
                        masuk = row.masuk
                    } else {
                        masuk = 0;
                    }

                    // Menghitung sisa saldo
                    let sisaSaldo = masuk - keluar;

                    // Menambahkan sisa saldo ke variabel kumulatif
                    cumulativeSaldo += sisaSaldo;

                    // Menampilkan sisa saldo kumulatif
                    let formattedSaldo = 'Rp ' + numeral(cumulativeSaldo).format('0,0');

                    return formattedSaldo;
                },
            }];

            $(function() {
                control.initDatatable3(`/admin/get-laporan/${sateStr}`, columns);
            })
        }

        $('#export-excel').click(function(e) {
            e.preventDefault();
            let val = $('#tanggal').val();
            if (!val) {
                swal
                    .fire({
                        text: `Filter tanggal priode terlebih dahulu`,
                        icon: "warning",
                        showConfirmButton: false,
                        timer: 1500,
                    })
                return;
            }
            window.open(`/admin/export-laporan/${val}`, "_blank");
        });
    </script>
@endsection