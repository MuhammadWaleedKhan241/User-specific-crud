<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .table img {
            border-radius: 8px;
            object-fit: cover;
        }

        .btn-primary,
        .btn-warning,
        .btn-danger {
            border-radius: 50px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .alert-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .table th {
            background-color: #343a40;
            color: #ffffff;
        }

        .table td {
            background-color: #ffffff;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .card {
            border-radius: 15px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <!-- Page Title -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Product Management</h1>
            <p class="text-muted">Manage your products with ease.</p>
        </div>

        <!-- Flash Message -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Add Product Button -->
        <div class="d-flex justify-content-start mb-4">
            <a href="{{ route('dashboard') }}" class="btn btn-primary shadow">
                <i class="bi bi-table"></i> Dashboard
            </a>
        </div>
        <div class="d-flex justify-content-end mb-4">
            <a href="{{ route('products.create') }}" class="btn btn-primary shadow">
                <i class="bi bi-plus-circle"></i> Add New Product
            </a>
        </div>

        <!-- Products Table -->
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Sku</th>
                        <th>Price</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($products->isNotEmpty())
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>

                        <td>{{ $product->name }}</td>
                        <td>{{ $product->sku }}</td>
                        <td>${{ $product->price }}</td>
                        <td>
                            @if ($product->image != "")
                            <img width="50" src="{{ asset('uploads/products/'.$product->image) }}" alt="">
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('products.edit', $product->id) }}"
                                class="btn btn-warning text-white">Edit</a>
                            <a href="#" onclick="deleteProduct({{ $product->id }})" class="btn btn-danger">Delete</a>
                            <form id="delete-product-from-{{ $product->id }}"
                                action="{{ route('products.destroy', $product->id) }}" method="post">
                                @csrf
                                @method('delete')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="6" class="text-center">No products found.</td>
                    </tr>
                    @endif
                </tbody>

            </table>

            <script>
                function deleteProduct(productId) {
                    if (confirm('Are you sure you want to delete this product?')) {
                        document.getElementById('delete-product-from-' + productId).submit();
                    }
                }
            </script>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>