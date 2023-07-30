<!DOCTYPE html>
<html>
<head>
   <title>MyBlog</title>
   @vite('resources/js/app.js')
</head>
<body class="bg-neutral-900 text-white">
   <h1>{{$post->title}}</h1>
   <div>{{$post->body}}</div>
</body>
</html>