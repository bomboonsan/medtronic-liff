<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h2 class="title mb-5">รายชื่อผู้ใช้งาน ({{ count($userRegisters) }} คน)</h2>
        
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
        
                <table class="table">
                    <!-- head -->
                    <thead>
                      <tr>
                        <th>
                          <label>
                            <input type="checkbox" class="checkbox" />
                          </label>
                        </th>
                        <th>ชื่อ</th>
                        <th>อาชีพ</th>
                        <th>เลขที่ใบวิชาชีพ</th>
                        <th>อีเมล</th>
                        <th>เบอร์โทร</th>
                        <th>สถานะ</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ($userRegisters as $userRegister)
                        <tr>
                            <th>
                                <label>
                                    <input type="checkbox" class="checkbox" />
                                </label>
                            </th>
                            <td>
                                <div class="flex items-center space-x-3">
                                    <div class="avatar">
                                        <div class="mask mask-squircle w-12 h-12">
                                            <img src="https://i.pravatar.cc/300?img={{ $userRegister->id }}" alt="Avatar Tailwind CSS Component" loading="lazy" />
                                        </div>
                                    </div>
                                    <div>
                                        <div class="font-bold">{{ $userRegister->first_name }} {{ $userRegister->last_name }}</div>
                                        <div class="text-sm opacity-50">LINE DISPLAY</div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <a class="table-link" href="{{ route('careers-show', $userRegister->career->id) }}">
                                    {{ $userRegister->career->name }}
                                </a>
                                <br/>
                                <span class="badge badge-ghost badge-sm">{{ $userRegister->specialty->name }}</span>
                            </td>
                            <td>{{ $userRegister->license_number }}</td>
                            <td>
                                <span class="text-email">{{ $userRegister->email }}</span>                                
                            </td>
                            <td>{{ $userRegister->telephone }}</td>
                            <td>
                                @if($userRegister->status == 'pending')
                                <div class="dropdown dropdown-hover dropdown-left dropdown-end">
                                    <label tabindex="0" class="text-xs bg-base-200 py-1 px-2 rounded-lg text-neutral-500 m-1">                     
                                        {{ $userRegister->status }}
                                    </label>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 status_dropdown_items">
                                        <li>
                                            <form action="{{ route('user_registers.handleApproval', $userRegister->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="text-green-700 flex gap-1 items-center" onclick="return confirm('Are you sure?')">
                                                    <svg class="icon-approval" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m344-60-76-128-144-32 14-148-98-112 98-112-14-148 144-32 76-128 136 58 136-58 76 128 144 32-14 148 98 112-98 112 14 148-144 32-76 128-136-58-136 58Zm34-102 102-44 104 44 56-96 110-26-10-112 74-84-74-86 10-112-110-24-58-96-102 44-104-44-56 96-110 24 10 112-74 86 74 84-10 114 110 24 58 96Zm102-318Zm-42 142 226-226-56-58-170 170-86-84-56 56 142 142Z"/></svg>
                                                    approval
                                                </button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="{{ route('user_registers.handleDisapproval', $userRegister->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="text-red-700 flex gap-1 items-center" onclick="return confirm('Are you sure?')">
                                                    <svg class="icon-suspend" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m754-318-60-62q12-32 19-66.5t7-69.5v-189l-240-90-146 55-62-62 208-78 320 120v244q0 51-11.5 101T754-318Zm38 262L662-186q-38 39-84.5 65.5T480-80q-139-35-229.5-159.5T160-516v-172L56-792l56-56 736 736-56 56ZM423-425Zm91-135Zm-34 396q35-11 67-31t59-47L240-608v92q0 121 68 220t172 132Z"/></svg>
                                                    suspend
                                                </button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                                @endif
                                @if($userRegister->status == 'approved')
                                <form action="{{ route('user_registers.handleDisapproval', $userRegister->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <div class="lg:tooltip" data-tip="click to suspend">
                                        <button type="submit" class="text-xs bg-base-200 py-1 px-2 rounded-lg text-neutral-500 m-1" onclick="return confirm('Suspend this user ?')">approved</button>
                                    </div>
                                </form>
                                @endif
                                @if($userRegister->status == 'disapproved')
                                <form action="{{ route('user_registers.handleApproval', $userRegister->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <div class="lg:tooltip" data-tip="click to approved">
                                        <button type="submit" class="text-xs bg-base-200 py-1 px-2 rounded-lg text-neutral-500 m-1" onclick="return confirm('Approve this user ?')">suspend</button>
                                    </div>
                                </form>
                                @endif
                            </td>
                            <th>
                                <div class="dropdown dropdown-hover dropdown-top dropdown-end">
                                    <label tabindex="0" class="btn btn-sm m-1">                                      
<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24" fill="#111"><path d="M480-160q-33 0-56.5-23.5T400-240q0-33 23.5-56.5T480-320q33 0 56.5 23.5T560-240q0 33-23.5 56.5T480-160Zm0-240q-33 0-56.5-23.5T400-480q0-33 23.5-56.5T480-560q33 0 56.5 23.5T560-480q0 33-23.5 56.5T480-400Zm0-240q-33 0-56.5-23.5T400-720q0-33 23.5-56.5T480-800q33 0 56.5 23.5T560-720q0 33-23.5 56.5T480-640Z"/></svg>
                                    </label>
                                    <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52 table_dropdown_items">
                                        <li>
                                            <a>                                                
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M480-320q75 0 127.5-52.5T660-500q0-75-52.5-127.5T480-680q-75 0-127.5 52.5T300-500q0 75 52.5 127.5T480-320Zm0-72q-45 0-76.5-31.5T372-500q0-45 31.5-76.5T480-608q45 0 76.5 31.5T588-500q0 45-31.5 76.5T480-392Zm0 192q-146 0-266-81.5T40-500q54-137 174-218.5T480-800q146 0 266 81.5T920-500q-54 137-174 218.5T480-200Zm0-300Zm0 220q113 0 207.5-59.5T832-500q-50-101-144.5-160.5T480-720q-113 0-207.5 59.5T128-500q50 101 144.5 160.5T480-280Z"/></svg>
                                                เพิ่มเติม
                                            </a>
                                        </li>
                                        <li>
                                            <a>   
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/></svg>
                                                แก้ไข
                                            </a>
                                        </li>
                                        <li>
                                            <a> 
                                                <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z"/></svg>   
                                                ลบ
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </th>
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
