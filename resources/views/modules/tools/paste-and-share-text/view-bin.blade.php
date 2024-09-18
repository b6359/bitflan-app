@extends('layouts.main')

@section('content')

<div class="hero-section">
    <h2>{{ trans('webtools/homepage.title') }}</h2>
    <h1>{{ trans('webtools/homepage.heading') }}</h1>
</div>

<div class="single-page-sec">
    <x-ads.top-banner />

    <div class="single-page-inner">
        <div class="form-group">
            <label for="ps_content" class="custom-label">{{ trans('webtools/tools/paste-and-share-text.label_Your_Content') }}</label>
            <div class="copy-textarea-btn">
                <textarea type="text" id="bin-content" disabled class="custom-textarea" placeholder="Enter Text" rows="8">{{ $bin->content }}</textarea>
                <button onclick="window.writeClipboardTextVanilla(this, document.getElementById('bin-content').value)" class="btn custom--btn button__md copy-btn btn__dark">{{ trans('webtools/tools/paste-and-share-text.btn-copy') }}</button>
            </div>
        </div>
        <a href="{{ url('/tool/paste-and-share-text') }}" class="btn custom--btn button__lg">{{ trans('webtools/tools/paste-and-share-text.label_Generate_Again') }}</a>
    </div>

    <x-ads.middle-banner />
</div>

@endsection
