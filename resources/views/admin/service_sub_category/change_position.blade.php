
@if ($model->position != 1)
    <a href="{{ route('admin.service-sub-category.up', $model->position) }}">
        <button type="button" class="btn btn-sm btn-outline-success">
            <i class="icon-circle-up2"></i> Up
        </button>
    </a>
@endif

@if ($model->position != $last)
    <a href="{{ route('admin.service-sub-category.down', $model->position) }}">
        <button type="button" class="btn btn-sm btn-outline-danger">
            <i class="icon-circle-down2"></i> Down
        </button>
    </a>
@endif