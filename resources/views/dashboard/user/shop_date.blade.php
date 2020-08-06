<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Даные продавца</h4>
            <br>
            @switch($user->property->type_shop)
                @case(\App\Models\User::TYPE1)
                @include('dashboard.admin.block.seller_type1')
                @break
                @case(\App\Models\User::TYPE2)
                @include('dashboard.admin.block.seller_type2')
                @break
                @case(\App\Models\User::TYPE3)
                @include('dashboard.admin.block.seller_type3')
                @break
            @endswitch
        </div>
    </div>
</div>
