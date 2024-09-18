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

        <div class="custom--btn btn-block btn btn__dark button__lg btn__bordered text-center mb-lg-4 mb-3 rounded cursor-none">
            <div class="row">
                <div class="col">
                    <div class="d-flex flex-column">
                        <span class="segments py-4 h1" id="hour">00</span>
                        <span class="pb-3">{{ trans('webtools/tools/stop-watch.labelHour') }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column">
                        <span class="segments py-4 h1" id="minute">00</span>
                        <span class="pb-3">{{ trans('webtools/tools/stop-watch.labelMinute') }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column">
                        <span class="segments py-4 h1" id="second">00</span>
                        <span class="pb-3">{{ trans('webtools/tools/stop-watch.labelSecond') }}</span>
                    </div>
                </div>
                <div class="col">
                    <div class="d-flex flex-column">
                        <span class="segments py-4 h1" id="millisecond">00</span>
                        <span class="pb-3">{{ trans('webtools/tools/stop-watch.labelMillisecond') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-lg-4 mb-3">
            <button class="btn custom--btn button__lg mx-1" id="start_pause_button" onclick="startTimer()">{{ trans('webtools/tools/stop-watch.btnStart') }}</button>
            <button class="btn custom--btn button__lg mx-1 btn__dark" id="stop_button" onclick="stopTimer()">{{ trans('webtools/tools/stop-watch.btnStop') }}</button>
            <button class="btn custom--btn button__lg mx-1 btn__bordered" id="reset_button" onclick="clearTimer()">{{ trans('webtools/tools/stop-watch.btnReset') }}</button>
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
    //Object to hold and supply time data to all functions
    timeMonitor = {};

    // Added to monitor if already the timer event is running
    timeMonitor.ifStarted = false;

    // Anchor to specific IDs
    let hour = document.getElementById("hour");
    let minute = document.getElementById("minute");
    let second = document.getElementById("second");
    let millisecond = document.getElementById("millisecond");

    // Function to Monitor Realtime display of timer
    function displayTimer() {

        // Initilized all variables needed to calculate and display time
        let hours = '00', minutes = '00', seconds = '00', milliseconds = "00";

        // Retrieving current time stamp by JS Date object
        let current_time = new Date().getTime();

        // Calculating time difference between starting time and current time
        timeMonitor.time_differ = current_time - timeMonitor.start_time;

        // Milliseconds
        if (timeMonitor.time_differ > 10) {

            milliseconds = Math.floor((timeMonitor.time_differ % 1000) / 10);

            // Padding zeros at start
            if (milliseconds < 10) {
                milliseconds = `0${milliseconds}`;
            }

            // Updating Millisecond on display
            millisecond.innerHTML = `<span> ${milliseconds} </span>`;
        }

        // Seconds
        if (timeMonitor.time_differ > 1000) {

            seconds = Math.floor(timeMonitor.time_differ / 1000);

            if (seconds > 60) {
                seconds = seconds % 60;
            }

            if (seconds < 10) {
                seconds = `0${seconds}`;
            }

            second.innerHTML = `<span> ${seconds} </span>`;
        }

        // Minutes
        if (timeMonitor.time_differ > 60000) {

            minutes = Math.floor(timeMonitor.time_differ / 60000);

            if (minutes > 60) {
                minutes = minutes % 60;
            }

            if (minutes < 10) {
                minutes = `0${minutes}`;
            }

            minute.innerHTML = `<span> ${minutes} </span>`;
        }

        // Hours
        if (timeMonitor.time_differ > 3600000) {

            hours = Math.floor(T.difference / 3600000);

            if (hours < 10) {
                hours = `0${hours}`;
            }

            hour.innerHTML = `<span> ${hours} </span>`;
        }

    }

    function startTimer() {

        if (!timeMonitor.ifStarted) {
            // Note the start time
            timeMonitor.start_time = new Date().getTime();

            // Handles if timer was already intialized
            if (timeMonitor.time_differ > 0) {
                timeMonitor.start_time = timeMonitor.start_time - timeMonitor.time_differ;
            }

            // Update the display after every 10 millisecond and saving timer ID to manipulate later
            timeMonitor.timer_id = setInterval(function () {
                displayTimer()
            }, 10);

            timeMonitor.ifStarted = true;
        }
    }

    function stopTimer() {
        // Pause the timer
        timeMonitor.ifStarted = false;
        clearInterval(timeMonitor.timer_id);
    }

    function clearTimer() {
        //Making new start
        clearInterval(timeMonitor.timer_id);
        timeMonitor.ifStarted = false;
        timeMonitor.time_differ = 0;

        // Reset timer segments to zero
        hour.innerHTML = `<span>00</span>`;
        minute.innerHTML = `<span>00</span>`;
        second.innerHTML = `<span>00</span>`;
        millisecond.innerHTML = `<span>00</span>`;
    }

</script>

@endsection
