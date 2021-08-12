@extends('layout.layout_admin')

@section('title', __('id.dashboard'))

@section('page')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <!-- Overview content -->
    <section class="content">

        <div class="container-fluid">

            <div class="row mb-1 content-header">
                <!-- <div class="col-sm-12">
                    <h1>Dashboard</h1>
                </div> -->
            </div>

        </div>

        <!--In Progress content -->
        <section class="content">

            <div class="container-fluid">
                <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            
            <div class="small-box bg-primary">
              <div class="inner">
                <h3>{{$jumlah_pengusul}}</h3>

                <p>User Pengusul</p>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-users"></i> -->
              </div>
              <!-- <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$jumlah_reviewer}}</h3>

                <p>User Reviewer</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <!-- <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$jumlah_usulan_tahun_ini}}</h3>

                <p>Pengajuan</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$jumlah_usulan_total}}</h3>

                <p>Total Usulan</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <!-- <a href="" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
        </div>

            </div>
        </section>
</div>
<!-- /.content -->


@endsection

@push('plugin')


@endpush