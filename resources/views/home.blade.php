<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
    <p> you are logged in
    <form action="/logout" method="POST">
        @csrf
        <button>Log Out</button>
    </form>
    <div style="border: 3px solid black">
        <h2>Add a product</h2>
        <form action="/create-product" method="POST">
        @csrf
        <input name="product" type="text" placeholder="Product">
        <input name="size" type="text" placeholder="100ml/2pcs">
        <input name="category" type="text" placeholder="Category">
        <input name="price" type="text" placeholder="100">
        <button>Add</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Products</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
        @foreach($products as $product)
                <tbody>
                    <tr>
                        <td>{{$product['id']}}</td>
                        <td>{{$product['product']}}</td>
                        <td>{{$product['size']}}</td>
                        <td>{{$product['category']}}</td>
                        <td>{{$product['price']}}</td>
                        <td><a href="/edit-product/{{$product->id}}"">Edit</a></td>
                        <td><form action="/delete-product/{{$product->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button>Delete</button>
                        </form></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
    
    @else
    <div style="border: 3px solid black">
        <h2>Register</h2>
        <form action="/register" method="POST">
            <!-- only works on laravel -->
            @csrf 
            <input name="name" type="text" placeholder="name">
            <input name="email" type="text" placeholder="email">
            <input name="password" type="password" placeholder="password">
            <button>Register</button>
        </form>
    </div>
    <div style="border: 3px solid black">
        <h2>Log In</h2>
        <form action="/login" method="POST">
            <!-- only works on laravel -->
            @csrf 
            <input name="loginname" type="text" placeholder="name">
            <input name="loginpassword" type="password" placeholder="password">
            <button>Log in</button>
        </form>
    </div>
    @endauth
    
</body>
</html>