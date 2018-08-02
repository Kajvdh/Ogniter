@extends('classic.layouts.default')

@section('title')Ogniter - Donators @stop
@section('description')Donators / Assistants / MVP @stop

@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="/">{{ $lang->trans('ogniter.og_home') }}</a><span class="divider">/</span></li>
        <li><a href="site/donators">Donators</a></li>
    </ul>
@endsection

@section('content')
    <div class="span9">
        <div class="box">
            <div class="box-header well">
                <h2><i class="icon-chevron-right icon-white"></i> Donators</h2>
            </div>
            <div class="box-content clearfix">
                These people have helped Ogniter to be and stay online again!
		<br /><br />
                <ul>
                    <li><strong>Donato</strong> - For, of course, developing Ogniter!</li>
                    <li><strong>Kevin87</strong></li>
                    <li><strong>Charles</strong></li>
                    <li><strong>Wyatt</strong></li>
                </ul>
            </div>
        </div>
        
    </div>

    <div class="span3">
        @include('classic.partials.donate')
        @include('classic.partials.shared.statistics')
        @include('classic.partials.home.countrylist')
    </div>
@endsection
