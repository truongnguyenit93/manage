<div id="addEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h4 class="modal-title">Add Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên Sản phầm</label>
                        <input name="name" type="text" class="form-control" required />
                    </div>
                    <div class="form-group">
                        <label for="product_type">Loại hàng</label>
                        @php
                            $productTypes = ['Túi xách', 'Nước Hoa', 'Son']
                        @endphp
                        <select name="product_type" class="form-control" id="product_type">
                            @foreach($productTypes as $key => $type)
                                <option value="{{$key}}">{{$type}}</option>
                            @endif
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Phí vận chuyển</label>
                        <input name="transportation_fee" type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Vốn</label>
                        <input name="funds" type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label>Tiền lãi</label>
                        <input name="interest" type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <input name="image" type='file' id="imgInp" accept=".png, .jpg, .jpeg" name="avatar" required />
                        <input id="linkImgDefaul" type="hidden" value="{{ URL::asset('storage/default-img.gif') }}">
                        <label for="imageUpload"></label>
                        <img class="img-thumbnail mt-2" style="display:none" id="blah" src="{{ URL::asset('storage/default-img.gif') }}" alt="your image" />
                    </div>
                    <div class="form-group">
                        <label>FB người bán</label>
                        <input name="name_fb_customer" type="text" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label for="customer_type">Kiểu giao dịch</label>
                        @php
                            $customerTypes = ['Chuyển khoản', 'Tiền Mặt']
                        @endphp
                        <select name="customer_type" class="form-control" id="customer_type">
                            @foreach($customerTypes as $key => $type)
                                <option value="{{$key}}">{{$type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Mô tả</label>
                        <textarea name="description" class="form-control"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal" />Cancel</button>
                    <button type="submit" class="btn btn-success" />Add</button>
                </div>
            </form>
        </div>
    </div>
</div>