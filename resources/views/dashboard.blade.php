@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-4" x-data="{ showEditModal: false, showDeleteModal: false, showCreateModal: false, deleteUrl: '', userData: {} }" x-cloak>
        <h2 class="text-2xl font-bold mb-4">Dashboard - User Management</h2>

        <!-- Success Message -->
        @if (session('success'))
            <div x-data="{ show: true }" x-show="show"
                class="mb-4 p-4 text-green-700 bg-green-100 border border-green-200 rounded relative">
                <button @click="show = false" class="absolute top-0 right-0 mt-3 mr-3 text-green-700 hover:text-green-900">
                    &times;
                </button>
                {{ session('success') }}
            </div>
        @endif

        <!-- Tombol Add User -->
        <div class="mb-4 w-full flex justify-end z-20">
            <button @click="showCreateModal = true" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                Add User
            </button>
        </div>

        <!-- User Table -->
        <div>
            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Email</th>
                        <th class="border border-gray-300 px-4 py-2">Gender</th>
                        <th class="border border-gray-300 px-4 py-2">Phone</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->gender }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $user->phone }}</td>
                            <td class="border border-gray-300 px-4 py-2 text-center flex justify-center gap-4">
                                <button @click="showEditModal = true; userData = {{ $user->toJson() }}"
                                    class="text-blue-600 border border-blue-400 bg-blue-200 hover:bg-blue-300 rounded-md px-6 py-1 hover:underline"
                                    title="Edit User">Edit</button>
                                <button
                                    @click="showDeleteModal = true; deleteUrl = '{{ route('users.destroy', $user->id) }}'"
                                    class="text-red-600 border border-red-400 bg-red-200 hover:bg-red-300 rounded-md px-4 py-1 hover:underline"
                                    title="Delete User">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modal Add User -->
            <div x-show="showCreateModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h3 class="text-lg font-bold mb-4">Add New User</h3>
                    <form action="{{ route('users.create') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                class="w-full border border-gray-300 rounded px-4 py-2">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full border border-gray-300 rounded px-4 py-2">
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700">Gender</label>
                            <select name="gender" id="gender" class="w-full border border-gray-300 rounded px-4 py-2">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="w-full border border-gray-300 rounded px-4 py-2">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="showCreateModal = false"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded mr-2 hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">
                                Create
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Edit Modal -->
            <div x-show="showEditModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h3 class="text-lg font-bold mb-4">Edit User</h3>
                    <form :action="'{{ route('users.update', '') }}/' + userData.id" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700">Name</label>
                            <input type="text" name="name" id="name"
                                class="w-full border border-gray-300 rounded px-4 py-2" x-model="userData.name">
                        </div>
                        <div class="mb-4">
                            <label for="email" class="block text-gray-700">Email</label>
                            <input type="email" name="email" id="email"
                                class="w-full border border-gray-300 rounded px-4 py-2" x-model="userData.email">
                        </div>
                        <div class="mb-4">
                            <label for="gender" class="block text-gray-700">Gender</label>
                            <select name="gender" id="gender" class="w-full border border-gray-300 rounded px-4 py-2"
                                x-model="userData.gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="phone" class="block text-gray-700">Phone</label>
                            <input type="text" name="phone" id="phone"
                                class="w-full border border-gray-300 rounded px-4 py-2" x-model="userData.phone">
                        </div>
                        <div class="flex justify-end">
                            <button type="button" @click="showEditModal = false"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded mr-2 hover:bg-gray-400">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Delete Modal -->
            <div x-show="showDeleteModal"
                class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 z-50">
                <div class="bg-white p-6 rounded shadow-lg w-1/3">
                    <h3 class="text-lg font-bold mb-4">Confirm Delete</h3>
                    <p>Are you sure you want to delete this user? This action cannot be undone.</p>
                    <div class="mt-4 flex justify-end">
                        <div class="">
                            <button @click="showDeleteModal = false"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded mr-2 hover:bg-gray-400">
                                Cancel
                            </button>
                        </div>
                        <form x-bind:action="deleteUrl" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>

    <canvas id="categoryChart"></canvas>
    <canvas id="dailyChart"></canvas>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Pie Chart
        const categoryData = @json($categories);
        new Chart(document.getElementById('categoryChart'), {
            type: 'pie',
            data: {
                labels: categoryData.map(c => c.gender),
                datasets: [{
                    data: categoryData.map(c => c.total),
                    backgroundColor: ['#FF6384', '#36A2EB']
                }]
            }
        });

        // Bar Chart
        const dailyData = @json($dailyData);
        new Chart(document.getElementById('dailyChart'), {
            type: 'bar',
            data: {
                labels: dailyData.map(d => d.date),
                datasets: [{
                    label: 'Users',
                    data: dailyData.map(d => d.total),
                    backgroundColor: '#4CAF50'
                }]
            }
        });
    </script>
@endsection

<script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
