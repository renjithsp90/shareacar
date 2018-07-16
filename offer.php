<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Share A Trip</title>
<!--


-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">                <!-- Font Awesome -->
    <link rel="stylesheet" href="css/bootstrap.min.css">                                      <!-- Bootstrap style -->
    <link rel="stylesheet" type="text/css" href="slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="slick/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/datepicker.css"/>
    <link rel="stylesheet" href="css/tooplate-style.css">                                   <!-- Templatemo style -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
          <![endif]-->
          <script>
            // This example requires the Places library. Include the libraries=places
            // parameter when you first load the API. For example:
            // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      
            function initMap() {
                var card = document.getElementById('pac-card');

                var from = new google.maps.Map(document.getElementById('from'), {
                });
                var input_from = document.getElementById('home_from');
                var autocomplete = new google.maps.places.Autocomplete(input_from);
                
                var to = new google.maps.Map(document.getElementById('to'), {
                    });
                var input_to = document.getElementById('home_to');
                    var autocomplete2 = new google.maps.places.Autocomplete(input_to);
                
                var milestone = new google.maps.Map(document.getElementById('position'), {
                });
                var input_milestone = document.getElementById('position');
                var autocomplete3 = new google.maps.places.Autocomplete(input_milestone);


                var directionsService = new google.maps.DirectionsService;
                var directionsDisplay = new google.maps.DirectionsRenderer;

                var map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2195},
                zoom: 13
                });
                                
                
                directionsDisplay.setMap(map);

                map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

                autocomplete.bindTo('bounds', map);
                autocomplete2.bindTo('bounds', map);
                
                autocomplete.setFields(['address_components', 'geometry', 'icon', 'name']);

                var infowindow = new google.maps.InfoWindow();
                var infowindowContent = document.getElementById('infowindow-content');
                infowindow.setContent(infowindowContent);
                var marker = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
                });

                autocomplete.addListener('place_changed', function() {
                calculateAndDisplayRoute(directionsService, directionsDisplay);
                infowindow.close();
                marker.setVisible(false);
                var place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert("No details available for input: '" + place.name + "'");
                    return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                    map.fitBounds(place.geometry.viewport);
                } else {
                    map.setCenter(place.geometry.location);
                    map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
                });


                //Marking place 2
                autocomplete2.setFields(
                    ['address_components', 'geometry', 'icon', 'name']);

                var infowindow = new google.maps.InfoWindow();
                var infowindowContent = document.getElementById('infowindow-content');
                infowindow.setContent(infowindowContent);
                var marker2 = new google.maps.Marker({
                map: map,
                anchorPoint: new google.maps.Point(0, -29)
                });

                autocomplete2.addListener('place_changed', function() {

                infowindow.close();
                marker2.setVisible(false);
                var place = autocomplete2.getPlace();
                if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
                }

                // If the place has a geometry, then present it on a map.
                if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
                } else {
                map.setCenter(place.geometry.location);
                map.setZoom(17);  // Why 17? Because it looks good.
                }
                marker2.setPosition(place.geometry.location);
                marker2.setVisible(true);

                });




                // Sets a listener on a radio button to change the filter type on Places
                // Autocomplete.
                /*function setupClickListener(id, types) {
                var radioButton = document.getElementById(id);
                radioButton.addEventListener('click', function() {
                autocomplete.setTypes(types);
                });
                }

                setupClickListener('changetype-all', []);
                setupClickListener('changetype-address', ['address']);
                setupClickListener('changetype-establishment', ['establishment']);
                setupClickListener('changetype-geocode', ['geocode']);

                document.getElementById('use-strict-bounds')
                .addEventListener('click', function() {
                console.log('Checkbox clicked! New state=' + this.checked);
                autocomplete.setOptions({strictBounds: this.checked});
                });*/

                var onChangeHandler = function() {
                var x = document.getElementById('home_from').value;
                console.log(x);
                calculateAndDisplayRoute(directionsService, directionsDisplay);
                };
                
                
                document.getElementById('home_from').addEventListener('change', onChangeHandler);
                document.getElementById('home_to').addEventListener('change', onChangeHandler);


                //Function for setting directions

                function calculateAndDisplayRoute(directionsService, directionsDisplay) {
                    
                    directionsService.route({          
                    origin: document.getElementById('home_from').value,
                    destination: document.getElementById('home_to').value,
                    travelMode: 'DRIVING'
                    }, function(response, status) {
                    
                    if (status === 'OK') {
                        
                        directionsDisplay.setDirections(response);
                    } else {
                        
                        window.alert('Directions request failed due to ' + status);
                    }
                    });
                }
                
            }
          </script>
          <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCXMgf6RbjKK6VN8rUMm0jLslAMYHiN-Pg&libraries=places&callback=initMap"
          async defer></script>
