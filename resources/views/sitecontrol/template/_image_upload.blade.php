@php
$hidden_input_value = $hidden_input_value;
$is_image_exists = ($hidden_input_value == "");
$cancel_button_hide = "";
@endphp
<div class="image-input image-input-outline" data-kt-image-input="true"
    style="background-image: url({{ asset('assets/media/avatars/blank.png') }})">
    <div class="image-input-wrapper w-125px h-125px"
        style="background-image: url({{ asset( ( $is_image_exists ? 'assets/media/avatars/blank.png' : $hidden_input_value ) ) }})">
    </div>

    <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change {{ $image_title }} ">
        <i class="bi bi-pencil-fill fs-7"></i>

        {!! Form::file($file_input_name, ["class" => "", "data-hidden-input" => $hidden_input_name, "id" => $file_input_name ]) !!}
        <!-- <input type="file" name="avatar" accept=".png, .jpg, .jpeg" /> -->
        <input type="hidden" value="" name="avatar_remove" />
        <input type="hidden" class="" value="{!! $hidden_input_value !!}" name="{{ $hidden_input_name }}" data-is-image="true" />
        

    </label>

    

    <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel {{ $image_title }}">
        <i class="bi bi-x fs-2"></i>
    </span>

    @if ($is_image_exists)
    
        @php
            $cancel_button_hide = "display:none;"
        @endphp
    
    @endif

    <span style="{{ $cancel_button_hide }} ;" class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow"
        data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove {{ $image_title }}">
        <i class="bi bi-x fs-2"></i>
    </span>

</div>
{!! GeneralHelper::form_error(false, $hidden_input_name, true) !!}
<div class="form-text">Allowed file types: {!! $image_types !!}.</div>

