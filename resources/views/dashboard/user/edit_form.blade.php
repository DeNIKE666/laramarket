<div class="col-lg-6 grid-margin stretch-card">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Кабинет покупателя</h4>
            <br>
            {{ Form::open(['route' => [ 'edit_profile_data'], 'method' => 'put', 'class' => 'forms-sample']) }}
            <div class="form-group">
                <label>ФИО</label>
                {{ Form::text('name', $user->name, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label>Телефон</label>
                {{ Form::text('phone', $user->phone, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label>Адрес</label>
                {{ Form::text('address', $user->address, ['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label>Индекс</label>
                {{ Form::text('postal_code', $user->postal_code, ['class' => 'form-control']) }}
            </div>
            <button type="submit" class="btn btn-primary">Сохранить</button>
            {{ Form::close() }}
        </div>
    </div>
</div>
