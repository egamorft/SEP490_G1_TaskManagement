@isset($pageConfigs)
    {!! Helper::updatePageConfig($pageConfigs) !!}
@endisset

<!DOCTYPE html>
@php
    $configData = Helper::applClasses();
@endphp

<html class="loading {{ $configData['theme'] === 'light' ? '' : $configData['layoutTheme'] }}"
    lang="@if (session()->has('locale')) {{ session()->get('locale') }}@else{{ $configData['defaultLanguage'] }} @endif"
    data-textdirection="{{ env('MIX_CONTENT_DIRECTION') === 'rtl' ? 'rtl' : 'ltr' }}"
    @if ($configData['theme'] === 'dark') data-layout="dark-layout" @endif>

<head>
    @php
        
        use App\Models\Project;
    @endphp
    @if (Route::currentRouteName() == 'project.settings')
        @php
            $segments = collect(explode('/', request()->path()));
            $slug = $segments->last();
            $project = Project::where('slug', $slug)->first();
            $inviteUrl = url('project/invite/' . $project->token);
        @endphp
        <meta property="og:url" content="{{ $inviteUrl }}" />
        <meta property="og:type" content="FTask" />
        <meta property="og:title" content="You have invited to {{ $project->name }}" />
        <meta property="og:description" content="Let's start your project with your team?" />
        <meta property="og:image" content="{{ env('LOGO_URl') }}" />
    @endif
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>@yield('title') - FTask - FPT task management</title>
    <link rel="apple-touch-icon" href="{{ asset('images/ico/favicon-32x32.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo/favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600"
        rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/base/pages/empty-state.css') }}">

    {{-- Include core + vendor Styles --}}
    @include('panels/styles')

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->
@isset($configData['mainLayoutType'])
    @extends($configData['mainLayoutType'] === 'horizontal' ? 'layouts.horizontalLayoutMaster' : 'layouts.verticalLayoutMaster')
@endisset

<!-- Alert-->
@if (Session::has('success'))
    <div id="success-alert" hidden>
        {{ Session::get('success') }}
    </div>
@endif

@if (Session::has('error'))
    <div id="error-alert" hidden>
        {{ Session::get('error') }}
    </div>
@endif
<!-- Alert-->
