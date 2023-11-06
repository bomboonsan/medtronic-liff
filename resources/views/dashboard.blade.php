<x-app-layout>
    <x-dashboard.layout>
        <div class="grid grid-cols-3 gap-10">
            <div class="dashboard-card">
                <h2 class="title">ผู้ใช้งานทั้งหมด</h2>
                <p class="mb-5">จำนวนทั้งหมด {{$userRegisters->count()}} คน</p>
                <canvas id="usersChart" width="400" height="300"></canvas>
            </div>
            <div class="dashboard-card col-span-2">
                <h2 class="title">จำนวนการสมัครในแต่ละเดือน</h2>
                <canvas id="usersMonth" width="600" height="300"></canvas>
            </div>
            <div class="dashboard-card">
                <h2 class="title">Specialties</h2>
                <canvas id="userSpecialties" width="600" height="300"></canvas>
            </div>
            <div class="dashboard-card">
                <h2 class="title">Careers</h2>
                <canvas id="userCareers" width="600" height="300"></canvas>
            </div>
            <div class="dashboard-card">
                <h2 class="title">INBOX</h2>
                <canvas id="userInbox" width="600" height="300"></canvas>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            // ผู้ใช้งานทั้งหมด
            const usersChart = document.getElementById('usersChart');
            new Chart(usersChart, {
              type: 'doughnut',
              data: {
                labels: [
                    'Approval',
                    'Pending',
                    'Suspend'
                ],
                datasets: [{
                  label: 'ผู้ใช้งาน ',
                  data: [{{$userPending->count()}}, {{$userApproved->count()}}, {{$userDisapproved->count()}}],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });

            // จำนวนการสมัครในแต่ละเดือน
            const usersMonth = document.getElementById('usersMonth');
            new Chart(usersMonth, {
              type: 'bar',
              data: {
                labels: [
                    @forelse ($usersMonth as $month)
                        'เดือน {{ $month->month }}',
                    @empty
                    @endforelse
                ],
                datasets: [{
                  label: 'ผู้ใช้งาน ',
                  data: [
                    @forelse ($usersMonth as $month)
                        {{ $month->count }},
                    @empty
                    @endforelse
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });

            // จำนวนการสมัครในแต่ละ Careers
            const userCareers = document.getElementById('userCareers');
            new Chart(userCareers, {
              type: 'doughnut',
              data: {
                labels: [
                    @forelse ($userCareers as $career)
                        '{{ $career->career_name }}',
                    @empty
                    @endforelse
                ],
                datasets: [{
                  label: 'ผู้ใช้งาน ',
                  data: [
                    @forelse ($userCareers as $career)
                        {{ $career->count }},
                    @empty
                    @endforelse
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });


            // จำนวนการสมัครในแต่ละ Specialties
            const userSpecialties = document.getElementById('userSpecialties');
            new Chart(userSpecialties, {
              type: 'doughnut',
              data: {
                labels: [
                    @forelse ($userSpecialties as $specialty)
                        '{{ $specialty->specialty_name }}',
                    @empty
                    @endforelse
                ],
                datasets: [{
                  label: 'ผู้ใช้งาน ',
                  data: [
                    @forelse ($userSpecialties as $specialty)
                        {{ $specialty->count }},
                    @empty
                    @endforelse
                  ],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });

             // Inbox กล่องข้อความ
             const userInbox = document.getElementById('userInbox');
            new Chart(userInbox, {
              type: 'doughnut',
              data: {
                labels: [
                    'Read',
                    'Unread',
                ],
                datasets: [{
                  label: 'ผู้ใช้งาน ',
                  data: [{{$contactsRead->count()}}, {{$contactsNoRead->count()}}],
                  borderWidth: 1
                }]
              },
              options: {
                scales: {
                  y: {
                    beginAtZero: true
                  }
                }
              }
            });
        </script>
    </x-dashboard.layout>

</x-app-layout>
