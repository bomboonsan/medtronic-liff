<x-guest-layout>
    <div class="bg-register">
        @if (!empty($userRegister))
            @if ($userRegister->status == 'approved')
            <h1>
                {{ $userRegister->first_name }} {{ $userRegister->last_name }}
            </h1>
            <p>{{ $userRegister->status }}</p>
            @endif
            @if ($userRegister->status == 'pending')
                <h1>
                    {{ $userRegister->first_name }} {{ $userRegister->last_name }}
                </h1>
                <p>{{ $userRegister->status }}</p>
            @endif
            @if ($userRegister->status == 'disapproved')
                <h1>
                    {{ $userRegister->first_name }} {{ $userRegister->last_name }}
                </h1>
                <p>{{ $userRegister->status }}</p>
            @endif
        @else
            <h1>
                GO TO Register
            </h1>
        @endif        
    </div>    
</x-guest-layout>
