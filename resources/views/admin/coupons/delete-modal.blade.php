<form method="POST" action="{{ route('coupons.destroy') }}">
    @csrf
    <div class="modal fade text-left" id="defaultSize" tabindex="-1" role="dialog" aria-labelledby="myModalLabel18"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel18"><i class="la la-tree"></i> ارشفه الخصم</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="coupon_id">
                    <p id="coupon_name_id">
                    </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn grey btn-outline-secondary" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-outline-primary">ارشفه</button>
                </div>
            </div>
        </div>
    </div>
</form>
