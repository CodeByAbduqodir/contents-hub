<!DOCTYPE html>
<html>
<head>
    <title>Create Content</title>
</head>
<body>
    <h1>Create New Content</h1>

    <form action="{{ route('contents.store') }}" method="POST">
        @csrf

        <div>
            <label for="type">Type:</label>
            <select name="type" id="type" required>
                <option value="video">Video</option>
                <option value="book">Book</option>
                <option value="audio">Audio</option>
            </select>
        </div>

        <div>
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" required>
        </div>

        <div>
            <label for="description">Description:</label>
            <textarea name="description" id="description"></textarea>
        </div>

        <div>
            <label for="url">URL:</label>
            <input type="url" name="url" id="url">
        </div>

        <button type="submit">Create</button>
    </form>

    <a href="{{ route('contents.index') }}">Back to List</a>
</body>
</html>