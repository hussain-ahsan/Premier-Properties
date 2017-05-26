@extends('layouts.app')
@section('content')
@include('layouts.slider')
        <!-- Content
		============================================= -->

<section id="content">
    <div class="content-wrap index-pg">

        <!--premierproperties-profile section start-->
        <div class="container">
            <section class="premierproperties-profile fadeIn animated" data-delay="400" data-animate="fadeIn">
                <div class="col-md-7">
                    <h1>Profile</h1>
                    <h3>Expertise & Creativity</h3>
                    <p>At Premier we build on a unique combination of comprehensive market knowledge, innovative / out of the box approach and a wealth of accumulated industry expertise. Our collaborative operating structure complemented by a hands-on approach ensures top performance across the spectrum of activities. The Premier team combines extensive capital market expertise, real estate operating and development experience coupled with deep financial agility and resources to produce superior results on our investments.</p>
                </div>
            </section>
        </div>
        <!--premierproperties-profile section end-->
        <!--strength section start-->
        <section class="strength fadeIn animated" data-delay="400" data-animate="fadeIn">
            <div class="container">
                <div class="row">
                    <div class="col-md-4"><img alt="slider image" src="images/strength1.png" width="190" height="191">
                        <h3>Strength I</h3>
                        <p>Flexibility – Premier’s ability to structure transactions and provide services for each unique requirement, situation and condition. We offer diverse opportunities to our investors and innovative solutions to users.</p>
                    </div>
                    <div class="col-md-4"><img alt="slider image" src="images/strength2.png" width="190" height="191">
                        <h3>Strength II</h3>
                        <p>Capital- We move speedily and deploy capital independently, including equity for renovation and stabilization capital, eliminating the need to first obtain third party approvals.</p>
                    </div>
                    <div class="col-md-4"><img alt="slider image" src="images/strength3.png" width="190" height="191">
                        <h3>Strength III</h3>
                        <p>Operation- Our entrepreneurial team of professionals is hands-on; principals are directly and proactively involved in the operations and marketing of all our properties.</p>
                    </div>
                </div>
            </div>
        </section>
        <!--strength section end-->
        <!--case studies section start-->
        <section class="case-studies fadeIn animated" data-delay="400" data-animate="fadeIn">
            <div class="container">
                <h1>case studies</h1>
                <div class="row">
                    <div class="col-md-4 col-sm-6 text-center casest-content">
                        <img alt="case studies" src="images/cs_img1.png" width="280" height="343">
                        <!--Hover content start-->
                        <div class="hover-casest-content"><img alt="case studies 2" src="images/sold.png" class="casest-status-right-top">
                            <h4>NAME OF <br>
                                PROPERTY</h4>
                            <p>123 Green Street<br>
                                New York, Ny 123456 </p>
                            <div class="row">
                                <div class="col-xs-8">Property Type:</div>
                                <div class="col-xs-4">Office</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">Size:</div>
                                <div class="col-xs-4">8,000 sf</div>
                            </div>
                        </div>
                        <!--Hover content end-->
                    </div>
                    <div class="col-md-4 col-sm-6 text-center casest-content">
                        <img alt="case studies" src="images/cs_img2.png" width="280" height="343">
                        <!--Hover content start-->
                        <div class="hover-casest-content"><img alt="case studies" src="images/sold.png" class="casest-status-right-top">
                            <h4>NAME OF <br>
                                PROPERTY</h4>
                            <p>123 Green Street<br>
                                New York, Ny 123456 </p>
                            <div class="row">
                                <div class="col-xs-8">Property Type:</div>
                                <div class="col-xs-4">Office</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">Size:</div>
                                <div class="col-xs-4">8,000 sf</div>
                            </div>
                        </div>
                        <!--Hover content end-->
                    </div>
                    <div class="col-md-4 col-sm-6 text-center casest-content">
                        <img src="images/cs_img3.png" alt="case studies" width="280" height="343">
                        <!--Hover content start-->
                        <div class="hover-casest-content"><img alt="case studies" src="images/sold.png" class="casest-status-right-top">
                            <h4>NAME OF <br>
                                PROPERTY</h4>
                            <p>123 Green Street<br>
                                New York, Ny 123456 </p>
                            <div class="row">
                                <div class="col-xs-8">Property Type:</div>
                                <div class="col-xs-4">Office</div>
                            </div>
                            <div class="row">
                                <div class="col-xs-8">Size:</div>
                                <div class="col-xs-4">8,000 sf</div>
                            </div>
                        </div>
                        <!--Hover content end-->
                    </div>
                </div>
                <div class="row text-center">
                    <a href="/case-studies">
                        <button class="btn btn-primary btn-lg text-capitalize">view more properties</button>
                    </a>
                </div>
            </div>
        </section>
    </div>
    <!--case studies section end-->
</section>
@endsection
