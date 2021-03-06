@extends('layouts.app', ['title' => 'Data Pembayaran'])
@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>
                DATA PEMBAYARAN
            </h2>
        </div>
        <!-- Basic Examples -->
        <div class="row clearfix">
            <div class="col-md-12">
                <ol class="breadcrumb breadcrumb-bg-pink">
                    <li><a href="{{ route('home') }}">Dasbor</a></li>
                    <li class="active">Data Pembayaran</li>
                </ol>
            </div>
            @include('alert')
            @include('filter_tanggal', ['judul' => 'TAMPILKAN PEMBAYARAN', ])
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            DATA PEMBAYARAN
                        </h2>
                    </div>
                    <div class="body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#data_tab" data-toggle="tab">
                                    <i class="material-icons">insert_drive_file</i> DATA
                                </a>
                            </li>
                            <li role="presentation">
                                <a href="#tambah_tab" data-toggle="tab">
                                    <i class="material-icons">add</i> TAMBAH
                                </a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane fade in active" id="data_tab">
                                <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                    <thead>
                                        <tr>
                                            <th>No Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Perusahaan</th>
                                            <th>Bank</th>
                                            <th>Alamat Bank</th>
                                            <th>No Rek.</th>
                                            <th>Total Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No Pembayaran</th>
                                            <th>Tanggal</th>
                                            <th>Perusahaan</th>
                                            <th>Bank</th>
                                            <th>Alamat Bank</th>
                                            <th>No Rek.</th>
                                            <th>Total Bayar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @foreach ($data as $d)
                                        <tr>
                                            <td>{{ $d->no_pb }}</td>
                                            <td>{{ tglIndo($d->tgl_pb) }}</td>
                                            <td>{{ $d->nm_peru }}</td>
                                            <td>{{ $d->bank }}</td>
                                            <td>{{ $d->almt_bank }}</td>
                                            <td>{{ $d->no_rek }}</td>
                                            <td>{{ rupiah($d->total_semua) }}</td>
                                            <td>
                                                @include('edit_button', ['link'=>route('pembayaran.ubah', $d->no_pb)])
                                                @include('delete_button', ['link'=>route('pembayaran.hapus', $d->no_pb)])
                                                @include('print_button', ['link'=>route('pembayaran.cetak', $d->no_pb)])
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tambah_tab">
                                <form action="{{ route('pembayaran.tambah') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">book</i>
                                                </span>
                                                <div class="form-line">
                                                    <input value="{{ old('nm_peru') }}" required="required" name="nm_peru" type="text" class="form-control" placeholder="Nama Perusahaan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">date_range</i>
                                                </span>
                                                <div class="form-line">
                                                    <input required="required" readonly="readonly" name="tgl_pb" value="{{ date('Y-m-d') }}" type="text" class="form-control" placeholder="Tanggal">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">done</i>
                                                </span>
                                                <div class="form-line">
                                                    <input value="{{ old('no_rek') }}" required="required" name="no_rek" type="text" class="form-control" placeholder="No Rekening">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="material-icons">credit_card</i>
                                                </span>
                                                <div class="form-line">
                                                    <input name="bank" value="{{ old('bank') }}" type="text" class="form-control" placeholder="Nama Bank" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <textarea name="almt_bank" rows="4" class="form-control no-resize" placeholder="Alamat Bank">{{ old('almt_bank') }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="aaa">
                                        <div class="col-md-4">
                                            <select required="required" name="no_po[]" class="form-control show-tick material-select">
                                                <option value="">-- Pilih No Purchase Order --</option>
                                                @if(count($errors->all()) > 0)
                                                @foreach ($po as $s)
                                                <option @if($s->no_po == old('no_po')) selected @endif value="{{ $s->no_po }}">{{ $s->no_po }}</option>
                                                @endforeach
                                                @else
                                                @foreach ($po as $s)
                                                <option value="{{ $s->no_po }}">{{ $s->no_po }}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input name="no_invoice[]" type="text" class="form-control" placeholder="No Invoice" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input name="no_fp[]" type="text" class="form-control" placeholder="No Faktur Pajak" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input min="0" readonly="readonly" id="tagihan" name="tagihan[]" type="number" class="form-control" placeholder="Tagihan" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input min="0" readonly="readonly" id="ppn" name="ppn[]" type="number" class="form-control" placeholder="PPN" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input min="0" readonly="readonly" id="total_bayar" name="total_bayar[]" type="number" class="form-control" placeholder="Total Bayar" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12" id="bbb">

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <hr>
                                        </div>
                                        <div class="col-md-12">
                                            @include('add_button')
                                        </div>
                                        <div class="col-md-12">
                                            @include('save_button')
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- #END# Basic Examples -->
    </div>
</section>
@include('form-hapus')
@endsection
@include('load_bs_select')
@push('script')
<script>
    function tambah() {
        $('.material-select').selectpicker('destroy');
        setTimeout(function(){
            var aaa = document.getElementById('aaa').outerHTML;
            var b = $(aaa).append('@include('hapus_button')');
            $('#bbb').append(b);
            setTimeout(function(){
                $('.material-select').selectpicker('refresh');
                initEvent();
            }, 200);
        }, 200);
    }
    function hapusD(el, e) {
        e.preventDefault();
        $(el).parents('#aaa').remove();
    }
    function initEvent() {
        $('.material-select').on('changed.bs.select', function(e){
            var el = $(this)
            if($(this).val() != ''){
                $.ajax({
                    url : '{{ url('purchase-order/total-bayar') }}/'+$(this).val(),
                    type : 'get',
                    success : function(response, b){
                        el.parents('#aaa').find('#tagihan').val(response);
                        el.parents('#aaa').find('#ppn').val(
                            Math.round(
                                Number(response) * 0.1 * 100
                                ) / 100
                            );
                        el.parents('#aaa').find('#total_bayar').val(
                            Math.round(
                                Number(response) * 1.1 * 100
                                ) / 100
                            );
                    }
                })
            }
        });   
    }
    initEvent();
    function tampilkan() {
        if($('#tgl_mulai').val() == ''){
            alert('Tanggal mulai tidak boleh kosong')
            return
        }
        if($('#tgl_sampai').val() == ''){
            alert('Tanggal sampai tidak boleh kosong')
            return
        }
        window.location = '{{ url('pembayaran') }}'+'?tgl_mulai='+$('#tgl_mulai').val()+'&tgl_sampai='+$('#tgl_sampai').val();
    }
</script>
@endpush
@include('load_datepicker')