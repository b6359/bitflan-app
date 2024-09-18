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
            {{-- <div class="form-group">
                <label for="encodeQuote" class="custom-label">{{ trans('webtools/tools/quoted-printable-encode.label') }}</label>
                <label for="feet" class="custom-label">Feet</label>
                <input type="text" name="feet" id="feet" class="custom-input" placeholder='Feet' rows="5" required>
            </div> --}}
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelFeet') }}</label>
                        <input id="inputFeet" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelFeet') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelMeters') }}</label>
                        <input id="inputMeters" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelMeters') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelInches') }}</label>
                        <input id="inputInches" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelInches') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelCm') }}</label>
                        <input id="inputcm" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelCm') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelYards') }}</label>
                        <input id="inputYards" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelYards') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelKilometers') }}</label>
                        <input id="inputKilometers" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelKilometers') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/length-converter.labelMiles') }}</label>
                        <input id="inputMiles" class="custom-input" type="number" placeholder="{{ trans('webtools/tools/length-converter.labelMiles') }}" oninput="lengthConverter(this.id,this.value)" onchange="lengthConverter(this.id,this.value)">
                    </div>
                </div>
            </div>
            {{-- <button class="btn custom--btn button__lg">{{ trans('webtools/tools/quoted-printable-encode.submit') }}</button> --}}
            {{-- @if (request()->input('submit') && request()->input('encodeQuote') == '')
                <div class="alert alert-danger rounded-pill mt-3 p-l-25 p-r-25 bg-danger border-0"><h5 class="m-0 text-light">{{ trans('webtools/tools/quoted-printable-encode.fieldEmpty') }}</h5></div>
            @endif --}}
        </form>

        {{-- @if ($encoded_printable) --}}
            {{-- <hr class="">

            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label class="custom-label">{{ trans('webtools/tools/quoted-printable-encode.converted-label') }}</label>
                        <div class="copy-textarea-btn">
                            <textarea type="email" id="encoded-copy" class="custom-textarea" rows="9">{{ $quoted-printable-encode }}</textarea>
                            <button onclick="window.writeClipboardTextVanilla(this, document.getElementById('encoded-copy').value)" class="btn custom--btn button__md copy-btn btn__dark">{{ trans('webtools/tools/quoted-printable-encode.btn-copy') }}</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        {{-- @endif --}}

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
    function lengthConverter(source,valNum) {
      valNum = parseFloat(valNum);
      var inputFeet = document.getElementById("inputFeet");
      var inputMeters = document.getElementById("inputMeters");
      var inputInches = document.getElementById("inputInches");
      var inputcm = document.getElementById("inputcm");
      var inputYards = document.getElementById("inputYards");
      var inputKilometers = document.getElementById("inputKilometers");
      var inputMiles = document.getElementById("inputMiles");
      if (source=="inputFeet") {
        inputMeters.value=(valNum/3.2808).toFixed(2);
        inputInches.value=(valNum*12).toFixed(2);
        inputcm.value=(valNum/0.032808).toFixed();
        inputYards.value=(valNum*0.33333).toFixed(2);
        inputKilometers.value=(valNum/3280.8).toFixed(5);
        inputMiles.value=(valNum*0.00018939).toFixed(5);
      }
      if (source=="inputMeters") {
        inputFeet.value=(valNum*3.2808).toFixed(2);
        inputInches.value=(valNum*39.370).toFixed(2);
        inputcm.value=(valNum/0.01).toFixed();
        inputYards.value=(valNum*1.0936).toFixed(2);
        inputKilometers.value=(valNum/1000).toFixed(5);
        inputMiles.value=(valNum*0.00062137).toFixed(5);
      }
      if (source=="inputInches") {
        inputFeet.value=(valNum*0.083333).toFixed(3);
        inputMeters.value=(valNum/39.370).toFixed(3);
        inputcm.value=(valNum/0.39370).toFixed(2);
        inputYards.value=(valNum*0.027778).toFixed(3);
        inputKilometers.value=(valNum/39370).toFixed(6);
        inputMiles.value=(valNum*0.000015783).toFixed(6);
      }
      if (source=="inputcm") {
        inputFeet.value=(valNum*0.032808).toFixed(3);
        inputMeters.value=(valNum/100).toFixed(3);
        inputInches.value=(valNum*0.39370).toFixed(2);
        inputYards.value=(valNum*0.010936).toFixed(3);
        inputKilometers.value=(valNum/100000).toFixed(6);
        inputMiles.value=(valNum*0.0000062137).toFixed(6);
      }
      if (source=="inputYards") {
        inputFeet.value=(valNum*3).toFixed();
        inputMeters.value=(valNum/1.0936).toFixed(2);
        inputInches.value=(valNum*36).toFixed();
        inputcm.value=(valNum/0.010936).toFixed();
        inputKilometers.value=(valNum/1093.6).toFixed(5);
        inputMiles.value=(valNum*0.00056818).toFixed(5);
      }
      if (source=="inputKilometers") {
        inputFeet.value=(valNum*3280.8).toFixed();
        inputMeters.value=(valNum*1000).toFixed();
        inputInches.value=(valNum*39370).toFixed();
        inputcm.value=(valNum*100000).toFixed();
        inputYards.value=(valNum*1093.6).toFixed();
        inputMiles.value=(valNum*0.62137).toFixed(2);
      }
      if (source=="inputMiles") {
        inputFeet.value=(valNum*5280).toFixed();
        inputMeters.value=(valNum/0.00062137).toFixed();
        inputInches.value=(valNum*63360).toFixed();
        inputcm.value=(valNum/0.0000062137).toFixed();
        inputYards.value=(valNum*1760).toFixed();
        inputKilometers.value=(valNum/0.62137).toFixed(2);
      }
    }
</script>

@endsection
