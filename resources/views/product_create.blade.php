<!DOCTYPE html>
<html>
<head>
   <title>Product</title>
   @vite('resources/js/app.js')
</head>
<body class="bg-neutral-900 text-white">
  <form  method="POST" action="{{ route('products.store') }}" class="flex flex-col">
    @csrf
    <label>Name  
      <input name="name">
    </label>
    <label>Slug  
      <input name="slug">
    </label>
    <label>Price  
      <input name="price_history">
    </label>
    <label>Description  
      <input name="description">
    </label>
    <label>Categories
      <input name="categories">
    </label>
    <button>Submit</button>
  </form>
</body>
</html>