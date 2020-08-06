<h4>Физическое лицо</h4>
<p><b>ФИО</b> {{ $user->name }}</p>
<p><b>Гражданство</b> {{ $user->property->citizenship }}</p>
<p><b>Телефон</b> {{ $user->property->phone }}</p>
<p><b>Серия и номер паспорта</b> {{ $user->property->passport_number }}</p>
<p><b>кем выдан паспорт</b> {{ $user->property->passport_issued }}</p>
<p><b>Адрес прописки</b> {{ $user->property->address }}</p>

