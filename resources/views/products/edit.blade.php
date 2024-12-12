<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
        }

        .btn-primary,
        .btn-secondary {
            border-radius: 50px;
        }

        .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #218838;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
        }

        .preview-image {
            display: block;
            margin-top: 10px;
            border-radius: 8px;
            max-width: 150px;
            max-height: 150px;
        }

        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 2rem;
        }

        .form-label {
            font-weight: 600;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>
</head>

<body>
    <div class="container mt-5 d-flex justify-content-center">
        <!-- Edit Product Form Container -->
        <div class="form-container shadow p-4 rounded bg-white">
            <!-- Page Title -->
            <div class="text-center mb-5">
                <h1 class="fw-bold text-primary">Edit Product</h1>
                <p class="text-muted">Update the product details below.</p>
            </div>

            <!-- Edit Product Form -->
            <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Name Field -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control shadow-sm"
                        value="{{ old('name', $product->name) }}" required>
                    @error('name')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Price Field -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" name="price" id="price" class="form-control shadow-sm"
                        value="{{ old('price', $product->price) }}" step="0.01" required>
                    @error('price')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- SKU Field -->
                <div class="mb-3">
                    <label for="sku" class="form-label">SKU</label>
                    <input type="number" name="sku" id="sku" class="form-control shadow-sm"
                        value="{{ old('sku', $product->sku) }}" required>
                    @error('sku')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Image Field -->
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    <input type="file" name="image" id="image" class="form-control shadow-sm" accept="image/*">
                    <div id="imagePreviewContainer">
                        @if($product->image)
                        <img id="imagePreview" src="{{ asset('storage/' . $product->image) }}"
                            alt="{{ $product->name }}" class="preview-image">
                        @else
                        <img id="imagePreview" src="" alt="Preview" class="preview-image" style="display:none;">
                        @endif
                    </div>
                    @error('image')
                    <div class="text-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Action Buttons -->
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary shadow">Update Product</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary shadow">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Image Preview Script -->
    <script>
        document.getElementById('image').addEventListener('change', function (event) {
            const preview = document.getElementById('imagePreview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        });
    </script>
</body>

</html>