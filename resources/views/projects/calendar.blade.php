@extends('layouts/contentLayoutMaster')

@section('title', 'Project - ' . $project->name )

@section('content')
@include('projects.nav')
@endsection
