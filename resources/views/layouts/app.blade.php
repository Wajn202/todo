<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Todo App')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Simple styling --}}
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f6f8;
            margin: 0;
            padding: 0;
        }
        header {
            background: #111827;
            color: white;
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        a {
            color: #2563eb;
            text-decoration: none;
        }
        .container {
            padding: 30px;
        }
        .card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }
        .btn-primary {
            background: #2563eb;
            color: white;
        }
        .btn-danger {
            background: #dc2626;
            color: white;
        }
        .btn-secondary {
            background: #6b7280;
            color: white;
        }
        .text-right {
            text-align: right;
        }
        select {
            padding: 4px;
            border-radius: 6px;
        }
        .status {
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            color: white;
        }
        .status.todo { background: #6b7280; }
        .status.in Progress { background: #f59e0b; }
        .status.done { background: #16a34a; }
    </style>
</head>
<body>

<header>
    <div>
        <strong>Todo System</strong>
    </div>

    <div>
        <form action="{{ route('logout') }}" method="POST" style="display:inline">
            @csrf
            <button class="btn btn-secondary">Logout</button>
        </form>
    </div>
</header>
@auth
<p class="btn btn-secondary">Hello, {{ auth()->user()->name }}</p>
@endauth

<div class="container">
    @yield('content')
</div>

<script>
    function confirmDelete(event) {
        event.preventDefault();

        if (confirm('Are you sure you want to delete this item?')) {
            event.target.submit();
            alert('Deleted successfully');
        }
    }
</script>

</body>

</html>