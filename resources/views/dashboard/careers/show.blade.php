<x-app-layout>
    
    <x-dashboard.layout>
        <div class="">
            <div class="dashboard-card">
                <h1 class="title">{{ $career->name }}</h1>        
                

                @if(count($users) > 0)
                    <p class="subtitle">รายชื่อสมาชิกในอาชีพ {{ $career->name }} จำนวน <span class="badge badge-primary">{{ count($users) }}</span> คน</p>
                    <table class="table mt-5">
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
                            <th>license_number</th>
                            <th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($users as $user)
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
                                                <img src="https://i.pravatar.cc/300?img={{ $user->id }}" alt="Avatar Tailwind CSS Component" loading="lazy" />
                                            </div>
                                        </div>
                                        <div>
                                            <div class="font-bold">{{ $user->first_name }} {{ $user->last_name }}</div>
                                            <div class="text-sm opacity-50">LINE DISPLAY</div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a class="table-link" href="{{ route('careers-show', $user->career->id) }}">
                                        {{ $user->career->name }}
                                    </a>
                                    <br/>
                                    <span class="badge badge-ghost badge-sm">{{ $user->specialty->name }}</span>
                                </td>
                                <td>{{ $user->license_number }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->telephone }}</td>
                                <th>
                                    <div class="dropdown dropdown-hover dropdown-top dropdown-end">
                                        <label tabindex="0" class="btn m-1">                                      
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
                @else
                    <div class="alert alert-error">
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>ไม่มีสมาชิกในอาชีพ {{ $career->name }}</span>
                    </div>
                @endif
            </div>
        </div>
    </x-dashboard.layout>

</x-app-layout>
