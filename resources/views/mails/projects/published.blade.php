

<x-mail::message>
 # {{$published_text}}
  ##  {{$project->name}}
 
  <p>
    {{$project->getAbstract(100)}}
  </p>

 @if($project->published)
 {{-- qui diamo nella mail il link per vue --}}
  <x-mail::button :url="$button_url">
    View Project
  </x-mail::button>
  @endif

  Thanks,<br>
  {{ config('app.name') }}
</x-mail::message>



{{-- ! le mails sono un filo diverse dagli altri file che non possono leggere i links e quindi per esempio non posso intergrare bootstrap --}}
{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">


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
  <h1>{{$published_text}}</h1>
  <h2>{{$project->name}}</h2>
  <p>
    {{$project->getAbstract()}}
  </p>
</body>
</html> --}}




