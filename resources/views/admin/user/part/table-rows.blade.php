                @foreach ($users as $user)
                <tr class="table-row" id="row-{{ $user->id }}">
                    <td class="table-cell" data-field="name">{{ $user->name }}</td>
                    <td class="table-cell text-left text-sm" data-field="phone">{{ optional($user->profiles->first())->phone ?? '-' }}</td>
                    <td class="table-cell" data-field="email">{{ $user->email }}</td>
                    <td class="table-cell" style="white-space: nowrap;">{{ optional($user->profiles->first())->birthday ?? '-' }}</td>
                    <td class="table-cell" @if ($user->profiles->first()) data-field="image" @endif>
                        <div class="w-12 h-12 bg-gray-200 rounded overflow-hidden mx-auto">
                            <img style="max-width: 100px; max-height:100px;"
                                 src="{{ optional($user->profiles->first())->avatar ? asset('/storage/' . $user->profiles->first()->avatar) : '/images/avatar-thumb.png' }}" 
                                 alt="Фото пользователя" 
                                 class="w-full h-full object-cover object-top"/>
                        </div>
                    </td>
                    <td class="table-cell" style="white-space: nowrap;" data-field="amount">{{ $user->orders()->get()->sum('amount') }} ₽</td>
                    <td class="table-cell" style="white-space: nowrap;" data-field="discount_percent">{{ $user->discount_percent }} %</td>
                    <td class="table-cell"style="white-space: nowrap;" data-field="bonus_points">{{ $user->bonus_points }} ₽</td>
                    <td class="table-cell">
                        <button class="edit-button" onclick="toggleEditMode({{ $user->id }})">Редактировать</button>
                        <div class="edit-controls" style="display: none;">
                            <button class="save-button" onclick="saveChanges({{ $user->id }})">Сохранить</button>
                        </div>
                    </td>

                </tr>
                @endforeach