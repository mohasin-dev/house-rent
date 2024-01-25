@extends('layouts.master')

@section('title', 'Home')

@section('content')
<div class="container-fluid">
    <div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
            <i class="material-icons">content_copy</i>
            </div>
            <p class="card-category">Total House</p>
            <h3 class="card-title">{{ $houses }}
            {{-- <small>GB</small> --}}
            </h3>
        </div>
        {{-- <div class="card-footer">
            <div class="stats">
            <i class="material-icons text-danger">warning</i>
            <a href="#pablo">Get More Space...</a>
            </div>
        </div> --}}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
            <i class="material-icons">store</i>
            </div>
            <p class="card-category">Total Floor</p>
            <h3 class="card-title">{{ $floors }}</h3>
        </div>
        {{-- <div class="card-footer">
            <div class="stats">
            <i class="material-icons">date_range</i> Last 24 Hours
            </div>
        </div> --}}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
            <i class="material-icons">info_outline</i>
            </div>
            <p class="card-category">Total Flat</p>
            <h3 class="card-title">{{ $flats }}</h3>
        </div>
        {{-- <div class="card-footer">
            <div class="stats">
            <i class="material-icons">local_offer</i> Tracked from Github
            </div>
        </div> --}}
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
        <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
            <i class="fa fa-users"></i>
            </div>
            <p class="card-category">Total Customers</p>
            <h3 class="card-title">{{ $customers }}</h3>
        </div>
        {{-- <div class="card-footer">
            <div class="stats">
            <i class="material-icons">update</i> Just Updated
            </div>
        </div> --}}
        </div>
    </div>
    </div>
</div>
@endsection
