<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  {{-- ! le mails sono un filo diverse dagli altri file che non possono leggere i links e quindi per esempio non posso intergrare bootstrap --}}

  <style>
    body{
      font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
      text-align: center;
      background-color: brown;
      color:antiquewhite;
    }
  </style>
  
</head>
<body>
  <h1>Project published correctly</h1>
  <h2>{{$project->name}}</h2>
  <p>
    {{$project->getAbstract()}}
  </p>
</body>
</html>