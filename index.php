<?php $API_KEY = "pub_7464aa153339f4a244469929e3b848c43224"; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>WorldTime - News</title>
    <!-- stylesheets -->
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css"
    />
    <link rel="stylesheet" href="assets/vendors/aos/dist/aos.css/aos.css" />
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>
    <div class="container-scroller">
      <div class="main-panel">



      <!-- NAVBAR -->
      <header id="header">
          <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light">
              <div class="navbar-top"></div>
              <div class="navbar-bottom">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <a class="navbar-brand" href="#"><img src="assets/images/logo.svg" alt=""/></a>
                  </div>
                  <div>
                    <button
                      class="navbar-toggler"
                      type="button"
                      data-target="#navbarSupportedContent"
                      aria-controls="navbarSupportedContent"
                      aria-expanded="false"
                      aria-label="Toggle navigation"
                    >
                      <span class="navbar-toggler-icon"></span>
                    </button>
                    <div
                      class="navbar-collapse justify-content-center collapse"
                      id="navbarSupportedContent"
                    >
                      <ul
                        class="navbar-nav d-lg-flex justify-content-between align-items-center"
                      >
                        <li>
                          <button class="navbar-close">
                            <i class="mdi mdi-close"></i>
                          </button>
                        </li>                        
                        <li class="nav-item">
                          <a class="nav-link" href="">Technology</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="">Science</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="">Business</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="">Entertainment</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="pages/contactus.php">Contact</a>
                        </li>
                      </ul>
                    </div>
                  </div>
                  <ul class="social-media">
                    <li>
                      <a href="https://www.facebook.com/" target='_blank'>
                        <i class="mdi mdi-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.instagram.com/parag_codes"target='_blank'>
                        <i class="mdi mdi-instagram"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://twitter.com/Parag_477" target='_blank'>
                        <i class="mdi mdi-twitter"></i>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </nav>
          </div>
        </header>

      <!-- NAVBAR END -->



      <div class="flash-news-banner">
          <div class="container">
            <div class="d-lg-flex align-items-center justify-content-between">
              <div class="d-flex align-items-center">

      <?php
          $news_data = file_get_contents("https://newsdata.io/api/1/news?apikey=".$API_KEY."&language=en&category=technology");
          $res = json_decode($news_data);
          
          $title = $res->results[1]->title;
          $link = $res->results[1]->link;
          echo '<span class="badge badge-dark mr-3">Flash news</span>
          <p class="mb-0">
          <a href = "'.$link.'" style="color:black;">
            '.$title.'
            </a>
          </p>
        </div>';

        $date = date("D, F j, Y");
        // $user_ip_add = $_SERVER['REMOTE_ADDR'];
        $user_ip_add = "157.34.16.172";
            # (get latitude & longitude)
            function temp($user_ip) {
                $WEATHER_API_KEY = "5f9334ac2ceb5c65b2908ca92057c987";
                
                // $ip = '1.2.3.4';
                $ip = $user_ip;
                $api_1 = 'https://ipapi.co/' . $ip . '/latlong/';
                $location = file_get_contents($api_1);
                $point = explode(",", $location);
                
                # (get weather forecast)
                $api_2 = 'http://api.openweathermap.org/data/2.5/weather?lat=' . $point[0] . '&lon=' . $point[1] . '&appid=' . $WEATHER_API_KEY;
                $weather = file_get_contents($api_2);
                $dec = json_decode($weather);
                $temp = $dec->main->temp;
                $temp_in_celsius = ceil($temp - 273);
                $temp_f = $temp_in_celsius . "°C";

                $lon = $dec->coord->lon;
                $lat = $dec->coord->lat;
                $loc = "https://api.openweathermap.org/geo/1.0/reverse?lat=$lat&lon=$lon&appid=$WEATHER_API_KEY";
                $city_url = file_get_contents($loc);
                $city_js = json_decode($city_url);

                $city = $city_js[0]->name;
                $state = $city_js[0]->state;

                print_r($temp_f.", ".$city);

            }
            ?>

              <div class="d-flex">
                <span class="mr-3 text-danger"><?php echo $date; ?></span>
                <span class="text-danger"><?php temp($user_ip_add); ?></span>
              </div>
            </div>
          </div>
        </div>
