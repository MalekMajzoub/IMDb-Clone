<x-layout>
<x-card class="p-10 max-w-lg mx-auto mt-24">
                    <header class="text-center">
                        <h2 class="text-2xl font-bold uppercase mb-1">
                            Edit Category
                        </h2>
                        <p class="mb-4">Edit: {{ $category->title }}</p>
                    </header>

                    <form method="POST" action="/cms/categories/{{ $category->id }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-6">
                            <label
                                for="title"
                                class="inline-block text-lg mb-2"
                                >Category Title</label
                            >
                            <input
                                type="text"
                                class="border border-gray-200 rounded p-2 w-full"
                                name="title"
                                value="{{ $category->title }}"
                            />

                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <button
                                class="bg-yellow-500 text-white rounded py-2 px-4 hover:bg-black"
                            >
                                Update Category
                            </button>

                            <a href="/cms/categories/managecategories" class="text-black ml-4"> Back </a>
                        </div>
                    </form>
                </x-card>
            </x-layout>