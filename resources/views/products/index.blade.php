<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="container">
                    <div class="table-wrapper">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h2>Manage <b>Products</b></h2>
                                </div>
                                <div class="col-sm-6">
                                    <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="fas fa-plus"></i> <span>Add New Product</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <form action="{{ route('products.index') }}" method="GET">
                                <div class="p-1 bg-light rounded rounded-pill shadow-sm mb-4">
                                    <div class="input-group">
                                        <input type="search" name="search" placeholder="Nhập từ bạn cần tìm?" aria-describedby="button-addon1" class="form-control border-0 bg-light">
                                        <div class="input-group-append">
                                            <button id="button-addon1" type="submit" class="btn btn-link text-primary"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table id="products" class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên Hàng</th>
                                    <th>Loại Hàng</th>
                                    <th>Kiểu giao dịch</th>
                                    <th>Phí vận chuyển</th>
                                    <th>Vốn</th>
                                    <th>Tiền lãi</th>
                                    <th>Hình ảnh</th>
                                    <th>Ngày nhập</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $index = 1 @endphp
                                @forelse($products as $product)
                                
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $product->name }}</td>
                                    <td>@if ($product->product_type == 1)
                                        Túi xách
                                    @else
                                        nước hoa
                                    @endif</td>
                                    <td>
                                    @if ($product->customer_type == 1)
                                        Chuyển Khoản
                                    @else
                                        Tiền mặt
                                    @endif
                                    </td>
                                    <td>{{ number_format($product->transportation_fee) }}</td>
                                    <td>{{ number_format($product->funds) }}</td>
                                    <td>{{ number_format($product->interest) }}</td>
                                    <td>            
                                        <img src="{{ url('storage'.$product->image) }}" style="width: 40px; height: 40px; border-radius: 50%;">
                                    </td>
                                    <td>{{ $product->created_at }}</td>
                                    <td>
                                        <a href="{{ route('products.edit', ['product' => $product->id]) }}" class="edit"><i class="fas fa-edit"></i></a>
                                        <a href="#deleteEmployeeModal" class="delete" data-toggle="modal" data-route="{{ route('products.destroy', ['product' => $product->id]) }}"><i class="fas fa-trash"></i></a>
                                    </td>
                                </tr>
                                @php $index ++ @endphp
                                @empty
                                <tr>
                                    không có data
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="clearfix">
                            <ul class="pagination">
                                {{ $products->links() }}
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- Add Modal HTML -->
                @include('products.modal_add')
                <!-- Delete Modal HTML -->
                @include('products.modal_delete')
            </div>
        </div>
    </div>
    
    <script>
        $(document).ready(function(){
            // $('#products').DataTable();
        // Activate tooltip
            $('[data-toggle="tooltip"]').tooltip();

            // Select/Deselect checkboxes
            var checkbox = $('table tbody input[type="checkbox"]');
            $("#selectAll").click(function(){
            if(this.checked){
                checkbox.each(function(){
                    this.checked = true;
                });
            } else{
                checkbox.each(function(){
                    this.checked = false;
                });
            } 
            });
            checkbox.click(function(){
            if(!this.checked){
                $("#selectAll").prop("checked", false);
            }
            });

            $('.delete').on('click', function (e) {
                var route = e.target.parentElement.dataset.route;
                if (route == undefined) {
                    var route = e.target.dataset.route;
                }
                document.deleteProduct.action = route;
            })
        });

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
        $('[data-dismiss=modal]').on('click', function (e) {
            var $t = $(this),
                target = $t[0].href || $t.data("target") || $t.parents('.modal') || [];
            
        $(target)
            .find("input,textarea,select")
            .val('')
            .end()
            .find("input[type=checkbox], input[type=radio]")
            .prop("checked", "")
            .end();
        })

    </script>
</x-app-layout>