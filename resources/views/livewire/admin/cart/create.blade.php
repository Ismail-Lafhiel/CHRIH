<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Cart') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.cart.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Cart')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
                        <!-- Product_id Input -->
            <div class='form-group'>
                <label for='input-product_id' class='col-sm-2 control-label '> {{ __('Product_id') }}</label>
                <input type='number' id='input-product_id' wire:model.lazy='product_id' class="form-control  @error('product_id') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('product_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.cart.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
