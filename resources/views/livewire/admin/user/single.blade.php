<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $user->name }}</td>
    <td class="">{{ $user->email }}</td>
    <td class="">{{ $user->password }}</td>
    
    @if(getCrudConfig('User')->delete or getCrudConfig('User')->update)
        <td>

            @if(getCrudConfig('User')->update && hasPermission(getRouteName().'.users.update', 1, 0, $user))
                <a href="@route(getRouteName().'.users.update', $user->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('User')->delete && hasPermission(getRouteName().'.users.delete', 1, 0, $user))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('User') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('User') ]) }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a wire:click.prevent="delete" class="text-white btn btn-success shadow">{{ __('Yes, Delete it.') }}</a>
                            <a @click.prevent="modalIsOpen = false" class="text-white btn btn-danger shadow">{{ __('No, Cancel it.') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </td>
    @endif
</tr>
