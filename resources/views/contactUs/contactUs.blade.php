@extends('layouts.app')
@section('content')
    @include('layouts.pageTitleSection', array('sectionName'=>'Contact', 'detail' => 'Get in Touch with Us'))
    <script>
        window.allowedExtensions = '{{env('ALLOWED_FILE_EXTENSION')}}'
    </script>
    <script src="{{asset('/assets/js/custom/general.js')}}"></script>
    <script src="{{asset('/assets/js/custom/contactUs.js')}}"></script>


    <!-- Google Map
          ============================================= -->
    <section id="google-map" class="gmap slider-parallax"></section>

    <!-- Content
          ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container clearfix contact-us">

                <!--contact info-->

                <div class="row clear-bottommargin">
                    <div class="col-md-3 col-sm-6 bottommargin clearfix">
                        <div class="feature-box fbox-center fbox-bg fbox-border">
                            <div class="fbox-icon">
                                <a href="#">
                                    <i class="contact_icons">
                                        <img alt="contact icon 1" src="images/contac_icon1.png">
                                    </i>
                                </a>
                            </div>
                            <h3 >Address<span class="subtitle">123 Green St. <br > NY, NY 12345</span></h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 bottommargin clearfix">
                        <div class="feature-box fbox-center fbox-bg fbox-border">
                            <div class="fbox-icon">
                                <a href="#">
                                    <i class="contact_icons">
                                        <img alt="contact icon 2" src="images/contac_icon2.png">
                                    </i>
                                </a>
                            </div>
                            <h3>Phone<span class="subtitle">(123) 456 7890</span></h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 bottommargin clearfix">
                        <div class="feature-box fbox-center fbox-bg fbox-border">
                            <div class="fbox-icon">
                                <a href="#">
                                    <i class="contact_icons">
                                        <img alt="contact icon 3" src="images/contac_icon3.png">
                                    </i>
                                </a>
                            </div>
                            <h3>Fax<span class="subtitle">098-765-4321</span></h3>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 bottommargin clearfix">
                        <div class="feature-box fbox-center fbox-bg fbox-border">
                            <div class="fbox-icon">
                                <a href="#">
                                    <i class="contact_icons">
                                        <img alt="contact icon 4" src="images/contac_icon4.png">
                                    </i>
                                </a>
                            </div>
                            <h3>Email<span class="subtitle">contact@ppam.net</span></h3>
                        </div>
                    </div>
                </div>
                <div class="clear"></div>
                <form class="form-horizontal" name="contactUs" id="contactUs" accept-charset="UTF-8"
                      enctype="multipart/form-data">
                    <!-- Postcontent
                                ============================================= -->
                    <div class="nobottommargin">
                        <!-- Contact Form
                                      ============================================= -->
                        <h3>Send us an Email</h3>
                        <div class="contact-widget">
                            <div class="contact-form-result"></div>
                            <form class="nobottommargin" id="template-contactform" name="template-contactform"
                                  action="include/sendemail.php" method="post">

                                <div class="alert alert-danger bootstrapMsg" id="errorMessage" style="display: none">
                                    <strong>Oops!</strong> {{Session::get('failure')}}.
                                </div>
                                <div class="alert alert-success bootstrapMsg" id="successMessage" style="display: none">
                                    <strong>Success!</strong> {{Session::get('success')}}.
                                </div>


                                <div class="form-process"></div>
                                <div class="col_one_third">
                                    <label for="name">Name
                                        <small>*</small>
                                    </label>
                                    <input type="text" id="name" name="name" value="" class="sm-form-control required"/>
                                </div>
                                <div class="col_one_third">
                                    <label for="email">Email
                                        <small>*</small>
                                    </label>
                                    <input type="email" id="email" name="email" value=""
                                           class="required email sm-form-control"/>
                                </div>
                                <div class="col_one_third col_last">
                                    <label for="phone">Phone</label>
                                    <input type="text" id="phone" name="phone" value="" class="sm-form-control"/>
                                </div>
                                <div class="clear"></div>
                                <div class="col_full">
                                    <label for="comment">Message
                                        <small>*</small>
                                    </label>
                                    <textarea class="required sm-form-control" name="comment" id="comment" rows="6"
                                              cols="30"></textarea>
                                </div>
                                <div class="col_full">
                                    <label for="uploadedResume">Upload CV
                                        <small>*</small>
                                    </label>
                                    <p>For employment opportunities and open positions please attach a resume and any
                                        additional contact information.</p>
                                    <input type="file" id="uploadedResume" name="uploadedResume"
                                           class="sm-form-control"/>
                                </div>
                                <div class="col_full hidden">
                                    <input type="text" id="template-contactform-botcheck"
                                           name="template-contactform-botcheck" value="" class="sm-form-control"/>
                                </div>
                                <div class="col_full">
                                    <button class="button nomargin" type="submit" id="template-contactform-submit"
                                            name="template-contactform-submit" value="submit">Send Message
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- .postcontent end -->
                </form>
            </div>
        </div>
    </section>
    <script type="text/javascript" src="https://maps.google.com/maps/api/js"></script>
    <script type="text/javascript" src={{"assets/js/library/jquery.gmap.js"}}></script>
    <script type="text/javascript">

        $('#google-map').gMap({

            address: '{{env('ADDRESS')}}',
            maptype: 'ROADMAP',
            zoom: 14,
            markers: [
                {
                    address: "{{env('ADDRESS')}}",
                    html: '<div style="width: 300px;"><h4 style="margin-bottom: 8px;">Hi, we\'re <span>PremierProperties</span></h4><p class="nobottommargin">Premier Properties is a property investment group which works to facilitate and connect investors with investments. Premier Properties is looking to create an application which allows the investors to access and keep updated with investments made by the group. The primary functionality of the application is to manage all properties invested in by Premier, allow for management reports to be uploaded to the system, and give investors access to this information. There will also be a front end website for the public to view and get to know Premier Properties.</p></div>',
                    icon: {
                        image: "images/icons/map-icon-red.png",
                        iconsize: [32, 39],
                        iconanchor: [13, 39]
                    }
                }
            ],
            doubleclickzoom: false,
            controls: {
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false
            }
        });

    </script>
    <!-- #content end -->

@endsection