<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Product') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.products.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Product')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
                        <!-- Name Input -->
            <div class='form-group'>
                <label for='input-name' class='col-sm-2 control-label '> {{ __('Name') }}</label>
                <input type='text' id='input-name' wire:model.lazy='name' class="form-control  @error('name') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('name') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Description Input -->
            <div class='form-group'>
                <label for='input-description' class='col-sm-2 control-label '> {{ __('Description') }}</label>
                <textarea id="input-description" wire:model.lazy='description' class="form-control  @error('description') is-invalid @enderror" placeholder='' autocomplete='on'></textarea>
                @error('description') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>
            <!-- Price Input -->
            <div class='form-group'>
                <label for='input-price' class='col-sm-2 control-label '> {{ __('Price') }}</label>
                <input type='number' id='input-price' wire:model.lazy='price' class="form-control  @error('price') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('price') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.products.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
