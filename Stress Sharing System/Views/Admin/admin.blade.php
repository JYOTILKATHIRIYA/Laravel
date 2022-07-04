<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <link rel="stylesheet" href="css/admin/adminstyle.css">
  <link rel="stylesheet" href="css/admin/MentorRequests.css">
  <link rel="stylesheet" href="{{URL::asset('/fontawesome/css/fontawesome.min.css')}}">
  <script src="{{URL::asset('/fontawesome/js/all.min.js')}}"></script>
  <title>Document</title>
</head>
<body>

  <div id="left_nav">
    
    <div class="header">
<span>ADMIN</span>
    </div>

    <div>
    <button><i class="fa-solid fa-link"></i>&nbsp;Requests</button>
  </div>

  </div>


  <div id="window">
  <section id="MentorRequests">
<x-mentor_requests />
  </section>

  
</div>
</body>
</html>