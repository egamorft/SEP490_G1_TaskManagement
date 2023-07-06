@extends('layouts/contentLayoutMaster')

@section('title', 'Project - ' . $project->name )

@section('content')
@include('project.nav')
@endsection
