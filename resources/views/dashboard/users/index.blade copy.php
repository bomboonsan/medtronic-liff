<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="container">
                <h2>User Registrations</h2>
        
                <a href="{{ route('user-register') }}" class="btn btn-primary mb-3">Add User Registration</a>
        
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
        
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Line Img</th>
                            <th>Line Token</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Career</th>
                            <th>Specialty</th>
                            <th>License Number</th>
                            <th>Email</th>
                            <th>Telephone</th>
                            <th>Consented</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($userRegisters as $userRegister)
                            <tr>
                                <td>{{ $userRegister->id }}</td>
                                <td>{{ $userRegister->line_token }}</td>
                                <td>{{ $userRegister->line_img }}</td>
                                <td>{{ $userRegister->first_name }}</td>
                                <td>{{ $userRegister->last_name }}</td>
                                <td>{{ $userRegister->career->name }}</td>
                                <td>{{ $userRegister->specialty->name }}</td>
                                <td>{{ $userRegister->license_number }}</td>
                                <td>{{ $userRegister->email }}</td>
                                <td>{{ $userRegister->telephone }}</td>
                                <td>{{ $userRegister->consented ? 'Yes' : 'No' }}</td>
                                <td>
                                    <a href="{{ route('user_registers.show', $userRegister->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('user_registers.edit', $userRegister->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('user_registers.destroy', $userRegister->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11">No user registrations found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
