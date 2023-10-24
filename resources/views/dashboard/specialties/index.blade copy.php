<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="container">
                <h2>Specialties</h2>
            
                <a href="{{ route('specialties-create') }}" class="btn btn-primary mb-3">Add Specialty</a>
            
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($specialties as $specialty)
                            <tr>
                                <td>{{ $specialty->id }}</td>
                                <td>{{ $specialty->name }}</td>
                                <td>
                                    <a href="{{ route('specialties-show', $specialty->id) }}" class="btn btn-info">View</a>
                                    <a href="{{ route('specialties.edit', $specialty->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">No specialties found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
