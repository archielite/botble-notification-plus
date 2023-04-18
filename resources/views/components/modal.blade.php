@props([
    'id',
    'title',
    'size' => null,
    'type' => 'info',
    'buttonLabel',
])

<div id="{{ $id }}" class="modal fade" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog {{ $size }} @if (! $size) @if (strlen($slot) < 120) modal-xs @elseif (strlen($slot) > 1000) modal-lg @endif @endif">
        <div class="modal-content">
            <div class="modal-header bg-{{ $type }}">
                <h4 class="modal-title"><i class="til_img"></i><strong>{!! $title !!}</strong></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true">

                </button>
            </div>

            <div class="modal-body with-padding">
                {{ $slot }}
            </div>

            <div class="modal-footer">
                <button type="button" class="float-start btn btn-{{ $type }}" data-bs-dismiss="modal">{{ trans('core/base::tables.cancel') }}</button>
                <button type="submit" class="float-end btn btn-{{ $type }}">{!! $buttonLabel !!}</button>
            </div>
        </div>
    </div>
</div>
