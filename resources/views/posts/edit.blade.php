<x-layout>
    @extends('layout.app')
    <section class="px-6 py-8">
        <div class="row my-3">
            <div class="col-span-8">
                <div class="col-lg-8 mx-auto">
                    <div class="card shadow">
                        <div class="card-header bg-primary">
                            <h3 class="text-light fw-bold">Edit Post</h3>
                        </div>
                        <div class="card-body p-4">
                            <form action="/posts/{{ $post->uuid }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="my-2">
                                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                           for="category_id">
                                        Category
                                    </label>
                                    <select name="category_id" id="category_id" class="form-control"
                                            placeholder="Category">
                                        @php
                                            $categories = \App\Models\Category::all();
                                        @endphp
                                        @foreach(@$categories as $category)
                                            <option
                                                value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
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
                                    <input type="text" name="title" id="title" class="form-control" placeholder="Title"
                                           value="{{ $post->title }}" required>
                                </div>
                                <div class="my-2">
                                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                           for="price">
                                        Price
                                    </label>
                                    <input type="text" name="price" id="price" class="form-control" placeholder="Price"
                                           value="{{ $post->price }}" required>
                                </div>
                                <div class="my-2">
                                    <label class="block mb-2 uppercase font-bold text-xs text-gray-700"
                                           for="body">
                                        Description
                                    </label>
                                    <textarea type="text" name="body" id="body" class="form-control"
                                              placeholder="Description" required>{{ $post->body }}</textarea>
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
                                <div class="my-2 d-flex flex-row justify-between" style="">
                                    <input value="Cancel" class="btn btn-warning" onclick="history.back()"/>
                                    <input type="submit" value="Update" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
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

</script>
