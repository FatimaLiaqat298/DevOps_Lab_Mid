<!DOCTYPE html>
<html>
<head>
    <title>Student Management System</title>
    <style>
        body { font-family: Arial; max-width: 700px; margin: 40px auto; }
        input, button { padding: 10px; margin: 5px 0; }
        input { width: 95%; }
        button { background: #087f5b; color: white; border: 0; cursor: pointer; }
        li { padding: 8px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>
    <h1>Student Management System</h1>

    @if(session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <p class="error">{{ $error }}</p>
        @endforeach
    @endif

    <h3>Add Student</h3>
    <form method="POST" action="/students">
        @csrf
        <input name="name" placeholder="Student name" required>
        <input type="email" name="email" placeholder="Student email" required>
        <button type="submit">Save Student</button>
    </form>

    <h3>Registered Students</h3>
    <ul>
        @forelse($students as $student)
            <li>{{ $student->name }} — {{ $student->email }}</li>
        @empty
            <li>No students added yet.</li>
        @endforelse
    </ul>
</body>
</html>
