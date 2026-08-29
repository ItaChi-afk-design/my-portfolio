@extends('layouts.portfolio')

@section('content')
    @include('partials.portfolio.svg-defs')
    @include('partials.portfolio.hero')

    <main class="page-light">
        @include('partials.portfolio.about-me')
        @include('partials.portfolio.services')
        @include('partials.portfolio.projects')
        @include('partials.portfolio.experience')
        @include('partials.portfolio.connect-cta')
        @include('partials.portfolio.footer')
        @include('partials.portfolio.contact-modal')
    </main>
@endsection
