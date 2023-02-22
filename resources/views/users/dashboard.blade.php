
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}

                    <body>

                    <h2>HTML Table</h2>

                    <table>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        
                    </tr>
                    @foreach($results as $result)
                    <tr>
                        <td>{{ $result->name }}</td>
                        <td>{{ $result->email }}</td>
                        
                    </tr>
                    @endforeach
                    </table>

                    </body>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
