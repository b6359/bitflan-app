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
        <div class="logo-featured-image">
            <label for="finput" class="logo-featured-label">
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
                <div class="text">{{ trans('webtools/tools/image-to-grayscale.text_add_image') }}</div>
            </label>
            <input type="file" multiple="false" accept="image/*" id="finput" onchange="uploadFile()" name="imageLoader">
        </div>
        <div class="row">
            <div class="col-lg-6">
                <canvas id="canvas" class="image-rotate-canvas"></canvas>
            </div>
            <div class="col-lg-6">
                <canvas id="gray_canvas" class="image-rotate-canvas"></canvas>
            </div>
            <div class="col-12">
                <div class="d-flex">
                    <button type="button" class="btn custom--btn button__lg" onclick="makeGray()">{{ trans('webtools/tools/image-to-grayscale.text_convert') }}</button>
                    <a href="#" class="btn custom--btn button__lg btn__dark ms-2" id="imgsave">{{ trans('webtools/tools/image-to-grayscale.btn_save') }}</a>
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
<script src= "https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
<script>
    var image;
    var gray_image;

    var link = document.getElementById("imgsave");
    // var link = "";
    let imgname = "";
    var fdfd = "";

    function uploadFile(){
    var canvas=document.getElementById("canvas");
    var file=document.getElementById("finput");
    /* The SimpleImage library was included into the HTML code using the script tag, to be able to use it in the javascropt code*/
    image= new SimpleImage(file); // do not write var image, because we are using the global image variable created outside the function
    gray_image = new SimpleImage(file);
    image.drawTo(canvas);
    }

    function makeGray() {
    // For loop to change each pixel of the image to a grayscale value while maintaining the brightness
    for (var pixel of gray_image.values()){
        // get the pixel's RGB values
        var red= pixel.getRed();
        var green= pixel.getGreen();
        var blue= pixel.getBlue();
        // Calculate the average value
        average= (red+green+blue)/3;
        // Assign this average vale to the pixel's RGB values
        pixel.setRed(average);
        pixel.setGreen(average);
        pixel.setBlue(average);
    } // End of for loop
    var canvas=document.getElementById("gray_canvas");
    gray_image.drawTo(canvas, "MyTest");
    imgname = gray_image.id;
    imglnk = canvas.toDataURL("image/png");
    console.log(imgname);
    }

    link.addEventListener("click", function () {
    link.setAttribute("download", imgname);
    link.setAttribute("href", imglnk);
    });
</script>

@endsection
