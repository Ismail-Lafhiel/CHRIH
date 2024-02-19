<div class="card">
    <div class="card-header p-0">
        <h3 class="card-title">{{ __('CreateTitle', ['name' => __('Commande') ]) }}</h3>
        <div class="px-2 mt-4">
            <ul class="breadcrumb mt-3 py-3 px-4 rounded">
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.home')" class="text-decoration-none">{{ __('Dashboard') }}</a></li>
                <li class="breadcrumb-item"><a href="@route(getRouteName().'.commande.read')" class="text-decoration-none">{{ __(\Illuminate\Support\Str::plural('Commande')) }}</a></li>
                <li class="breadcrumb-item active">{{ __('Create') }}</li>
            </ul>
        </div>
    </div>

    <form class="form-horizontal" wire:submit.prevent="create" enctype="multipart/form-data">

        <div class="card-body">
                        <!-- User_id Input -->
            <div class='form-group'>
                <label for='input-user_id' class='col-sm-2 control-label '> {{ __('User_id') }}</label>
                <input type='number' id='input-user_id' wire:model.lazy='user_id' class="form-control  @error('user_id') is-invalid @enderror" placeholder='' autocomplete='on'>
                @error('user_id') <div class='invalid-feedback'>{{ $message }}</div> @enderror
            </div>

        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-info ml-4">{{ __('Create') }}</button>
            <a href="@route(getRouteName().'.commande.read')" class="btn btn-default float-left">{{ __('Cancel') }}</a>
        </div>
    </form>
</div>
