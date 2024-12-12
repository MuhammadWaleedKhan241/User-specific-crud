<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .form-container {
            max-width: 600px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-success,
        .btn-secondary {
            border-radius: 50px;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-success:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .alert-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .form-control {
            box-shadow: none;
            border-radius: 5px;
        }

        .table th {
            background-color: #343a40;
            color: #ffffff;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center mt-5">
        <!-- Form Container -->
        <div class="form-container">
            <h1 class="mb-4 text-center text-primary">Add New Product</h1>

            <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control shadow-sm" value="{{ old('name') }}"
                        placeholder="Enter product name" required>
                    @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control shadow-sm"
                        value="{{ old('price') }}" step="0.01" placeholder="Enter price" required>
                    @error('price')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SKU Field -->
                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="number" name="sku" id="sku" class="form-control shadow-sm" value="{{ old('sku') }}"
                        placeholder="Enter product SKU" required>
                    @error('sku')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="" class="form-label h5">Image</label>
                    <input type="file" class="form-control form-control-lg" placeholder="Price" name="image">
                    @error('image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success shadow">Add Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary shadow">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>