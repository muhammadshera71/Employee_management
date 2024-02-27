<h1>{{ $user->name }}</h1>
<p>Email: {{ $user->email }}</p>
<h2>Employees:</h2>
<ul>
    @foreach ($employees as $employee)
        <li>{{ $employee->name }}</li>
    @endforeach
</ul>