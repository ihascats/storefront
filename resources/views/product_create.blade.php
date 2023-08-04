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
    <label>Specification name  
      <input name="specification_name">
    </label>
    <label>Specification description
      <input name="specification_description">
    </label>
    <label>Discount
      <input name="discount">
    </label>
    <label>Discount exp date
      <input name="discount_exp_date">
    </label>
    <label>Variant color
      <input name="variant_color">
    </label>
    <label>Variant quantity
      <input name="variant_quantity">
    </label>
    <label>Variant sizes
      <input name="variant_sizes">
    </label>
    <label>Categories
      <input name="categories">
    </label>
    <button>Submit</button>
  </form>
</body>
</html>