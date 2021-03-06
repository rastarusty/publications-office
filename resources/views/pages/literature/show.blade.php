@extends('layouts/main')

@section('title')
	{{ 'PO | ' . $literature->title }}
@endsection

@section('css')
	<link rel="stylesheet" href="{{ asset('css/resource-edit.css') }}"
	type="text/css">
@endsection

@section('activeLiterature')
	class="active"
@endsection

@section('content')
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h1>LITERATURE REVIEW</h1>
			<hr>

      @if (Auth::check() && Auth::user()->isStaff())
  			@include(
  				'layouts/partials/_button-to-edit',
  				['model' => 'literature',
  				'id' => $literature->id,
  			])
      @endif

			@if (! is_null($literature->cover_path))
				<div class="row indent">
					<div class="col-md-6">
						<h2 class="text-center">{{ $literature->title }}</h2>
					</div>
					<div class="col-md-6">
						<img class="cover"
						src="{{ asset('storage/' . $literature->cover_path) }}">
					</div>
				</div>
			@else
				<h2 class="fancy-align">{{ $literature->title }}</h2>
			@endif

			@if (isset($literature->description))
				<label>Description</label>
				<p>{{ $literature->description }}</p>
			@endif

			<label>Publisher</label>
			<p>{{ $literature->publisher }}</p>

			<hr>

			<label>Type</label>
			<p>{{ ucwords($literature->type) }}</p>

			@if ($literature->type == 'journal')
				<label>Periodicity</label>
				<p>{{ $literature->periodicity }} edition(s) per year</p>

				@if ($literature->issn)
					<label>ISSN</label>
					<p>{{ $literature->issn }}</p>
				@endif
			@endif

			@if ($literature->type == 'book' ||
				 $literature->type == 'conference proceedings')
				<label>Size</label>
				<p>{{ $literature->size }}</p>

				<label>Year of issue</label>
				<p>{{ $literature->issue_year }}</p>

				@if ($literature->isbn)
					<label>ISBN</label>
					<p>{{ $literature->isbn }}</p>
				@endif
			@endif

			@if ($literature->databases->isNotEmpty())
				<hr>
				<label>Relevant bibliographic databases ({{ $literature->databases->count() }})</label>
				<ul>
				@foreach ($literature->databases as $database)
					<li>
            @if (! $database->trashed())
  						<a href="{{ route('databases.show', $database->id) }}">
  							{{ $database->name }}
  						</a>
  						<span>
  							 - from {{ $database->pivot->date }}
  						</span>
            @else
  						<span>
  							{{ $database->name }} - from {{ $database->pivot->date }}
  						</span>
            @endif
					</li>
				@endforeach
				</ul>
			@endif

			@if ($literature->publications->isNotEmpty())
				<hr>
				<label>Available publications ({{ $literature->publications->count() }})</label>
				<ul>
				@foreach ($literature->publications as $publication)
					<li>
						<a href="{{ route('publications.show', $publication->id) }}">
							{{ $publication->heading }}
						</a>
					</li>
				@endforeach
				</ul>
			@endif
		</div>
	</div>﻿
@endsection
