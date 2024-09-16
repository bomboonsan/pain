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


                    <div class="overflow-hidden border border-neutral-200/50 rounded-md shadow bg-white">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-blue-700 uppercase">ชื่อ</th>
                                    <th scope="col" class="px-6 py-3 text-start text-xs font-medium text-blue-700 uppercase">สมัครเมื่อ</th>
                                    <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-blue-700 uppercase">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach ($users as $user)
                                <tr class="hover:bg-gray-100">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                        <a  href="{{ route('userShow', $user->id) }}" class="flex gap-2 items-center">
                                            <img class="w-8 h-8 rounded-full" src="{{ $user->pictureUrl }}" onerror="this.src='https://via.placeholder.com/50x50'" alt="" />
                                            <span class="flex-1">
                                                {{ $user->displayName }}
                                            </span>
                                        </a>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                        {{ $user->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                        <a href="{{ route('userShow', $user->id) }}" class="text-blue-600 hover:text-blue-900">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline-block" viewBox="0 0 795 614"><path fill="currentColor" d="M397.25 278c38 0 69 31 69 69s-31 68-69 68s-68-30-68-68s30-69 68-69zm0-170c226 0 389 212 389 212c11 14 11 39 0 53c0 0-163 212-389 212s-389-212-389-212c-11-14-11-39 0-53c0 0 163-212 389-212zm0 410c94 0 171-77 171-171s-77-171-171-171s-171 77-171 171s77 171 171 171z"/></svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
