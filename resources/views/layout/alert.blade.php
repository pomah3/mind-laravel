{{-- $type: success|warning|danger --}}
<div class="alert alert-{{ $type }}">
    {{ $slot }}
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
</div>
