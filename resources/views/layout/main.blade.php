@extends('layout.master')

@section('content')
    @if (isset($isShowSearchBar) && $isShowSearchBar)
        <vue_search_bar action="{{ route('list') }}"
                        target="{{ $searchData['target'] }}"
                        check-in="{{ $searchData['checkIn'] }}"
                        check-out="{{ $searchData['checkOut'] }}"
                        :adult="{{ (int) $searchData['adult'] }}"
                        :offset-x="-95"
                        :offset-y="20"
        >
        </vue_search_bar>
    @endif

    @yield('main_content')
@endsection