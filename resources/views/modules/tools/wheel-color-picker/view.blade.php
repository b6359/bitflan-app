@extends('layouts.main')

@section('content')

<div class="hero-section">
    <h2>{{ trans('webtools/homepage.title') }}</h2>
    <h1>{{ trans('webtools/homepage.heading') }}</h1>
</div>

@include("modules.tools.search-base")

<div class="single-page-sec">
    @include( $tool['templates']['header'], [
        'tool' => $tool['name']
    ] )

    <x-ads.top-banner />

    <div class="single-page-inner">

        <div class="d-flex flex-column flex-lg-row">
            <div class="me-lg-3 mb-lg-0 mb-3">
                <div class="colorPicker mb-3"></div>
                <input id="hexInput" class="custom-input text-center" style="max-width: 280px;">
            </div>
            <div id="preview" class="flex-grow-1 color-picker-preview">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <th scope="row">{{ trans('webtools/tools/wheel-color-picker.label_hex') }}</th>
                                <td id="cd-hex"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ trans('webtools/tools/wheel-color-picker.label_rgb') }}</th>
                                <td id="cd-rgb"></td>
                            </tr>
                            <tr>
                                <th scope="row">{{ trans('webtools/tools/wheel-color-picker.label_hsl') }}</th>
                                <td id="cd-hsl"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <hr class="small-marg">
        <h2>{{ get_tool_title($tool['name'], $toolSettings->title) }}</h2>
        <p>{!! get_tool_description($tool['name'], $toolSettings->description) !!}</p>
    </div>

    <x-ads.middle-banner />
</div>
<div class="content-sec">
    <div class="content-sec-inner">
        <div class="content-title-sec">
            <div class="content-title-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                    <path id="chart-relationship" d="M29.25,6.75a4.5,4.5,0,0,0-4.34,3.375H20.171A8.995,8.995,0,1,0,10.125,20.171V24.91a4.5,4.5,0,1,0,2.25,0V20.173A8.945,8.945,0,0,0,16.76,18.35l4.128,4.129a4.447,4.447,0,0,0-.638,2.271,4.5,4.5,0,1,0,4.5-4.5,4.446,4.446,0,0,0-2.271.638L18.35,16.759a8.944,8.944,0,0,0,1.823-4.384H24.91A4.492,4.492,0,1,0,29.25,6.75Z" transform="translate(-2.251 -2.251)" fill="#fff"/>
                </svg>
            </div>
            <h3>{{ trans('webtools/general.related') }}</h3>
        </div>
        <div class="content-cats-sec">
            @foreach($related as $toolKey => $relatedTool)
                @if($relatedTool['name'] != $tool['name'])
                    @if($toolOptions['tool-' . $relatedTool['name'] . '.' . 'enabled'][0]->payload != 'false')
                        <div class="content-cats-col">
                            <a href="{{ !can_use($toolKey) ? route('pricing') : route('tool', $toolSlugs->{$toolKey}) }}" class="content-cats-inner {{ !can_use($toolKey) ? 'locked' : '' }}">
                                @include($relatedTool['templates']['selector'], [
                                    'tool'    => $relatedTool['name'],
                                    'title'   => get_tool_title($relatedTool['name'], str_replace('"', '', $toolOptions['tool-' . $relatedTool['name'] . '.' . 'title'][0]->payload)),
                                    'summary' => get_tool_summary($relatedTool['name'], str_replace('"', '', $toolOptions['tool-' . $relatedTool['name'] . '.' . 'summary'][0]->payload)),
                                ])
                            </a>
                        </div>
                    @endif
                @endif

            @endforeach
        </div>
    </div>

    <x-ads.bottom-banner />

</div>
<script src="https://cdn.jsdelivr.net/npm/@jaames/iro/dist/iro.min.js"></script>
<script>
    // Create a new color picker instance
    // https://iro.js.org/guide.html#getting-started
    var colorPicker = new iro.ColorPicker(".colorPicker", {
        // color picker options
        // Option guide: https://iro.js.org/guide.html#color-picker-options
        width: 280,
        color: "rgb(255, 0, 0)",
        borderWidth: 1,
        borderColor: "#fff",
    });

    var cdhex = document.getElementById('cd-hex');
    var cdrgb = document.getElementById('cd-rgb');
    var cdhsl = document.getElementById('cd-hsl');

    var colorPreview = document.getElementById('preview');

    var values = document.getElementById("values");
    var hexInput = document.getElementById("hexInput");

    // https://iro.js.org/guide.html#color-picker-events
    colorPicker.on(["color:init", "color:change"], function(color){
        // Show the current color in different formats
        // Using the selected color: https://iro.js.org/guide.html#selected-color-api
        cdhex.innerHTML = color.hexString;
        cdrgb.innerHTML = color.rgbString;
        cdhsl.innerHTML = color.hslString;

        colorPreview.style.background = color.hexString;

        hexInput.value = color.hexString;
    });

    hexInput.addEventListener('change', function() {
        colorPicker.color.hexString = this.value;
    });
</script>

@endsection
