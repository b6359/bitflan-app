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
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="custom-label">{{ trans('webtools/tools/count-down-timer.labelHour') }}</label>
                        <input type="number" class="custom-input" id="inputh" placeholder="{{ trans('webtools/tools/count-down-timer.labelHour') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="custom-label">{{ trans('webtools/tools/count-down-timer.labelMunite') }}</label>
                        <input type="number" class="custom-input" id="inputm" placeholder="{{ trans('webtools/tools/count-down-timer.labelMunite') }}">
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        <label for="" class="custom-label">{{ trans('webtools/tools/count-down-timer.labelSecond') }}</label>
                        <input type="number" class="custom-input" id="inputs" placeholder="{{ trans('webtools/tools/count-down-timer.labelSecond') }}">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-center mb-3">
                <button class="btn custom--btn button__lg mx-1" id="btn-start" onclick="start_counting()">{{ trans('webtools/tools/count-down-timer.btnStart') }}</button>
                <button class="btn custom--btn button__lg mx-1 btn__dark" id="btn-pause" onclick="pause_counting()">{{ trans('webtools/tools/count-down-timer.btnPause') }}</button>
                {{-- <button class="btn custom--btn button__lg mx-1 btn__dark" id="btn-stop" onclick="end_counting()">{{ trans('webtools/tools/count-down-timer.btnStop') }}</button> --}}
                <button class="btn custom--btn button__lg mx-1 btn__bordered" id="btn-reset" onclick="end_reset()">{{ trans('webtools/tools/count-down-timer.btnReset') }}</button>
            </div>
            <div class="custom--btn btn-block btn btn__dark button__lg btn__bordered text-center mb-3 rounded cursor-default d-none" id="currenttm"><div id="currentTime" class="h1 mb-0 py-4">00 h : 00 m : 00 s</div></div>

            <div class="alert rounded-pill p-l-25 p-r-25 bg-danger border-0 text-center d-none" id="type-error"><h5 class="m-0 text-light">{{ trans('webtools/tools/count-down-timer.type-error') }}</h5></div>
            <div class="alert rounded-pill p-l-25 p-r-25 bg-danger border-0 text-center d-none" id="type-time-stop"><h5 class="m-0 text-light">{{ trans('webtools/tools/count-down-timer.type-time-stop') }}</h5></div>
            <div class="alert rounded-pill p-l-25 p-r-25 bg-primary border-0 text-center d-none" id="type-time-up"><h5 class="m-0 text-light">{{ trans('webtools/tools/count-down-timer.type-time-up') }}</h5></div>

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

    // initialize button state
    document.getElementById("btn-pause").disabled = true;
    // document.getElementById("btn-stop").disabled = true;
    document.getElementById("btn-reset").disabled = false;

    // define global variables
    var timer = null; // store the returned value of timer
    var h = 0; // store the value of hour
    var m = 0; // store the value of minute
    var s = 0; // store the value of second

    // restrict the input range of hour, minute and second numbers
    var inputh = document.getElementById("inputh");
    inputh.addEventListener("input", function() {
        inputh.value = parseInt(inputh.value||0);
        if (inputh.value > 24) inputh.value = 24;
        if (inputh.value < 0) inputh.value = 0;
    });

    var inputm = document.getElementById("inputm");
    inputm.addEventListener("input", function() {
        inputm.value = parseInt(inputm.value||0);
        if (inputm.value > 59) inputm.value = 59;
        if (inputm.value < 0) inputm.value = 0;
    });

    var inputs = document.getElementById("inputs");
    inputs.addEventListener("input", function() {
        inputs.value = parseInt(inputs.value||0);
        if (inputs.value > 59) inputs.value = 59;
        if (inputs.value < 0) inputs.value = 0;
    });

    // define a function
    // start the timer
    function start_counting() {
        // get the time entered or set a default value
        h = +document.getElementById("inputh").value || h;
        m = +document.getElementById("inputm").value || m;
        s = +document.getElementById("inputs").value || s;

        // check for illegal input
        if (
            (h == 0 && m == 0 && s == 0) ||
            (h < 0 || m < 0 || s < 0)
        ) {
            document.getElementById("type-error").classList.remove("d-none");
            return;
        }

        // start the timer
        timer = setInterval(counting, 1000);
        // optimize the format of hour, minute, and second numbers
        h = h.toString();
        m = m.toString();
        s = s.toString();
        if (h.match(/^\d$/)) { // If the hour is a single digit, add 0 in the front
            h = "0" + h;
        }
        if (m.match(/^\d$/)) { // If the minute is a single digit, add 0 in the front
            m = "0" + m;
        }
        if (s.match(/^\d$/)) { // If the second is a single digit, add 0 in the front
            s = "0" + s;
        }

        // change the state of buttons and input fields to prohibit users from re-entering numbers
        document.getElementById("btn-start").disabled = true;
        document.getElementById("btn-pause").disabled = false;
        // document.getElementById("btn-stop").disabled = false;
        document.getElementById("btn-reset").disabled = true;
        document.getElementById("inputh").disabled = true;
        document.getElementById("inputm").disabled = true;
        document.getElementById("inputs").disabled = true;
        document.getElementById("type-error").classList.add("d-none");
        document.getElementById("currenttm").classList.remove("d-none");
        document.getElementById("type-time-stop").classList.add("d-none");
        document.getElementById("type-time-up").classList.add("d-none");
    }

    // pause the timer
    function pause_counting() {
        // change the state of buttons and input fields to allow users to re-enter numbers
        document.getElementById("btn-start").disabled = false;
        document.getElementById("btn-pause").disabled = true;
        // document.getElementById("btn-stop").disabled = false;
        document.getElementById("btn-reset").disabled = false;
        document.getElementById("inputh").disabled = false;
        document.getElementById("inputm").disabled = false;
        document.getElementById("inputs").disabled = false;

        // pause the timer
        clearInterval(timer);
    }

    // stop the timer
    function end_counting() {
        // change the state of buttons and input fields to allow users to re-enter numbers
        document.getElementById("btn-start").disabled = false;
        document.getElementById("btn-pause").disabled = true;
        // document.getElementById("btn-stop").disabled = true;
        document.getElementById("btn-reset").disabled = true;
        document.getElementById("inputh").disabled = false;
        document.getElementById("inputm").disabled = false;
        document.getElementById("inputs").disabled = false;

        // stop the timer
        clearInterval(timer);

        // reset the time variables
        h = 0;
        m = 0;
        s = 0;
        // document.getElementById("type-time-stop").classList.remove("d-none");
    }
    // Reset the timer
    function end_reset() {
        // change the state of buttons and input fields to allow users to re-enter numbers
        document.getElementById("btn-start").disabled = false;
        document.getElementById("btn-pause").disabled = false;
        // document.getElementById("btn-stop").disabled = true;
        document.getElementById("inputh").disabled = false;
        document.getElementById("inputm").disabled = false;
        document.getElementById("inputs").disabled = false;

        document.getElementById("inputh").value = 0;
        document.getElementById("inputm").value = 0;
        document.getElementById("inputs").value = 0;

        document.getElementById("currenttm").classList.add("d-none");

        h = 0;
        m = 0;
        s = 0;

        document.getElementById("currentTime").innerHTML = "00 h : 00 m : 00 s"

    }

    // countdown
    function counting() {
        // check if the second is 0
        if (s == 0) {
            // check if the minute is 0 when the second is 0
            if (m == 0) {
                // the entered time has already been checked for legality before starting the timer, so there is no need to check the value of the variable h again here
                h--;
                m = 59;
                s = 59;
            } else {
                // when the minute is not 0, the minute minus 1 and the second becomes 59
                m--;
                s = 59;
            }
        } else {
            // when the second is not 0, the second minus 1
            s--;
        }

        // display current time
        document.getElementById("currentTime").innerHTML = h + " h " + ": " + m + " m " + ": " + s + " s";
        document.getElementById("inputh").value = h;
        document.getElementById("inputm").value = m;
        document.getElementById("inputs").value = s;

        // check if the second is 0
        if (s == 0) {
            // when the second is 0, check if the minute is 0
            if (m == 0) {
                // when the minute is 0, check if the hour is 0
                if (h == 0) {
                    // when the hour is 0, stop the timer
                    // stop the timer
                    end_counting();
                    // execute popup in the next event loop to prevent it from blocking DOM rendering
                    setTimeout(function () {
                        document.getElementById("type-time-up").classList.remove("d-none");
                    }, 0);
                    return;
                }
            }
        }
    }
</script>

@endsection
