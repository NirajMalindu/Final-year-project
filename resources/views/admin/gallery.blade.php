<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Gallery Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f3f7fa;
            color: #333;
        }

        header {
            background:rgb(221, 222, 224);
            color: black;
            padding: 25px 0;
            text-align: center;
            font-size: 30px;
            font-weight: 600;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .container {
            max-width: 1100px;
            margin: 40px auto;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.05);
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 22px;
            border-bottom: 2px solid #e0e0e0;
            padding-bottom: 8px;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            margin-bottom: 40px;
        }

        input[type="text"],
        input[type="file"] {
            padding: 14px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 15px;
            background-color: #f9f9f9;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="file"]:focus {
            border-color: #3498db;
            outline: none;
        }

        button {
            padding: 14px;
            background-color:rgb(229, 170, 50);
            color: white;
            border: none;
            width:150px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: rgb(210, 173, 100);;
            transform: translateY(-1px);
        }

        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 25px;
        }

        .gallery-item {
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0,0,0,0.05);
            position: relative;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .gallery-item:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 30px rgba(0,0,0,0.08);
        }

        .gallery-item img {
            width: 100%;
            height: 300px;
            object-fit: cover;
        }

        .gallery-info {
            padding: 12px 15px;
            text-align: center;
        }

        .gallery-info strong {
            display: block;
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 5px;
        }

        .gallery-info small {
            font-size: 13px;
            color: #888;
        }

        .delete-form {
            position: absolute;
            top: 12px;
            right: 12px;
        }

        .delete-btn {
            background-color: #e74c3c;
            border: none;
            color: white;
            padding: 6px 10px;
            font-size: 12px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .delete-btn:hover {
            background-color: #c0392b;
        }

        @media (max-width: 600px) {
            .gallery-item img {
                height: 200px;
            }
        }
    </style>
</head>
<body>

<header>
 Gallery Management
</header>

<div class="container">
    <h2>Upload New Image</h2>
    <form action="/admin/gallery/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="title" placeholder="Image Title" required>
        <input type="text" name="tag" placeholder="Tag (optional)">
        <input type="file" name="image" accept="image/*" required>
        <button type="submit">Upload Image</button>
    </form>

    <h2>All Gallery Images</h2>

    <div class="gallery-grid">
        @forelse($galleries as $gallery)
            <div class="gallery-item">
                <img src="{{ asset('uploads/gallery/' . $gallery->image) }}" alt="{{ $gallery->title }}">
                <div class="gallery-info">
                    <strong>{{ $gallery->title }}</strong>
                    <small>{{ $gallery->tag ?? 'No tag' }}</small>
                </div>
                <form class="delete-form" action="/admin/gallery/delete/{{ $gallery->id }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this image?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-btn">Delete</button>
                </form>
            </div>
        @empty
            <p>No images in gallery yet.</p>
        @endforelse
    </div>
</div>

</body>
</html>
