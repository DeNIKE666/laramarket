<h4>Физическое лицо</h4>
<p><b>ФИО</b> {{ $user->name }}</p>
<p><b>Гражданство</b> {{ $user->property->citizenship }}</p>
<p><b>Телефон</b> {{ $user->property->phone }}</p>
<p><b>Серия и номер паспорта</b> {{ $user->property->passport_number }}</p>
<p><b>кем выдан паспорт</b> {{ $user->property->passport_issued }}</p>
<p><b>ИНН</b> {{ $user->property->inn }}</p>
<p><b>ОГРНИП</b> {{ $user->property->ogrnip }}</p>
<p><b>Адрес прописки</b> {{ $user->property->address }}</p>
<p><b>Юридический адрес</b> {{ $user->ur_address }}</p>
<p><b>Форма налогообложения</b> {{ $user->property->form_of_taxation }}</p>
<p><b>Банк</b> {{ $user->property->bank }}</p>
<p><b>БИК</b> {{ $user->property->bik }}</p>
<p><b>р/с</b> {{ $user->property->rs }}</p>
<p><b>к/с</b> {{ $user->property->ks }}</p>
