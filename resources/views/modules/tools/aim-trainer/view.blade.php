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
        <div class="screen-main">
            <div class="screen">
                <h1 class="mb-lg-5 mb-4">{{ trans('webtools/tools/aim-trainer.title_Aim_Training') }}</h1>
                <a href="#" class="start btn custom--btn button__lg" id="start">{{ trans('webtools/tools/aim-trainer.button_Start_Now') }}</a>
            </div>

            <div class="screen">
                <h1>{{ trans('webtools/tools/aim-trainer.title_Select_Time') }}</h1>
                <ul class="time-list" id="timeList">
                    <li>
                        <button class="time-btn custom--btn btn-block btn btn__dark button__lg btn__bordered" data-time="15">15 {{ trans('webtools/tools/aim-trainer.label_sec') }}</button>
                    </li>
                    <li>
                        <button class="time-btn custom--btn btn-block btn btn__dark button__lg btn__bordered" data-time="25">25 {{ trans('webtools/tools/aim-trainer.label_sec') }}</button>
                    </li>
                    <li>
                        <button class="time-btn custom--btn btn-block btn btn__dark button__lg btn__bordered" data-time="35">35 {{ trans('webtools/tools/aim-trainer.label_sec') }}</button>
                    </li>
                    <li>
                        <button class="time-btn custom--btn btn-block btn btn__dark button__lg btn__bordered" data-time="45">45 {{ trans('webtools/tools/aim-trainer.label_sec') }}</button>
                    </li>
                </ul>
            </div>

            <div class="screen">
                <h3>{{ trans('webtools/tools/aim-trainer.label_Left') }} <span id="time" class="badge bg-dark ms-1">00:00</span></h3>
                <div class="board" id="board"></div>
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
    const startBtn = document.querySelector('#start')
    const screens = document.querySelectorAll('.screen')
    const timeBtn = document.querySelector('#timeList')
    const timeEl = document.querySelector('#time')
    const board= document.querySelector('#board')
    const colors = ['#FBCEB1', '#FDD9B5', '#CD9575', '#79553D',
                    '#9966CC', '#CD9575', '#A8E4A0', '#77DDE7',
        '#ABCDEF', '#F0D698', '#D87093', '#DD80CC']

    let time = 0
    let score = 0

    startBtn.addEventListener('click', (event) => {
        event.preventDefault()
        screens[0].classList.add('up')
    })

    timeBtn.addEventListener('click', event => {
        if (event.target.classList.contains('time-btn')) {
            time = parseInt(event.target.getAttribute('data-time'))
            screens[1].classList.add('up')
            startGame()
        }
    })

    board.addEventListener('click', event => {
        if (event.target.classList.contains('circle')) {
            score++
            event.target.remove()
            createRandomCircle()
        }
    })

    function startGame() {
        setInterval(decreaseTime, 1000)
        createRandomCircle()
        setTime(time)
    }

    function decreaseTime() {
        if (time === 0) {
            finishGame()
        } else {
            let current = --time
            if (current < 10) {
                current = `0${current}`
            }
            setTime(current)
        }
    }

    function setTime(value) {
        timeEl.innerHTML = `00:${value}`
    }

    function finishGame() {
        timeEl.parentNode.classList.add('hide')
        board.innerHTML = `<h1>Check: <span class="primary">${score}</span></h1>`
    }

    function createRandomCircle() {
        const circle = document.createElement('div')

        const size = getRandomNumber(10, 60)
        const {width, height} = board.getBoundingClientRect()

        const x = getRandomNumber(0, width - size)
        const y = getRandomNumber(0, height - size)

        circle.classList.add('circle')
        circle.style.width = `${size}px`
        circle.style.height = `${size}px`
        circle.style.top = `${y}px`
        circle.style.left = `${x}px`
        circle.style.backgroundColor = getRandomColor()

        console.log(circle.style.backgroundColor = getRandomColor())

        board.append(circle)
    }

    function getRandomNumber(min, max) {
        return Math.round(Math.random() * (max - min) + min)
    }

    function getRandomColor() {
        return colors[Math.floor(Math.random() * colors.length)]
    }


    // Hacking your own game
    // To try, when the time report goes,
    // call the function winTheGame() in the console and press Enter
    function winTheGame() {
        function kill() {
            const circle = document.querySelector('.circle')
            if (circle) {
                circle.click()
            }
        }
        setInterval(kill, 1)
    }
</script>

@endsection
