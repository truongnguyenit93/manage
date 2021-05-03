<div id="deleteEmployeeModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="" name="deleteProduct" method="post">
                @csrf
                @method('delete')
                <div class="modal-header">
                    <h4 class="modal-title">Delete Product</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <p>Bạn có thật sự muốn xoá món hàng này?</p>
                    <p class="text-warning"><small>Hành động này không thể được hoàn tác.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal"/>Cancel</button>
                    <button type="submit" class="btn btn-danger"/>Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>