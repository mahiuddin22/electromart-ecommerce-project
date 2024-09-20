@if(Session::has('message'))
<div id="removeDiv" class="alert alert-primary bg-primary-50 text-primary-600 border-primary-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 align-items-center justify-content-between">
    {{ Session::get('message') }}
    <button class="remove-button text-primary-600 text-xxl line-height-1 float-right" style="float: right;" onclick="button()"> <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon></button>
</div>
<script>
    function button() {
        document.getElementById("removeDiv").style.display = "none";
    }
</script>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif