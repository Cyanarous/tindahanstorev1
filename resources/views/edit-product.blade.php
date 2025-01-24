<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Edit post</h1>
    <form action="/edit-product/{{$product->id}}" method="POST">
    @csrf
    @method('PUT')
    <input type="text" name="product" value="{{$product->product}}"> 
    <input type="text" name="size" value="{{$product->size}}"> 
    <input type="text" name="category" value="{{$product->category}}"> 
    <input type="text" name="price" value="{{$product->price}}"> 
    <button>Save Changes</button>
    </form>
</body>
</html>