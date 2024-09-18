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
        <form>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/weight-converter.labelPounds') }}</label>
                        <input id="inputPounds" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/weight-converter.labelPounds') }}" oninput="weightConverter(this.id,this.value)" onchange="weightConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/weight-converter.labelKilograms') }}</label>
                        <input id="inputKilograms" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/weight-converter.labelKilograms') }}" oninput="weightConverter(this.id,this.value)" onchange="weightConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/weight-converter.labelOunces') }}</label>
                        <input id="inputOunces" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/weight-converter.labelOunces') }}" oninput="weightConverter(this.id,this.value)" onchange="weightConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/weight-converter.labelGrams') }}</label>
                        <input id="inputGrams" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/weight-converter.labelGrams') }}" oninput="weightConverter(this.id,this.value)" onchange="weightConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/weight-converter.labelStones') }}</label>
                        <input id="inputStones" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/weight-converter.labelStones') }}" oninput="weightConverter(this.id,this.value)" onchange="weightConverter(this.id,this.value)">
                    </div>
                </div>
            </div>
        </form>
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
    function weightConverter(source,valNum) {
        valNum = parseFloat(valNum);
        var inputPounds = document.getElementById("inputPounds");
        var inputKilograms = document.getElementById("inputKilograms");
        var inputOunces = document.getElementById("inputOunces");
        var inputGrams = document.getElementById("inputGrams");
        var inputStones = document.getElementById("inputStones");
        if (source=="inputPounds") {
            inputKilograms.value=(valNum/2.2046).toFixed(2);
            inputOunces.value=(valNum*16).toFixed(2);
            inputGrams.value=(valNum/0.0022046).toFixed();
            inputStones.value=(valNum*0.071429).toFixed(3);
        }
        if (source=="inputKilograms") {
            inputPounds.value=(valNum*2.2046).toFixed(2);
            inputOunces.value=(valNum*35.274).toFixed(2);
            inputGrams.value=(valNum*1000).toFixed();
            inputStones.value=(valNum*0.1574).toFixed(3);
        }
        if (source=="inputOunces") {
            inputPounds.value=(valNum*0.062500).toFixed(4);
            inputKilograms.value=(valNum/35.274).toFixed(4);
            inputGrams.value=(valNum/0.035274).toFixed(1);
            inputStones.value=(valNum*0.0044643).toFixed(4);
        }
        if (source=="inputGrams") {
            inputPounds.value=(valNum*0.0022046).toFixed(4);
            inputKilograms.value=(valNum/1000).toFixed(4);
            inputOunces.value=(valNum*0.035274).toFixed(3);
            inputStones.value=(valNum*0.00015747).toFixed(5);
        }
        if (source=="inputStones") {
            inputPounds.value=(valNum*14).toFixed(1);
            inputKilograms.value=(valNum/0.15747).toFixed(1);
            inputOunces.value=(valNum*224).toFixed();
            inputGrams.value=(valNum/0.00015747).toFixed();
        }
    }
</script>

@endsection
