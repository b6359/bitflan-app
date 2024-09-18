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
                <div class="logo-featured-image min-h-100">
                    <label for="imageLoader" class="logo-featured-label">
                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="67.173" height="56.87" viewBox="0 0 67.173 56.87">
                                <g id="image-outline" transform="translate(-1.787 -4.5)">
                                    <path id="Path_3226" data-name="Path 3226" d="M10.76,5.625H59.99a7.385,7.385,0,0,1,7.385,7.385V52.394a7.385,7.385,0,0,1-7.385,7.385H10.76a7.385,7.385,0,0,1-7.385-7.385V13.01A7.385,7.385,0,0,1,10.76,5.625Z" fill="none" stroke="#4C3FF2" stroke-linejoin="round" stroke-width="2.25"></path>
                                    <path id="Path_3227" data-name="Path 3227" d="M31.221,15.048A4.923,4.923,0,1,1,26.3,10.125,4.923,4.923,0,0,1,31.221,15.048Z" transform="translate(21.385 5.346)" fill="none" stroke="#4C3FF2" stroke-miterlimit="10" stroke-width="2.25"></path>
                                    <path id="Path_3228" data-name="Path 3228" d="M42.76,31.952,28.811,18.03a4.923,4.923,0,0,0-6.75-.2L3.375,34.447" transform="translate(0 13.025)" fill="none" stroke="#4C3FF2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"></path>
                                    <path id="Path_3229" data-name="Path 3229" d="M15.75,41.463,34.725,22.488a4.923,4.923,0,0,1,6.632-.309l11.317,9.437" transform="translate(14.702 18.316)" fill="none" stroke="#4C3FF2" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.25"></path>
                                </g>
                            </svg>
                        </div>
                        <div class="text">{{ trans('webtools/tools/image-rotate.text_add_image') }}</div>
                    </label>
                    <input type="file" id="imageLoader" name="imageLoader">
                </div>
            </div>
            <div class="col-lg-6">
                <h4 class="pt-3 pt-lg-0">{{ trans('webtools/tools/image-rotate.text_drag_drop') }}</h4>
                <canvas class="image-rotate-canvas"></canvas>
                <div class="d-flex">
                    <button type="button" class="btn custom--btn button__lg" id="imgrotatebtn">{{ trans('webtools/tools/image-rotate.btn_rotate') }}</button>
                    <a href="#" class="btn custom--btn button__lg btn__dark ms-2" id="imgsave">{{ trans('webtools/tools/image-rotate.btn_save') }}</a>
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
    var img = new Image;
    var canvas = document.querySelector("canvas");
    var context = canvas.getContext("2d");
    var imgbr = document.getElementById("imageLoader");
    var link = document.getElementById("imgsave");
    var imgrotatebtn = document.getElementById("imgrotatebtn");
    let imgname = "";

    imgbr.addEventListener('change', function(e){
    file = e.target.files[0];
    if(file.type.indexOf("image/") !== -1) {
        img.src = URL.createObjectURL(file);
        imgname = file.name;
    }
    });

    canvas.ondragover = function () {
    return false;
    };
    canvas.ondragend = function () {
    return false;
    };

    canvas.ondrop = function(evt) {
    evt.preventDefault();
    file = evt.dataTransfer.files[0];
    if(file.type.indexOf("image/") !== -1) {
        imgname = file.name;
        img.src = URL.createObjectURL(file);
    }
    };

    img.onload = function(evt) {
    // set the canvas to be the same size as the image
    canvas.width = img.width;
    canvas.height = img.height;
    context.drawImage(img,0,0,img.width, img.height);
    };

    var currentAngle = 0;
    var rotateImage = function() {
    currentAngle += 90;

    // swap the height and width
    canvas.height = canvas.width + (canvas.width = canvas.height, 0);

    context.save()
    // rotate the canvas center
    context.translate(canvas.width / 2, canvas.height / 2);
    context.rotate(currentAngle * Math.PI / 180);
    context.drawImage(img,
                        -img.width / 2,
                        -img.height / 2);
    context.restore();
    console.log(canvas.toDataURL("image/jpeg"));
    }

    imgrotatebtn.addEventListener("click", rotateImage);

    link.addEventListener("click", function(){
    link.setAttribute('download', imgname);
    link.setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"));
    link.click();
    });
</script>

@endsection
