@extends('layouts.app')

@section('content')
    <section id="slider" class="slider-parallax full-screen dark error404-wrap">

        <div class="slider-parallax-inner">

            <div class="container vertical-middle center clearfix">

                <div class="error404">404</div>

                <div class="heading-block nobottomborder">
                    <h4>Ooopps.! The Page you were looking for, couldn't be found.</h4>
                    <span>PREMIER PROPERTIES</span>
                </div>


            </div>

            <div class="video-wrap">
                <video poster={{asset("images/explore.jpg")}} preload="auto" loop autoplay muted>
                    <source src={{asset('images/explore.mp4')}} type='video/mp4'/>
                    <source src={{asset('images/explore.webm')}} type='video/webm'/>
                </video>
                <div class="video-overlay" style="background-color: rgba(0,0,0,0.3);"></div>
            </div>

        </div>

    </section>
@endsection
