@extends('layout.master')

@section('content')
    <vue_search_bar action="{{ route('list') }}"
                    target="{{ $searchData['target'] }}"
                    check-in="{{ $searchData['checkIn'] }}"
                    check-out="{{ $searchData['checkOut'] }}"
                    adult="{{ $searchData['adult'] }}"
    >
    </vue_search_bar>

    @yield('main_content')
@endsection