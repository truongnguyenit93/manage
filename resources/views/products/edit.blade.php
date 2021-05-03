<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="post" action="{{ route('products.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="modal-header">
                        <h4 class="modal-title">Edit Product</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" value="{{ $product->name }}" type="text" class="form-control" required />
                        </div>
                        <div class="form-group">
                            <label for="product_type">Loại hàng</label>
                            @php
                                $productTypes = ['Túi xách', 'Nước Hoa', 'Son']
                            @endphp
                            <select name="product_type" class="form-control" id="product_type">
                            @foreach($productTypes as $key => $type)
                                @if($key == $product->product_type)
                                <option value="{{$key}}" selected>{{$type}}</option>
                                @else
                                <option value="{{$key}}">{{$type}}</option>
                                @endif
                            @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phí vận chuyển</label>
                            <input name="transportation_fee" value="{{$product->transportation_fee}}" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Vốn</label>
                            <input name="funds" value="{{$product->funds}}" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label>Tiền lãi</label>
                            <input name="interest" value="{{ $product->interest }}" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <input name="image" type='file' id="imgInp" accept=".png, .jpg, .jpeg" name="avatar"/>
                            <input id="linkImgDefaul" type="hidden" value="{{ URL::asset('storage/default-img.gif') }}">
                            <label for="imageUpload"></label>
                            <img class="img-thumbnail mt-2" id="blah" src="{{ url('storage'.$product->image) }}" alt="your image" />
                        </div>
                        <div class="form-group">
                            <label>FB người bán</label>
                            <input name="name_fb_customer" value="{{$product->name_fb_customer}}" type="text" class="form-control"/>
                        </div>
                        <div class="form-group">
                            @php
                                $customerTypes = ['Chuyển khoản', 'Tiền Mặt']
                            @endphp
                            <label for="customer_type">Kiểu giao dịch</label>
                            <select name="customer_type" class="form-control" id="customer_type">
                                @foreach($customerTypes as $key => $type)
                                    @if($key == $product->customer_type)
                                    <option value="{{$key}}" selected>{{$type}}</option>
                                    @else
                                    <option value="{{$key}}">{{$type}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Mô tả</label>
                            <textarea name="description" class="form-control">{{ $product->description }}</textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a type="button" class="btn btn-default" href="{{ redirect()->back()->getTargetUrl() }}" >Cancel</a>
                        <input type="submit" class="btn btn-success" value="Edit" />
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        const input = document.getElementById('imgInp');
        const imgDefault = document.getElementById('linkImgDefaul');

        input.addEventListener('change', (event) => {
        const target = event.target
            if (target.files && target.files[0]) {

                /*Maximum allowed size in bytes
                    5MB Example
                    Change first operand(multiplier) for your needs*/
                const maxAllowedSize = 1 * 1024 * 1024;
                var reader = new FileReader();
                if (target.files[0].size > maxAllowedSize) {
                    // Here you can ask your users to load correct file
                    target.value = '';
                    $('#blah').hide();
                    alert('File dung lượng quá lớn!')
                } else {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                            $('#blah').attr('src', e.target.result);
                        }
                        $('#blah').show();
                        reader.readAsDataURL(input.files[0]); // convert to base64 string
                    }
                }
            }
        })
    </script>
</x-app-layout>