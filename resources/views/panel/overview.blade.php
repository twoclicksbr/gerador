@extends('layouts.app')

@section('title', 'Visão Geral')
@section('page-title', 'overview')

@section('content')

    <div class="wrapper d-flex flex-column flex-row-fluid mt-5 mt-lg-10" id="kt_wrapper">
        <div class="content flex-column-fluid" id="kt_content">

            <pre>{{ print_r(session()->all()) }}</pre>

        </div>
    </div>

@endsection
