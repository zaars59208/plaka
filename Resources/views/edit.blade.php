@extends('layouts.admin')

@section('title', trans('plakas::general.name'))

@section('content')
    <div class="row">
       <p>Plaka edit blade page</p>
    </div>
@endsection

@push('scripts_start')
    <script src="{{ asset('modules/Plaka/Resources/assets/js/plakas.min.js?v=' . version('short')) }}"></script>
@endpush
