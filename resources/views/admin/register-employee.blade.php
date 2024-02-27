

<form action="{{ route('user.registerEmployee', ['users' => $user->id]) }}" method="post">
    @csrf
    <label for="name">Employee Name:</label>
    <input type="text" name="name" required>
    
    <label for="email">Employee Email:</label>
    <input type="email" name="email" required>

    <!-- Add other fields as needed -->

    <button type="submit">Register Employee</button>
</form>