<?php
          $news_data = file_get_contents("https://newsdata.io/api/1/news?apikey=".$API_KEY."&language=en");
          $res = json_decode($news_data);

          $title = $res->results[0]->title;
          $link = $res->results[0]->link;
          $image_url = $res->results[0]->image_url;
          if ($image_url == NULL){
            $image_url = "https://source.unsplash.com/random/750x500";
          }
      
          echo '<div class="content-wrapper">
          <div class="container">
            <div class="row" data-aos="fade-up">
              <div class="col-xl-8 stretch-card grid-margin">
                <div class="position-relative">
                  <img
                    src="'.$image_url.'" 
                    height="500px"
                    width="750px"
                    alt="banner"
                    class="img-fluid"
                  />
                  <div class="banner-content">
                  <a href = "'.$link.'" style="text-decoration:none; color:white;">
              <h1 class="mb-0" style="font-size:32px;">'.$title.'</h1></a>';
        ?>

</div>
</div>
</div>



<div class="col-xl-4 stretch-card grid-margin">
  <div class="card bg-dark text-white">
            <div class="card-body">
              <h2>Latest Tech news</h2>
        <?php
        for( $i=0; $i<5; $i++){
          $news_data = file_get_contents("https://newsdata.io/api/1/news?apikey=".$API_KEY."&language=en&category=technology");
          $res = json_decode($news_data);
          
            $title = $res->results[$i]->title;
            $link = $res->results[$i]->link;
            $image_url = $res->results[$i]->image_url;
            if ($image_url == NULL){
              $image_url = "https://source.unsplash.com/random/150x100";
            }
            $time = $res->results[$i]->pubDate;
            $date = strtotime($time);
            $ftime = date('d M Y', $date);

            echo '<div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
            <div class="pr-3">
            <h5><a style="text-decoration: none; color:white;" href=" '.$link.' " target = "_blank">'.$title.'</a></h5>
            <div class="fs-12">
            '.$ftime.'
            </div>
            </div>
            <div class="rotate-img">
            <img
            src="'.$image_url.'"
            alt="thumb"
            width="150px"
            height="100px"
            class="img-fluid img-lg"
            />
            </div>
            </div>';
          }
        ?>
            </div>
          </div>
        </div>
        </div>
            <div class="row" data-aos="fade-up">
              <div class="col-lg-3 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h2>Category</h2>
                    <ul class="vertical-menu">
                      <li><a href="">Top</a></li>
                      <li><a href="">Technology</a></li>
                      <li><a href="">Science</a></li>
                      <li><a href="">Business</a></li>
                      <li><a href="">Entertainment</a></li>
                      <li><a href="">Sports</a></li>
                    </ul>
                  </div>
                </div>
              </div>


              <div class="col-lg-9 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">


      <?php
          $news_data = file_get_contents("https://newsdata.io/api/1/news?apikey=".$API_KEY."&language=en&category=technology");
          $res = json_decode($news_data);
          
          for ($i=0; $i <= 8; $i++) {
            $title = $res->results[$i]->title;
            $link = $res->results[$i]->link;
            $image_url = $res->results[$i]->image_url;
            if ($image_url == NULL){
              $image_url = "https://source.unsplash.com/random/250x200";
            }
            $time = $res->results[$i]->pubDate;
            $date = strtotime($time);
            $ftime = date('d M Y', $date);

            echo '<div class="row">
                    <div class="col-sm-4 grid-margin">
                    <div class="position-relative">
                    <div class="rotate-img">
                    <img
                    src="'.$image_url.'"
                    width="250px"
                    height="200px"
                    alt="Image"
                    class="img-fluid"
                    />
                    </div>
                    </div>
                    </div>
                    
                    <div class="col-sm-8  grid-margin">
                    <h2 class="mb-2 font-weight-600">
                    <a href="'.$link.'" style="color:black;">
                    '.$title.'
                    </a>
                    </h2>
                    <div class="fs-13 mb-2">
                    '.$ftime.'
                      </div>
                      </div>
                  </div>';
          } 
          
            ?>

                  </div>
                </div>
              </div>
            </div>
            <footer>
          <div class="footer-top">
            <div class="container">
              <div class="row">
                <div class="col-sm-5">
                  <img src="assets/images/logo.svg" class="footer-logo" alt="" />
                  <h5 class="font-weight-normal mt-4 mb-5">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Adipisci architecto doloremque voluptatibus molestiae quod facere! Ad aut soluta cum iusto velit perferendis, dignissimos ipsa autem neque. Explicabo ullam ad maiores.
                  </h5>
                  <ul class="social-media mb-3">
                    <li>
                      <a href="https://www.facebook.com/" target='_blank'>
                        <i class="mdi mdi-facebook"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://www.instagram.com/parag_codes"target='_blank'>
                        <i class="mdi mdi-instagram"></i>
                      </a>
                    </li>
                    <li>
                      <a href="https://twitter.com/Parag_477" target='_blank'>
                        <i class="mdi mdi-twitter"></i>
                      </a>
                    </li>
                  </ul>
                </div>
                <div class="col-sm-4">
                  <h3 class="font-weight-bold mb-3">RECENT POSTS</h3>
            <?php
            for ($i=0; $i <= 4; $i++) { 
              echo '<div class="row">
              <div class="col-sm-12">
              <div class="footer-border-bottom pb-2">
              <div class="row">
              <div class="col-3">
                        <img
                        src="https://source.unsplash.com/random/150x100"
                          alt="thumb"
                          class="img-fluid"
                          width="150px"
                          height="100px"
                        />
                      </div>
                      <div class="col-9">
                        <h5 class="font-weight-600">
                        <a style="text-decoration: none; color:white;" href="">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Possimus, assumenda.</a>
                        </h5>
                      </div>
                    </div>
                  </div>
                </div>
                </div>';
              }
                ?>
                </div>
                <div class="col-sm-3">
                  <h3 class="font-weight-bold mb-3">CATEGORIES</h3>

                  <div class="footer-border-bottom pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="" style="color:#fff;"><h5 class="mb-0 font-weight-600">Top</h5></a>
                    </div>
                  </div>

                  <div class="footer-border-bottom pb-2">
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="" style="color:#fff;"><h5 class="mb-0 font-weight-600">Technology</h5></a>
                    </div>
                  </div>

                  <div class="footer-border-bottom pb-2 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="" style="color:#fff;"><h5 class="mb-0 font-weight-600">Science</h5></a>
                    </div>
                  </div>

                  <div class="footer-border-bottom pb-2 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="" style="color:#fff;"><h5 class="mb-0 font-weight-600">Business</h5></a>
                    </div>
                  </div>

                  <div class="footer-border-bottom pb-2 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="" style="color:#fff;"><h5 class="mb-0 font-weight-600">Entertainment</h5></a>
                      </div>
                  </div>

                  <div class="footer-border-bottom pb-2 pt-2">
                    <div class="d-flex justify-content-between align-items-center">
                    <a href="" style="color:#fff;"><h5 class="mb-0 font-weight-600">Sports</h5></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="footer-bottom">
            <div class="container">
              <div class="row">
                <div class="col-sm-12">
                  <div class="d-sm-flex justify-content-between align-items-center">
                    <div class="fs-14 font-weight-600">
                      © <?php echo date('Y'); ?> @ <a href="https://www.innotechzz.com/" target="_blank" class="text-white"> Parag Agrawal</a>. All rights reserved.
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
    <script src="./assets/js/demo.js"></script>
    <script src="./assets/js/jquery.easeScroll.js"></script>
  </body>
</html>
