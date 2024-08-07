@extends('admin::layouts.master')

@section('title', 'Versie management')

@section('content')
  <div class="container mt-4">
    <div class="row">
      <div class="col-sm text-white">
        <h3>Laatste Github repo updates:</h3>
        @foreach ($prResults as $pr)
          @if ($loop->index > 10)
            @break
          @endif
          <p>Nr. {{ $pr->number }} - <a href="{{ $pr->html_url }}/files" target="blank">{{ $pr->title }}</a></p>
        @endforeach
      </div>

      <div class="col-sm text-white">
        <h3>Versie:</h3>
        <p>
          <strong>
            Versie:
          </strong>
          <span class="badge badge-primary font-weight-bold">
              <strong>
                {{ $latestRelease->tag_name }}
              </strong>
          </span>
          <br>

          <strong>
            Datum:
          </strong> 
          <span class="badge badge-primary">
            <strong>
              {{ $latestRelease->published_at }}
            </strong>
          </span>
          <br>  

          <strong>
            Author:
          </strong> 
          <span class="badge badge-primary">
            <img src="{{ $latestRelease->author->avatar_url }}" style="width: 18px">
              <strong>
                {{ $latestRelease->author->login }}
              </strong>
            </img>
          </span>
          <br>

          <strong>
            Commit branch:
          </strong>
          <span class="badge badge-primary">
            <strong>
              {{ $latestRelease->target_commitish }}
            </strong>
          </span>

          <br>
          <a href="/update" class="btn btn-primary">Update (alleen voor Kelvin!)</a>
        </p>
    </div>
  </div>
@endsection