</head>

    <body>
        <div class="tm-main-content" id="top">
            <div class="tm-top-bar-bg"></div>
            <div class="tm-top-bar" id="tm-top-bar">
                <!-- Top Navbar -->
                <div class="container">
                    <div class="row">
                        
                        <nav class="navbar navbar-expand-lg narbar-light">
                            <a class="navbar-brand mr-auto" href="#">
                                <img src="img/logo.png" alt="Site logo">
                                Share a Trip
                            </a>
                            <button type="button" id="nav-toggle" class="navbar-toggler collapsed" data-toggle="collapse" data-target="#mainNav" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon"></span>
                            </button>
                            <div id="mainNav" class="collapse navbar-collapse tm-bg-white">
                                <ul class="navbar-nav ml-auto">
                                  <li class="nav-item">
                                    <a class="nav-link" href="#top">Home <span class="sr-only">(current)</span></a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-4">About us</a>
                                  </li>
                                  <li class="nav-item">
                                    <a class="nav-link" href="#tm-section-6">Contact Us</a>
                                  </li>

                                  <li class="nav-item">
                                    <a class="nav-link" href="signup.html">Signup here</a>
                                  </li>

                                </ul>
                            </div>                            
                        </nav>            
                    </div>
                </div>
            </div>                                       
            
            
            <div class="tm-section tm-section-pad tm-bg-img tm-position-relative" id="tm-section-6">
                <div class="container ie-h-align-center-fix">
                    <div class="row">
                           
                        <div style="width: 30%;">
                            <table>
                                <form action="index.html" method="POST" class="tm-search-form tm-section-pad-2">
                                    <div class="form-row tm-search-form-row">
                                        <div class="pac-card" id="pac-card">
                                            <tr>
                                                <div class="form-group tm-form-element tm-form-element-100" id="pac_card">
                                                    <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                                    <input id="home_from" name="home_from" type="text" class="form-control" placeholder="Start point">
                                                </div>
                                                <div id="from"></div>
                                            </tr>
                                            <tr>
                                                <div class="form-group tm-form-element tm-form-element-100" id="pac-card">
                                                    <i class="fa fa-map-marker fa-2x tm-form-element-icon"></i>
                                                    <input id="home_to" name="home_to" type="text" class="form-control" placeholder="End point">
                                                </div>
                                                <div id="to"></div>
                                            </tr>
                                            <tr>
                                                <div class="form-group tm-form-element tm-form-element-50">
                                                        <i class="fa fa-calendar fa-2x tm-form-element-icon"></i>
                                                        <input name="check-in" type="text" class="form-control" id="home_date" placeholder="Date of Travel">
                                                </div>
                                            </tr>
                                            
                                            <tr>
                                            <div class="inline" style="display: inline;">
                                                <input type="text" id="position"  class="form-control" style="width: 70%" name="position" placeholder="Add Milestones *">
                                                <input type="button" value="Add" style="width: 20%;" onclick="newElement()">
                                            </div>
                                            <ul id="position_list">
                                                
                                            </ul>
                                            </tr>
                                            <tr>
                                                <div class="form-group tm-form-element tm-form-element-2" >
                                                    <button type="submit" class="btn btn-primary tm-btn-search" style="width: 50%">Next</button>
                                                </div>
                                            </tr>

                                        </div>
                                    </div>
                                </form> 
                            </table>
                        </div>
                        <div style="width: 69%;">
                            <div class="tm-bg-white tm-p-4" style=" height: 600px;"  id="map">
                               
                            </div>        
                        </div>
                        
                    </div>        
                </div>
            </div>
            
            <footer class="tm-bg-dark-blue">
                <div class="container">
                    <div class="row">
                        <p class="col-sm-12 text-center tm-font-light tm-color-white p-4 tm-margin-b-0">
                        Copyright &copy; <span class="tm-current-year">2018</span> Shareatrip
                        
                        - Design: <a href="https://www.facebook.com/shareatrip" class="tm-color-primary tm-font-normal" target="_parent">Share A Trip</a></p>        
                    </div>
                </div>                
            </footer>
        </div>
        
        <!-- load JS files -->
        <script src="js/jquery-1.11.3.min.js"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="js/popper.min.js"></script>                    <!-- https://popper.js.org/ -->       
        <script src="js/bootstrap.min.js"></script>                 <!-- https://getbootstrap.com/ -->
        <script src="js/datepicker.min.js"></script>                <!-- https://github.com/qodesmith/datepicker -->
        <script src="js/jquery.singlePageNav.min.js"></script>      <!-- Single Page Nav (https://github.com/ChrisWojcik/single-page-nav) -->
        <script src="slick/slick.min.js"></script>                  <!-- http://kenwheeler.github.io/slick/ -->
        <script>

            // Create a "close" button and append it to each list item
            var myNodelist = document.getSelection("#position_list li");
            var i;
            for (i = 0; i < myNodelist.length; i++) {
            var span = document.createElement("SPAN");
            var txt = document.createTextNode("\u00D7");
            span.className = "close";
            span.appendChild(txt);
            myNodelist[i].appendChild(span);
            }
            
            // Click on a close button to hide the current list item
            var close = document.getElementsByClassName("close");
            var i;
            for (i = 0; i < close.length; i++) {
            close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
            }
            }
            
            // Add a "checked" symbol when clicking on a list item
            var list = document.querySelector('ul');
            list.addEventListener('click', function(ev) {
            if (ev.target.tagName === 'LI') {
                ev.target.classList.toggle('checked');
            }
            }, false);
            
            // Create a new list item when clicking on the "Add" button
            function newElement() {
            var li = document.createElement("li");
            var inputValue = document.getElementById("position").value;
            var t = document.createTextNode(inputValue);
            li.appendChild(t);
            if (inputValue === '') {
                alert("You must write something!");
            } else {
                document.getElementById("position_list").appendChild(li);
            }
            document.getElementById("position").value = "";
            
            var span = document.createElement("SPAN");
            var txt = document.createTextNode("\u00D7");
            span.className = "close";
            span.appendChild(txt);
            li.appendChild(span);
            
            for (i = 0; i < close.length; i++) {
                close[i].onclick = function() {
                var div = this.parentElement;
                div.style.display = "none";
                }
            }
            }
            /* Google map
            ------------------------------------------------*/
            var center;            

            
            function setCarousel() {
                
                if ($('.tm-article-carousel').hasClass('slick-initialized')) {
                    $('.tm-article-carousel').slick('destroy');
                } 

                if($(window).width() < 438){
                    // Slick carousel
                    $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 1,
                        slidesToScroll: 1
                    });
                }
                else {
                 $('.tm-article-carousel').slick({
                        infinite: false,
                        dots: true,
                        slidesToShow: 2,
                        slidesToScroll: 1
                    });   
                }
            }

            function setPageNav(){
                if($(window).width() > 991) {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 79
                    });   
                }
                else {
                    $('#tm-top-bar').singlePageNav({
                        currentClass:'active',
                        offset: 65
                    });   
                }
            }

            function togglePlayPause() {
                vid = $('.tmVideo').get(0);

                if(vid.paused) {
                    vid.play();
                    $('.tm-btn-play').hide();
                    $('.tm-btn-pause').show();
                }
                else {
                    vid.pause();
                    $('.tm-btn-play').show();
                    $('.tm-btn-pause').hide();   
                }  
            }
       
            $(document).ready(function(){

                $(window).on("scroll", function() {
                    if($(window).scrollTop() > 100) {
                        $(".tm-top-bar").addClass("active");
                    } else {
                        //remove the background property so it comes transparent again (defined in your css)
                       $(".tm-top-bar").removeClass("active");
                    }
                });      

                
                // Date Picker
                const pickerCheckIn = datepicker('#home_date');
                const pickerCheckOut = datepicker('#inputCheckOut');
                
                // Slick carousel
                setCarousel();
                setPageNav();

                $(window).resize(function() {
                  setCarousel();
                  setPageNav();
                });

                // Close navbar after clicked
                $('.nav-link').click(function(){
                    $('#mainNav').removeClass('show');
                });

                // Control video
                $('.tm-btn-play').click(function() {
                    togglePlayPause();                                      
                });

                $('.tm-btn-pause').click(function() {
                    togglePlayPause();                                      
                });

                // Update the current year in copyright
                $('.tm-current-year').text(new Date().getFullYear());                           
            });

        </script>             

</body>
</html>

