<!DOCTYPE html>
<html lang="en">

      
    



  @error('captcha')
  <script>
    sessionStorage.setItem('error','{{$message}}');
    </script>
  @enderror
@error('password_confirmation')
<script>
  sessionStorage.setItem('error','{{$message}}');
  </script>
@enderror
@error('password')
<script>
  sessionStorage.setItem('error','{{$message}}');
  </script>
@enderror
@error('email')
<script>
  sessionStorage.setItem('error','{{$message}}');
  </script>
@enderror
@error('displayName')
<script>
  sessionStorage.setItem('error','{{$message}}');
  </script>
@enderror


<script>
  sessionStorage.setItem("displayName","{{old('displayName')}}");
  sessionStorage.setItem('email',"{{old('email')}}");

</script>
    
   
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Better Help</title>

  <link rel="stylesheet" href="{{URL::asset('css/indexstyle.css')}}">

 <script>console.log(sessionStorage);</script>
<style>body{color:white;}</style>
</head>

<body onload="LoadExtSections()">
  
  <header id="header">
    <div class="logo">
      <a href="#"><img src="img/logo.png" alt=""></a>
    </div>

    <div class="nav">
    
      <div class="btns">
     <button id="loginbtn">Login</button>
    
    </div>
     </div>

    </header>

    

    <div id="joinnowpopup" class="popup">
      <img src="img/dtl/xpopupimage.png.pagespeed.ic.wKz592s59x.png" alt="">
      <div>
        <h2>TALK TO SOMEBODY NOW</h2>
        <button>JOIN NOW</button>
      </div>
      <button onclick="closepopup('joinnowpopup',0)">X</button>
    </div>
    
    <div id="expertspopup"  class="popup">
      <div>
        <h2>Are you a mental health professional??</h2>
        <button><a href="/MentorRequest" style="text-decoration: none;color:inherit">Join us and guide people</a></button>
      </div>
      <button onclick="closepopup('expertspopup',1)">X</button>
    </div>

    <section id="leftnav">

    <div id="links_cont">

     <div id="expert_login_link">
       <div id="expert_icon" class="link_icon_con">
         <img src="img/expert_icon3.jpg" alt="" class="link_icon">
       </div>
     <h3><a href="/MentorLogin">Mentors Login</a></h3>

     </div>

     <div id="fb_link" class="link_icon_con">
    <a href="https://www.facebook.com/"> <img src="img/fb.png" alt="" class="link_icon"></a>
    </div>

    <div id="ytb_link" class="link_icon_con">
      <a href="https://www.youtube.com/">   <img src="img/ytb.svg" alt="" class="link_icon"></a>
     </div>

    <div id="insta_link" class="link_icon_con">
      <a href="https://www.instagram.com/">  <img src="img/insta.png" alt="" class="link_icon"></a>
    </div>

    <div id="twitter_link" class="link_icon_con">
      <a href="https://www.twitter.com/">   <img src="img/twitter.png" alt="" class="link_icon"></a>
     </div>

</div>
    <div id="notch" onclick="display_leftnav()">
      <span>⮞</span>
    </div>
  </section>

    <section class="hero" style="background-image: url(img/hero.jpg);">
      <div class="cover">
        <h1>You are not alone</h1>
      <h3>Join our community with likeminded people & trained support mentors to help you</h3>
      </div>
    </section>

    <section id="howwecanhelp">
      <h1>HOW WE CAN HELP</h1>
      <p>Whether you're looking to learn more about your mental health or have abusive content removed from the internet, we've pretty much got you covered. Mental health, bullying, coming out, body image, relationships, hate speech... seriously, we're here. We know how tough it can be to grow up, so don't do it alone. Here are 2 immediate ways you can get our help.</p>
      <div class="ways">
        <div>
          <h2>SPEAK TO A MENTOR</h2>
          <p>Join the Ditch the Label support forums and get confidential advice and support from our fully trained support mentors and community of real people who have, and are going through similar issues.</p>
        </div>
        <div>
          <img src="img/help.jpg" alt="">
        </div>
        <div>
          <h2>FREE TOOLKITS & SELF-HELP</h2>
          <p>From bullying and body image to sexting and anxiety, we’ve pretty much got your back. Our experts have written hundreds of support guides, available to browse now.</p>
        </div>
      </div>
    </section>

    
   
    <section id="issues">
      <h2>Meet people that can share with...</h2>
      <h2>Meet people that can help with...</h2>

      <div class="issue-con">

        <div class="issue" >
          <img src="img/p/img1.jif" alt="">
          <div class="cover"><span>Depression</span></div>
          
        </div>
        <div class="issue">
          <img src="img/p/img2.jif" alt="">
          <div class="cover"><span>Stress</span></div>

        </div>
      <div class="issue">
        <img src="img/p/img3.jif" alt="">
        <div class="cover"><span>Anxiety</span></div>

      </div>
      <div class="issue">
        <img src="img/p/img4.jif" alt="">
        <div class="cover"><span>Self-Esteem</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img5.jif" alt="">
        <div class="cover"><span>Anger</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img6.jif" alt="">
        <div class="cover"><span>Relationship</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img7.jif" alt="">
        <div class="cover"><span>Grief</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img8.jif" alt="">
        <div class="cover"><span>Eating Disorder</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img9.jif" alt="">
        <div class="cover"><span>Mental Health</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img10.jif" alt="">
        <div class="cover"><span>Borderline Personality Disorder</span></div>
      </div>
      <div class="issue">
        <img src="img/p/img11.jif" alt="">
        <div class="cover"><span>And more..</span></div>
      </div>

    </div>
    </section>
    
      </div>
    </section>


  <section id="SignUpSec">
    <script>
      if(sessionStorage.getItem("error")){
      document.getElementById('SignUpSec').style.height='100vh';

      }
    </script>
    <span style="color:white">
   
    </span>
    <span id="SignUpClosebtn" onclick="closesignup()">X</span>
  </section>

  <section id="SignInSec">
 
@error('login_password')
<script>
  sessionStorage.setItem('login_error',"{{$message}}");

document.querySelector("#SignInSec").style.width="425px";

  </script>
@enderror

@error('login_email')
<script>
sessionStorage.setItem('login_error',"{{$message}}");

document.querySelector("#SignInSec").style.width="425px";

  </script>
@enderror

    <span id="SignInClosebtn" onclick="closesignin()">X</span>

  </section>
<style>
  #index_footer{
    border-top: 1px solid green;
    height: 25vh;
    color: white;
    padding: 60px 40px;
    padding-bottom: 100px;
    box-sizing: content-box;
    display: flex;
    justify-content: space-between;
  }
  #index_footer a{
    text-decoration: none;
    color: inherit;
  }
  .footer_list ol{
    list-style: none;
    color: gray;
    font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
  }
  .footer_list ol li{
    margin-bottom: 8px;

  }
  .footer_list .list_heading{
    font-weight: 100;
    padding: 15px 0;
    color:white;
font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
  }
</style>
  <footer id="index_footer">
<div class="footer_list">
  <ol >
    <h3 class="list_heading">ABOUT US</h3>
    <li><a href="#">About Us</a></li>
    <li><a href="/Feedback">Feedback or Complaint or other Issues</a></li>
  </ol>
</div>

<div>
  <span><a href="/admin">Login</a></span>
</div>
  </footer>

  <script src="{{URL::asset('js/index.js')}}"></script>
 
</body>
</html>