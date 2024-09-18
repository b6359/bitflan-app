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

        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="" class="custom-label">{{ trans('webtools/tools/text-repeater.label_entertext') }}</label>
                    <textarea class="custom-textarea" placeholder="Type your text here" rows="5" id="input-text" required></textarea>
                </div>
                <div class="form-group">
                    <label for="" class="custom-label">{{ trans('webtools/tools/text-repeater.label_repeat_times') }}</label>
                    <input type="number" class="custom-input" id="repeat-times" min="1" max="1000" value="2" required>
                </div>

                <div class="form-group">
                    <div class="form-check me-3">
                        <input class="form-check-input" type="checkbox" name="flexRadioDefault" id="addnewlines">
                        <label class="form-check-label" for="addnewlines">
                            {{ trans('webtools/tools/text-repeater.label_add_new_line') }}
                        </label>
                    </div>
                </div>

                <button class="btn custom--btn button__lg w-100" onclick="repeatText()">Repeat Text</button>
            </div>
            <div class="col-lg-6">
                <label for="" class="custom-label">{{ trans('webtools/tools/text-repeater.label_repeated') }}</label>
                <div class="copy-textarea-btn">
                    <textarea class="custom-textarea" placeholder="Type your text here" rows="5" id="output-text" required></textarea>
                    <button class="btn custom--btn button__md copy-btn btn__dark" id="copybtn" onclick="copyToClipboard()">{{ trans('webtools/tools/text-repeater.btn_copy') }}</button>
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
<script>
    function repeatText() {
        var inputText = document.getElementById("input-text").value;
        var repeatTimes = document.getElementById("repeat-times").value;
        var addnewlines = document.getElementById("addnewlines").checked;
        var outputText = "";
        var nltbr = "";

        if(addnewlines){
            nltbr = "\n";
        }
        else{
            nltbr = " ";
        }

        for (var i = 0; i < repeatTimes; i++) {
            outputText += inputText + nltbr;
        }

        document.getElementById("output-text").value = outputText;
    }

    function copyToClipboard() {
        var outputText = document.getElementById("output-text");
        outputText.select();
        document.execCommand("copy");
        document.getElementById("copybtn").textContent = "Copied!";
    }
</script>

@endsection
