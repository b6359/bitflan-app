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

        <div class="output form-group">
            <input type="text" class="ans custom-input" readonly name="">
        </div>

        <hr>

        <div class="row actions">
            <div class="col-lg-6 order-lg-2">
                <div class="row">
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='*('>(</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value=')'>)</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='%'>%</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn__dark btn button__md btn-op" data-value='ce'>CE</button></div>

                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='7'>7</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='8'>8</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='9'>9</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='/'>&#x00f7;</button></div>

                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='4'>4</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='5'>5</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='6'>6</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='*'>&times;</button></div>

                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='3'>3</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='2'>2</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='1'>1</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='-'>-</button></div>

                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='.'>.</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn__bordered" data-value='0'>0</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='='>=</button></div>
                    <div class="col-3"><button class="custom--btn btn-block my-2 rounded-3 btn button__md btn-op" data-value='+'>+</button></div>
                </div>
            </div>
            <div class="col-lg-6 order-lg-1">
                <div class="row">
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md opacity-0 d-none d-lg-flex">&nbsp;</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md opacity-0 d-none d-lg-flex">&nbsp;</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md opacity-0 d-none d-lg-flex">&nbsp;</button></div>


                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='inv'>Inv</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='sin'>sin</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='ln'>ln</button></div>

                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='*3.14'>&pi;</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='cos'>cos</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='log'>log</button></div>

                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='e'>e</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='tan'>tan</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='radic'>&radic;</button></div>

                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='exp'>EXP</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='x^2'>x&#xb2;</button></div>
                    <div class="col-4"><button class="custom--btn btn-block my-2 rounded-3 btn btn__dark button__md btn-op" data-value='**'>x&#94;</button></div>
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
    const actions = document.querySelector('.actions');
	const ans = document.querySelector('.ans');
	console.log(actions);
	console.log(ans);
	let expression = '';
	let a=0;
	actions.addEventListener('click', (e) => {
		console.log(e.target);
		const value = e.target.dataset['value'];

		if(value !== undefined) {
			// I'm good to go.
			if(value == 'ce') {
				expression = '';
				ans.value = 0;
				return true;
			}
			else if(value == 'x^2'){
				expression =square();
			}

			else if(value == 'radic'){
				expression = Math.sqrt(expression);
			}
			else if(value == 'log'){
				expression = Math.log(expression);
			}
			else if(value == 'sin'){
				expression = Math.sin(expression);
			}
			else if(value == 'cos'){
				expression = Math.cos(expression);
			}
			else if(value == 'tan'){
				expression = Math.tan(expression);
			}

			else if(value == '=') {
				const answer = eval(expression);
				expression = answer;

			} else {
				expression += value;
			}

			if(expression == undefined) {
				expression = '';
				ans.value = 0;
			} else {
				ans.value = expression;
			}
			// expression += value;


		}

	});
	const square =()=> {
			return eval(expression*expression);
	}
</script>

@endsection
