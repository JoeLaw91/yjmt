<x-layout>
{{--    @php dd($errors) @endphp--}}
    @extends('layout.app')
    <section class="px-6 py-8">
        <div class="row my-3">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow">
                    <div class="card-header">
                        <h3 class="text-black fw-bold">Add New Post</h3>
                    </div>
                    <div class="card-body p-4">
                        <form action="{{route('post.create')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="my-2">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="category_id">
                                    Category
                                </label>
                                <select name="category_id" id="category_id" class="form-control" placeholder="Category">
                                    @php
                                        $categories = \App\Models\Category::all();
                                    @endphp
                                    @foreach(@$categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="title">
                                    Title
                                </label>
                                <input class="form-control"
                                       placeholder="Title"
                                       type="text"
                                       name="title"
                                       id="title"
                                       value="{{ old('title') }}"
                                       required>
                                @error('title')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="price">
                                    Price
                                </label>
                                <input class="form-control"
                                       placeholder="Price"
                                       type="text"
                                       name="price"
                                       id="price"
                                       value="{{ old('price') }}"
                                       required>
                                @error('price')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="body">
                                    Description
                                </label>
                                <textarea class="form-control"
                                          placeholder="Description"
                                          type="text"
                                          name="body"
                                          id="body"
                                          required>
                                    {{ old('body') }}
                                </textarea>
                                @error('description')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2">
                                <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                       for="images">
                                    Images
                                </label>
                                <input type="file" name="images[]" id="images" accept="image/*" multiple="multiple"
                                       class="form-control @error('file') is-invalid @enderror">
                                <br/>
                                <div class="col-md-12 mb-2 flex flex-row px-2 overflow-y-auto" id="images_holder">
                                    <img id="no_image_placeholder" src="/images/no-image-available.jpg"
                                         alt="preview image" class="rounded-xl" style="max-height: 250px;">
                                </div>
                                @error('file')
                                <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="my-2" style="text-align: right;">
                                <input type="submit" value="Add Post" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layout>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
    $(document).ready(function (e) {
        $('#images').change(function () {
            for (let i = 0; i < this.files.length; i++) {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#no_image_placeholder').hide();
                    console.log(e.target);
                    $($.parseHTML('<img style="max-height: 120px" class="px-1">')).attr('src', e.target.result).appendTo($('#images_holder'));
                }
                reader.readAsDataURL(this.files[i]);
            }
        });
    });

    var textarea = document.getElementById("body");
    var placeholder = "Description";

    textarea.value = placeholder;
    textarea.style.color = "#999";

    textarea.addEventListener("focus", function () {
        if (textarea.value === placeholder) {
            textarea.value = "";
            textarea.style.color = "#000";
        }
    });

    textarea.addEventListener("blur", function () {
        if (textarea.value === "") {
            textarea.value = placeholder;
            textarea.style.color = "#999";
        }
    });

</script>
