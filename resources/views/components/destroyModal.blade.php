<div class="modal fade text-body" id="destroyModal" tabindex="-1" role="dialog" aria-labelledby="destroyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroyModalLabel">{{ $title }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        您將刪除:
        <br>
        {!! $message !!}
        <br>
        此操作無法還原，確定繼續?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">取消</button>
        <form method="POST" action="{!! $target !!}">
          <input name="_method" type="hidden" value="DELETE">
          {{ csrf_field() }}
          <button type="submit" class="btn btn-danger">刪除</a>
        </form>
      </div>
    </div>
  </div>
</div>