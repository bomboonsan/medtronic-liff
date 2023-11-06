<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h2 class="title mb-5">กิจกรรมทั้งหมด</h2>
        
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Thumbnail</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($events as $event)
                            <tr>
                                <td>
                                    <a href="{{ route('events.show', $event->id) }}" class="table-link">
                                        {{ $event->title }}
                                    </a>                                    
                                </td>
                                <td>{{ $event->start_date }}</td>
                                <td>{{ $event->end_date }}</td>
                                <td>
                                    @if ($event->thumbnail)
                                        {{-- <img src="{{ asset('storage/thumbnails/' . $event->thumbnail) }}" alt="Thumbnail" style="max-width: 100px; max-height: 100px;"> --}}  
                                        <a href="{{ asset($event->thumbnail) }}" target="_blank">
                                            <img src="{{ asset($event->thumbnail) }}" alt="Thumbnail" class="rounded-lg shadow aspect-[4/3] object-cover max-w-[100px] max-h-[100px]" >   
                                        </a>                                 
                                    @else
                                        No Thumbnail
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('events.edit', $event->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('events.destroy', $event->id) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">No events available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
                <div class="mt-5">
                    {{-- {{ $userRegisters->links() }} --}}
                </div>
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
