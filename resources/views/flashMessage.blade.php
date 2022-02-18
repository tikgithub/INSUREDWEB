@if ($message = Session::get('success'))
<div class="alert alert-success alert-block notosanLao">
      
    <strong>{{ $message }}</strong>
</div>
@endif
  
@if ($message = Session::get('error'))
<div class="alert alert-danger alert-block notosanLao">
      
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('warning'))
<div class="alert alert-warning alert-block notosanLao">
      
    <strong>{{ $message }}</strong>
</div>
@endif
   
@if ($message = Session::get('info'))
<div class="alert alert-info alert-block notosanLao">
      
    <strong>{{ $message }}</strong>
</div>
@endif
  
@if ($errors->any())
<div class="alert alert-danger notosanLao">
      
    !! ກາລຸນາກວດສອບຄືນ
</div>
@endif