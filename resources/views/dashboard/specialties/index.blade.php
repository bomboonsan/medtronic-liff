<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="flex flex-wrap gap-5">
                <div class="basis-[20%] w-[20%]">
                    <div class="dashboard-card">
                        <h2 class="title mb-5">เพิ่มตำแหน่งงาน</h2>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                
                        <form action="{{ route('specialties.store') }}" method="POST">
                            @csrf
                            <div class="flex gap-2">
                                <input type="text" class="input input-bordered input-sm w-full max-w-xs" id="name" name="name" placeholder="ชื่อตำแหน่งงาน" required />
                                <button type="submit" class="btn btn-sm btn-primary">เพิ่ม</button>
                            </div>
                        </form>
                        <div class="form-text">
                            <p>
                                เพิ่มตำแหน่งงานได้ง่ายๆ โดยเพียงกรอกชื่อหมวดหมู่ที่ต้องการในช่องที่กำหนด และกดปุ่ม 'เพิ่ม' เพื่อบันทึกการเปลี่ยนแปลงของคุณ!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="flex-1">
                    <div class="dashboard-card">
                        <h2 class="title mb-5">รายชื่อตำแหน่งงาน</h2>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                
                        <table class="table">
                            <col style="width:30px">
                            <col style="width:auto">
                            <col style="width:20%">
                            <thead>
                                <tr>
                                    <th>ลำดับ</th>
                                    <th>ชื่อตำแหน่ง</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($specialties as $index => $specialty)
                                    <tr>
                                        {{-- <td>{{ $specialty->id }}</td> --}}
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <a class="table-link" href="{{ route('specialties-show', $specialty->id) }}">{{ $specialty->name }}</a>                                            
                                        </td>
                                        <td>
                                            {{-- <a href="{{ route('specialties-edit', $specialty->id) }}" class="btn btn-warning btn-sm">Edit</a> --}}
                                            <button class="btn btn-warning btn-sm" onclick="edit_modal_{{ $specialty->id }}.showModal()">
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/></svg>
                                                {{-- แก้ไข --}}
                                            </button>
                                            <dialog id="edit_modal_{{ $specialty->id }}" class="modal">
                                                <div class="modal-box">
                                                    <h3 class="font-bold text-lg mb-4">แก้ไข {{ $specialty->name }}</h3>
                                                    <form action="{{ route('specialties.update', $specialty->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT') {{-- Use PUT method for updates --}}
                                                        <div class="flex gap-3 items-center">
                                                            <div class="flex-1">
                                                                <input type="text" class="input input-bordered input-sm w-full" name="name" value="{{ $specialty->name }}" required>
                                                            </div>
                                                            <button type="submit" class="btn btn-primary btn-sm">บันทึก</button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <form method="dialog" class="modal-backdrop">
                                                <button>close</button>
                                                </form>
                                            </dialog>
                                            <form action="{{ route('specialties.destroy', $specialty->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-error btn-sm" onclick="return confirm('Are you sure?')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z"/></svg>   
                                                    {{-- ลบ --}}
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">No specialty found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
