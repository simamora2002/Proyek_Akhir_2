@extends('publik.app')

@section('title', 'Pengeluaran Keuangan')

@section('contents')
    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container px-lg-5">
            <div class="section-title position-relative text-center mb-5 pb-2 wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="position-relative d-inline text-primary ps-4">Arus Keuangan IA Del Charity</h6>
                <h2 class="mt-2">Pengeluaran Keuangan</h2>
            </div>
        </div>
        <div class="card shadow mb-4 mt-2 wow fadeInUp">
            <div class="card-body wow fadeInUp">
                <div class="table-responsive">
                    <form action="/filter_pengeluaran_keuangan" method="get">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="code_name" class="col-form-label text-gray-900"><strong> Tanggal Awal </strong></label>
                                        <div class="container">
                                            <input type="date" class="form-control text-gray-900" name="start_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-gray-900"><strong> Tanggal Akhir </strong></label>
                                        <div class="container">
                                            <input type="date" class="form-control text-gray-900" name="end_date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="name" class="col-form-label text-gray-900"><strong> Jenis Pengeluaran </strong></label>
                                        <div class="col-md-12">
                                            <select id="jenis_pengeluaran_id" class="form-control text-gray-900" name="jenis_pengeluaran_id" data-live-search="true">
                                                <option disabled selected>Pilih Jenis Pengeluaran</option>
                                                <option value="">All</option>
                                                @foreach($jenis_pengeluaran as $jp)
                                                    <option value="{{ $jp->id }}">{{ $jp->name_of_type_expenditure }}</option>
                                                @endforeach
                                            </select>
                                        </div>                  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 mt-3">
                                    <div class="form-group">
                                        <div class="container">
                                            <button type="submit" class="btn btn-primary"> Filter </button>
                                            <button type="submit" class="btn btn-danger" onclick="resetForm()"> Reset </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body wow zoomIn">
                <div class="table-responsive">
                    <table class="table table-hover text-gray-900" style="text-align:center;" id="dataTable">
                        <thead>
                            <tr style="text-align:center;">
                                <th><b> No </b></th>
                                <th><b> Jenis Pengeluaran </b></th>
                                <th><b> Deskripsi Pengeluaran </b></th>
                                <th><b> Tanggal Pengeluaran </b></th>
                                <th><b> Total Pengeluaran </b></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengeluaran as $pl)
                            <tr style="text-align:center;">
                                <td> {{ $loop->iteration }} </td>
                                <td> {{ $pl->jenis_pengeluaran->name_of_type_expenditure }} </td>
                                <td> {!! $pl->expenditure_description !!} </td>
                                <?php
                                    $bulanIndonesia = [
                                        'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
                                        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
                                    ];
                                    ?>
                                <td>{{ \DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format('j ') . $bulanIndonesia[\DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format('n') - 1] . \DateTime::createFromFormat('Y-m-d', $pl->expenditure_date)->format(' Y') }}</td>
                                <td> Rp {{ number_format($pl['total_expenditure'],2,',','.') }} </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->
@endsection