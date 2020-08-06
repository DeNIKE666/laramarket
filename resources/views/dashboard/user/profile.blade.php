<div class="lcPageContentDataChange">
    <div class="lcPageContentDataChange__col">
        <div class="lcPageContentDataChange__item">
            <div class="lcPageContentDataChange__inf">
                <span>
                    Имя:
                </span>
                {{ $user->getName() }}
            </div>
            <svg class="lcPageContentDataChange__img"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="18px" height="18px">
                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                      d="M17.730,4.050 L16.920,4.860 L13.140,1.080 L13.950,0.270 C14.310,-0.090 14.850,-0.090 15.210,0.270 L17.730,2.790 C18.090,3.150 18.090,3.690 17.730,4.050 ZM6.882,14.945 L3.064,11.127 L11.846,2.345 L15.665,6.163 L6.882,14.945 ZM-0.000,18.000 L1.800,12.420 L5.580,16.200 L-0.000,18.000 Z"/>
            </svg>
        </div>
        <div class="lcPageContentDataChange__inpWrap">
            <div class="lcPageContentDataChange__inp">
                {{ Form::open(['route' => [ 'edit_profile_data'], 'method' => 'put']) }}
                    {{ Form::text('name', '', ['placeholder' => 'Новое имя', 'required' => 'required']) }}
                    <button type="submit" class="btn-svg">
                        <svg class="lcPageContentDataChange__icon"
                             xmlns="http://www.w3.org/2000/svg"
                             xmlns:xlink="http://www.w3.org/1999/xlink"
                             width="18px" height="18px">
                            <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                                  d="M8.833,0.333 C3.963,0.333 -0.000,4.296 -0.000,9.167 C-0.000,14.038 3.963,18.000 8.833,18.000 C13.704,18.000 17.667,14.038 17.667,9.167 C17.667,4.296 13.704,0.333 8.833,0.333 ZM13.758,6.221 L8.322,12.336 C8.188,12.487 8.002,12.564 7.814,12.564 C7.665,12.564 7.515,12.515 7.389,12.415 L3.992,9.697 C3.699,9.463 3.652,9.035 3.886,8.742 C4.120,8.449 4.548,8.402 4.841,8.636 L7.735,10.951 L12.742,5.317 C12.991,5.037 13.421,5.012 13.701,5.261 C13.982,5.511 14.007,5.940 13.758,6.221 Z"/>
                        </svg>
                    </button>
                {{ Form::close() }}
            </div>
        </div>
    </div>
    <div class="lcPageContentDataChange__col">
        <div class="lcPageContentDataChange__item">
            <div class="lcPageContentDataChange__inf">
                <span>
                    E-mail:
                </span>
                {{ $user->email }}
            </div>
            <svg class="lcPageContentDataChange__img"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="18px" height="18px">
                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                      d="M17.730,4.050 L16.920,4.860 L13.140,1.080 L13.950,0.270 C14.310,-0.090 14.850,-0.090 15.210,0.270 L17.730,2.790 C18.090,3.150 18.090,3.690 17.730,4.050 ZM6.882,14.945 L3.064,11.127 L11.846,2.345 L15.665,6.163 L6.882,14.945 ZM-0.000,18.000 L1.800,12.420 L5.580,16.200 L-0.000,18.000 Z"/>
            </svg>
        </div>
        <div class="lcPageContentDataChange__inpWrap">
            <div class="lcPageContentDataChange__inp">
                <input type="text" placeholder="Новый email">
                <svg class="lcPageContentDataChange__icon"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="18px" height="18px">
                    <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                          d="M8.833,0.333 C3.963,0.333 -0.000,4.296 -0.000,9.167 C-0.000,14.038 3.963,18.000 8.833,18.000 C13.704,18.000 17.667,14.038 17.667,9.167 C17.667,4.296 13.704,0.333 8.833,0.333 ZM13.758,6.221 L8.322,12.336 C8.188,12.487 8.002,12.564 7.814,12.564 C7.665,12.564 7.515,12.515 7.389,12.415 L3.992,9.697 C3.699,9.463 3.652,9.035 3.886,8.742 C4.120,8.449 4.548,8.402 4.841,8.636 L7.735,10.951 L12.742,5.317 C12.991,5.037 13.421,5.012 13.701,5.261 C13.982,5.511 14.007,5.940 13.758,6.221 Z"/>
                </svg>
            </div>
        </div>
    </div>
    <div class="lcPageContentDataChange__col">
        <div class="lcPageContentDataChange__item">
            <div class="lcPageContentDataChange__inf">
                <span>
                    Телефон:
                </span>
                {{ $user->phone }}
            </div>
            <svg class="lcPageContentDataChange__img"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="18px" height="18px">
                <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                      d="M17.730,4.050 L16.920,4.860 L13.140,1.080 L13.950,0.270 C14.310,-0.090 14.850,-0.090 15.210,0.270 L17.730,2.790 C18.090,3.150 18.090,3.690 17.730,4.050 ZM6.882,14.945 L3.064,11.127 L11.846,2.345 L15.665,6.163 L6.882,14.945 ZM-0.000,18.000 L1.800,12.420 L5.580,16.200 L-0.000,18.000 Z"/>
            </svg>
        </div>
        <div class="lcPageContentDataChange__inpWrap">
            <div class="lcPageContentDataChange__inp">
                <input type="text" placeholder="Новый телефон">
                <svg class="lcPageContentDataChange__icon"
                     xmlns="http://www.w3.org/2000/svg"
                     xmlns:xlink="http://www.w3.org/1999/xlink"
                     width="18px" height="18px">
                    <path fill-rule="evenodd" fill="rgb(90, 84, 255)"
                          d="M8.833,0.333 C3.963,0.333 -0.000,4.296 -0.000,9.167 C-0.000,14.038 3.963,18.000 8.833,18.000 C13.704,18.000 17.667,14.038 17.667,9.167 C17.667,4.296 13.704,0.333 8.833,0.333 ZM13.758,6.221 L8.322,12.336 C8.188,12.487 8.002,12.564 7.814,12.564 C7.665,12.564 7.515,12.515 7.389,12.415 L3.992,9.697 C3.699,9.463 3.652,9.035 3.886,8.742 C4.120,8.449 4.548,8.402 4.841,8.636 L7.735,10.951 L12.742,5.317 C12.991,5.037 13.421,5.012 13.701,5.261 C13.982,5.511 14.007,5.940 13.758,6.221 Z"/>
                </svg>
            </div>
        </div>
    </div>
</div>