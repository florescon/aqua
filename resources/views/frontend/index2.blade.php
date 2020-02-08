@extends('frontend.layouts.app2')

@section('title', app_name() . ' | ' . __('navs.general.home'))

@push('after-styles')
	<link href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css" rel="stylesheet">
@endpush

@include('includes.partials.messages')

@section('content')

    @include('frontend.includes2.bgimage')
    
    @include('frontend.includes2.services')

    @if($gallery->count())
        @include('frontend.includes2.gallery')
    @endif

    @if($staff->count())
        @include('frontend.includes2.people')
    @endif

    {{-- @include('frontend.includes2.clients') --}}
    @include('frontend.includes2.subscribe')
    

@endsection

@push('after-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/anchor-js/3.2.1/anchor.min.js"></script>

	<script>
		$(document).on("click", '[data-toggle="lightbox"]', function(event) {
		  event.preventDefault();
		  $(this).ekkoLightbox();
		});	
	</script>
@endpush