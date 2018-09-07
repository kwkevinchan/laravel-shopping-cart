@if (session('status'))
  <div class="alert alert-{{ session('status') }}" style="margin-top:15px;" id="sessionAlert">
    {!! session('message') !!}
  </div>
  <script>
    setTimeout('document.getElementById("sessionAlert").style.display="none"',5000);
  </script>
@endif
