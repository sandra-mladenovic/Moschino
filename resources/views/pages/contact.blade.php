@extends('layouts.layout')
@section('title')
    Contact
@endsection
@section('content')
    <div id="content" class="site-content">
        <div id="primary" class="content-area column full">
            <main id="main" class="site-main">
                <article id="post-39" class="post-39 page type-page status-publish hentry">
                    <header class="entry-header">
                        <h1 class="entry-title">Contact</h1>
                    </header>
                    <!-- .entry-header -->
                    <div class="entry-content">

                        <!-- BEGIN MAP -->
                        <p><script src='https://maps.googleapis.com/maps/api/js?v=3.exp'></script>
                        <div style='overflow:hidden;height:380px;width:100%;'>
                            <div id='gmap_canvas' style='height:380px;width:100%;'></div>
                            <div>embed google maps</a></div>
                            <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                        </div>
                        <p><script type='text/javascript'>function init_map(){var myOptions = {zoom:10,center:new google.maps.LatLng(3.4000221,-76.387969),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(3.4000221,-76.387969)});infowindow = new google.maps.InfoWindow({content:'<strong>Jane Photography</strong><br />Florida Beach<br />'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script></p>
                        <!-- END MAP -->

                        <div class="wpcmsdev-columns">
                            <div class="column column-width-one-half">
                                <h4>Quick Contact</h4>

                                <form action="{{url('/contact/send')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" name="email" id="email" class="form-control" placeholder="example@example">
                                    </div>
                                    <div class="form-group">
                                        <label for="subject">Subject</label>
                                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="form-group">
                                        <label for="message">Message</label>
                                        <textarea name="message" id="message" cols="5" rows="5" class="form-control" placeholder="Message..."></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">
                                            Send Message
                                        </button>
                                    </div>
                                </form>
                                <div class="done">
                                    Your message has been sent. Thank you!
                                </div>

                            </div>
                            <div class="column column-width-one-half">
                                <h4>Find Us: (888) 252 389 3571</h4>
                                <p>
                                    We’re impartial and independent, and every day we create distinctive, world-class programmes and content which inform, educate and entertain millions of people in the UK and around the world.
                                </p>
                                <p>
                                    Monday – Friday: 9am to 5pm<br>
                                    Saturday: 10am to 2pm<br>
                                    Sunday: Closed
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- .entry-content -->
                </article>
            </main>
            <!-- #main -->
        </div>
        <!-- #primary -->
    </div>
@endsection
