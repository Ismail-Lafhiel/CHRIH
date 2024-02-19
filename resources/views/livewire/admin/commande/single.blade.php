<tr x-data="{ modalIsOpen : false }">
    <td class="">{{ $commande->user_id }}</td>
    
    @if(getCrudConfig('Commande')->delete or getCrudConfig('Commande')->update)
        <td>

            @if(getCrudConfig('Commande')->update && hasPermission(getRouteName().'.commande.update', 0, 0, $commande))
                <a href="@route(getRouteName().'.commande.update', $commande->id)" class="btn text-primary mt-1">
                    <i class="icon-pencil"></i>
                </a>
            @endif

            @if(getCrudConfig('Commande')->delete && hasPermission(getRouteName().'.commande.delete', 0, 0, $commande))
                <button @click.prevent="modalIsOpen = true" class="btn text-danger mt-1">
                    <i class="icon-trash"></i>
                </button>
                <div x-show="modalIsOpen" class="cs-modal animate__animated animate__fadeIn">
                    <div class="bg-white shadow rounded p-5" @click.away="modalIsOpen = false" >
                        <h5 class="pb-2 border-bottom">{{ __('DeleteTitle', ['name' => __('Commande') ]) }}</h5>
                        <p>{{ __('DeleteMessage', ['name' => __('Commande') ]) }}</p>
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
