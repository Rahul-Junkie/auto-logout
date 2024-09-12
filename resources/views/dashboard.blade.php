<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} - {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <router-view />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="https://cdn.socket.io/4.0.1/socket.io.min.js"></script>
<script>
    console.log({{ Auth::id() }});
    
    const socket = io('http://localhost:3001'); // Replace with your Socket.IO server URL

    socket.on('connect', () => {
        console.log('Connected to Socket.IO server:', socket.id);

        @if (Auth::check())
            const userId = "{{ Auth::id() }}";
            socket.emit('join', userId); // Emit 'join' event with user ID
            console.log(`User ${userId} joined room with socket ID ${socket.id}`);
        @endif
    });

    socket.on('force-logout', (data) => {
            console.log('Forced logout received');  // Add a log to confirm the event is received
            if(data.userId=={{Auth::id()}})
            {
                fetch('{{ route('logout') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    credentials: 'include' // Include cookies in the request
                })
                .then(() => {
                    console.log('Logout successful, redirecting...');
                    window.location.href = '/login'; // Redirect after successful logout
                })
                .catch(error => {
                    console.error('Error during logout:', error);
                });
            }
            });
            socket.on('error', (error) => {
            console.error('Socket error:', error);
    });
        socket.on('disconnect', () => {
            console.log('Disconnected from the Socket.IO server.');
        });
</script>