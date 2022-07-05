<x-layout>
    <x-card class="p-10">
                    <header>
                        <h1
                            class="text-3xl text-center font-bold my-6 uppercase"
                        >
                            Manage Categories
                        </h1>
                    </header>

                    <table class="w-full table-auto rounded-sm">
                        <tbody>
                            @unless($categories->isEmpty())
                            @foreach ($categories as $category)
                            
                            <tr class="border-gray-300">
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                    {{ $category->title }}
                                </td>
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                    <a
                                        href="/cms/categories/{{ $category->id }}/edit"
                                        class="text-blue-400 px-6 py-2 rounded-xl"
                                        ><i
                                            class="fa-solid fa-pen-to-square"
                                        ></i>
                                        Edit</a
                                    >
                                </td>
                                <td
                                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                                >
                                    <form method="POST" action="/cms/categories/{{ $category->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-500"><i class="fa-solid fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <p class="text-center">No Categories Found</p>
                                </td>
                            </tr>
                            @endunless
                        </tbody>
                    </table>
                </x-card>

                <x-card class="mt-4 p-2 px-10 flex space-x-6">
                    <a href="/cms/categories/create">
                        <i class='fa fa-plus' style='color: #19a922'></i> Add
                    </a>
                </x-card>
</x-layout>