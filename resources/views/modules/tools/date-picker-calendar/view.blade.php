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

        <div class="calendar-container">
            <div class="calendar">
              <div class="year-header">
                <span class="left-button fa fa-chevron-left" id="prev"> </span>
                <span class="year" id="label"></span>
                <span class="right-button fa fa-chevron-right" id="next"> </span>
              </div>
              <table class="months-table w-100">
                <tbody>
                  <tr class="months-row">
                    <td class="month">Jan</td>
                    <td class="month">Feb</td>
                    <td class="month">Mar</td>
                    <td class="month">Apr</td>
                    <td class="month">May</td>
                    <td class="month">Jun</td>
                    <td class="month">Jul</td>
                    <td class="month">Aug</td>
                    <td class="month">Sep</td>
                    <td class="month">Oct</td>
                    <td class="month">Nov</td>
                    <td class="month">Dec</td>
                  </tr>
                </tbody>
              </table>

              <table class="days-table w-100">
                <td class="day">Sun</td>
                <td class="day">Mon</td>
                <td class="day">Tue</td>
                <td class="day">Wed</td>
                <td class="day">Thu</td>
                <td class="day">Fri</td>
                <td class="day">Sat</td>
              </table>
              <div class="frame">
                <table class="dates-table w-100">
                <tbody class="tbody">
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    (function($) {

"use strict";

// Setup the calendar with the current date
$(document).ready(function(){
var date = new Date();
var today = date.getDate();
// Set click handlers for DOM elements
$(".right-button").click({date: date}, next_year);
$(".left-button").click({date: date}, prev_year);
$(".month").click({date: date}, month_click);
$("#add-button").click({date: date}, new_event);
// Set current month as active
$(".months-row").children().eq(date.getMonth()).addClass("active-month");
init_calendar(date);
var events = check_events(today, date.getMonth()+1, date.getFullYear());
show_events(events, months[date.getMonth()], today);
});

// Initialize the calendar by appending the HTML dates
function init_calendar(date) {
$(".tbody").empty();
$(".events-container").empty();
var calendar_days = $(".tbody");
var month = date.getMonth();
var year = date.getFullYear();
var day_count = days_in_month(month, year);
var row = $("<tr class='table-row'></tr>");
var today = date.getDate();
// Set date to 1 to find the first day of the month
date.setDate(1);
var first_day = date.getDay();
// 35+firstDay is the number of date elements to be added to the dates table
// 35 is from (7 days in a week) * (up to 5 rows of dates in a month)
for(var i=0; i<35+first_day; i++) {
    // Since some of the elements will be blank,
    // need to calculate actual date from index
    var day = i-first_day+1;
    // If it is a sunday, make a new row
    if(i%7===0) {
        calendar_days.append(row);
        row = $("<tr class='table-row'></tr>");
    }
    // if current index isn't a day in this month, make it blank
    if(i < first_day || day > day_count) {
        var curr_date = $("<td class='table-date nil'>"+"</td>");
        row.append(curr_date);
    }
    else {
        var curr_date = $("<td class='table-date'>"+day+"</td>");
        var events = check_events(day, month+1, year);
        if(today===day && $(".active-date").length===0) {
            curr_date.addClass("active-date");
            show_events(events, months[month], day);
        }
        // If this date has any events, style it with .event-date
        if(events.length!==0) {
            curr_date.addClass("event-date");
        }
        // Set onClick handler for clicking a date
        curr_date.click({events: events, month: months[month], day:day}, date_click);
        row.append(curr_date);
    }
}
// Append the last row and set the current year
calendar_days.append(row);
$(".year").text(year);
}

// Get the number of days in a given month/year
function days_in_month(month, year) {
var monthStart = new Date(year, month, 1);
var monthEnd = new Date(year, month + 1, 1);
return (monthEnd - monthStart) / (1000 * 60 * 60 * 24);
}

// Event handler for when a date is clicked
function date_click(event) {
$(".events-container").show(250);
$("#dialog").hide(250);
$(".active-date").removeClass("active-date");
$(this).addClass("active-date");
show_events(event.data.events, event.data.month, event.data.day);
};

// Event handler for when a month is clicked
function month_click(event) {
$(".events-container").show(250);
$("#dialog").hide(250);
var date = event.data.date;
$(".active-month").removeClass("active-month");
$(this).addClass("active-month");
var new_month = $(".month").index(this);
date.setMonth(new_month);
init_calendar(date);
}

// Event handler for when the year right-button is clicked
function next_year(event) {
$("#dialog").hide(250);
var date = event.data.date;
var new_year = date.getFullYear()+1;
$("year").html(new_year);
date.setFullYear(new_year);
init_calendar(date);
}

// Event handler for when the year left-button is clicked
function prev_year(event) {
$("#dialog").hide(250);
var date = event.data.date;
var new_year = date.getFullYear()-1;
$("year").html(new_year);
date.setFullYear(new_year);
init_calendar(date);
}

// Event handler for clicking the new event button
function new_event(event) {
// if a date isn't selected then do nothing
if($(".active-date").length===0)
    return;
// remove red error input on click
$("input").click(function(){
    $(this).removeClass("error-input");
})
// empty inputs and hide events
$("#dialog input[type=text]").val('');
$("#dialog input[type=number]").val('');
$(".events-container").hide(250);
$("#dialog").show(250);
// Event handler for cancel button
$("#cancel-button").click(function() {
    $("#name").removeClass("error-input");
    $("#count").removeClass("error-input");
    $("#dialog").hide(250);
    $(".events-container").show(250);
});
// Event handler for ok button
$("#ok-button").unbind().click({date: event.data.date}, function() {
    var date = event.data.date;
    var name = $("#name").val().trim();
    var count = parseInt($("#count").val().trim());
    var day = parseInt($(".active-date").html());
    // Basic form validation
    if(name.length === 0) {
        $("#name").addClass("error-input");
    }
    else if(isNaN(count)) {
        $("#count").addClass("error-input");
    }
    else {
        $("#dialog").hide(250);
        console.log("new event");
        new_event_json(name, count, date, day);
        date.setDate(day);
        init_calendar(date);
    }
});
}

// Adds a json event to event_data
function new_event_json(name, count, date, day) {
var event = {
    "occasion": name,
    "invited_count": count,
    "year": date.getFullYear(),
    "month": date.getMonth()+1,
    "day": day
};
event_data["events"].push(event);
}

// Display all events of the selected date in card views
function show_events(events, month, day) {
// Clear the dates container
$(".events-container").empty();
$(".events-container").show(250);
console.log(event_data["events"]);
// If there are no events for this date, notify the user
if(events.length===0) {
    var event_card = $("<div class='event-card'></div>");
    var event_name = $("<div class='event-name'>There are no events planned for "+month+" "+day+".</div>");
    $(event_card).css({ "border-left": "10px solid #FF1744" });
    $(event_card).append(event_name);
    $(".events-container").append(event_card);
}
else {
    // Go through and add each event as a card to the events container
    for(var i=0; i<events.length; i++) {
        var event_card = $("<div class='event-card'></div>");
        var event_name = $("<div class='event-name'>"+events[i]["occasion"]+":</div>");
        var event_count = $("<div class='event-count'>"+events[i]["invited_count"]+" Invited</div>");
        if(events[i]["cancelled"]===true) {
            $(event_card).css({
                "border-left": "10px solid #FF1744"
            });
            event_count = $("<div class='event-cancelled'>Cancelled</div>");
        }
        $(event_card).append(event_name).append(event_count);
        $(".events-container").append(event_card);
    }
}
}

// Checks if a specific date has any events
function check_events(day, month, year) {
var events = [];
for(var i=0; i<event_data["events"].length; i++) {
    var event = event_data["events"][i];
    if(event["day"]===day &&
        event["month"]===month &&
        event["year"]===year) {
            events.push(event);
        }
}
return events;
}

// Given data for events in JSON format
var event_data = {
"events": [
{
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10,
    "cancelled": true
},
{
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10,
    "cancelled": true
},
    {
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10,
    "cancelled": true
},
{
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10
},
    {
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10,
    "cancelled": true
},
{
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10
},
    {
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10,
    "cancelled": true
},
{
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10
},
    {
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10,
    "cancelled": true
},
{
    "occasion": " Repeated Test Event ",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 10
},
{
    "occasion": " Test Event",
    "invited_count": 120,
    "year": 2020,
    "month": 5,
    "day": 11
}
]
};

const months = [
"January",
"February",
"March",
"April",
"May",
"June",
"July",
"August",
"September",
"October",
"November",
"December"
];

})(jQuery);

</script>
@endsection
