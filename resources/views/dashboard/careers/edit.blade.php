<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="max-w-md mx-auto">
                <div class="dashboard-box">
                    <h2 class="title">Edit Specialty</h2>
            
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
            
                    <form action="{{ route('specialties.update', $specialty->id) }}" method="POST">
                        @csrf
                        @method('PUT') {{-- Use PUT method for updates --}}
                        <div class="mb-3">
                            <label for="name" class="form-label">Specialty Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $specialty->name }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
