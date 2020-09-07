<div class="lcPageContentProductsTop">
    <div class="lcPageContentProductsTop__add">
        <a href="{{ route('products.create') }}" style=" width: 150px" class="lcPageContentSort__btn btn">Добавить</a>
    </div>
    <div class="lcPageContentProductsTop__search">
        <input type="text" placeholder="Поиск">
        <svg
                xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink"
                width="20px" height="20px">
            <path fill-rule="evenodd" fill="rgb(153, 153, 153)"
                  d="M19.993,18.636 L14.879,13.639 C16.038,12.217 16.739,10.161 16.739,8.187 C16.739,3.621 12.954,0.009 8.369,0.009 C3.784,0.009 -0.000,3.621 -0.000,8.187 C-0.000,12.753 3.784,16.365 8.369,16.365 C10.319,16.365 12.067,15.668 13.484,14.548 L18.599,19.999 L19.993,18.636 ZM8.369,14.548 C4.809,14.548 1.860,11.732 1.860,8.187 C1.860,4.641 4.809,1.826 8.369,1.826 C11.930,1.826 14.879,4.641 14.879,8.187 C14.879,11.732 11.930,14.548 8.369,14.548 Z"/>
        </svg>
    </div>
    <div class="lcPageContentProductsTop__actions">
            <span>
                Выберите действие:
            </span>
        <button id="js_product_activate"
                class="lcPageContentProductsTop__action tooltip"
                title="Включить отмеченные"
                data-route="{{ route('products.change-status', 'activate') }}"
        >
            <svg width="26px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
                <g>
                    <path d="M257,0C116.39,0,0,114.39,0,255s116.39,257,257,257s255-116.39,255-257S397.61,0,257,0z M392,285H287v107    c0,16.54-13.47,30-30,30c-16.54,0-30-13.46-30-30V285H120c-16.54,0-30-13.46-30-30c0-16.54,13.46-30,30-30h107V120    c0-16.54,13.46-30,30-30c16.53,0,30,13.46,30,30v105h105c16.53,0,30,13.46,30,30S408.53,285,392,285z"/>
                </g>
            </g>

            </svg>
        </button>

        <button id="js_product_disable"
                class="lcPageContentProductsTop__action tooltip"
                title="Отключить отмеченные"
                data-route="{{ route('products.change-status', 'disable') }}"
        >
            <svg width="26px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M257,0C116.39,0,0,114.39,0,255s116.39,257,257,257s255-116.39,255-257S397.61,0,257,0z M392,285H120    c-16.54,0-30-13.46-30-30c0-16.54,13.46-30,30-30h272c16.53,0,30,13.46,30,30S408.53,285,392,285z"/>
                    </g>
                </g>

            </svg>
        </button>

        <a href="{{ route('products.change-status-all', 'activate') }}"
           class="lcPageContentProductsTop__action tooltip"
           title="Включить все"
        >
            <svg width="26px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
            <g>
                <g>
                    <path d="M257,0C116.39,0,0,114.39,0,255s116.39,257,257,257s255-116.39,255-257S397.61,0,257,0z M413.21,180L246.39,347.89    c-11.75,11.75-32.73,11.7-44.44,0l-95.45-95.47c-11.73-11.73-11.73-30.69,0-42.42c11.12-11.11,31.33-11.11,42.44,0l76.24,74.24    l145.61-146.66c11.1-11.14,31.26-11.17,42.43,0C424.73,149.09,425.11,168.1,413.21,180z"/>
                </g>
            </g>

            </svg>
        </a>

        <button id="js_product_disableAll"
                class="lcPageContentProductsTop__action tooltip"
                title="Отключить все"
                data-route="{{ route('products.change-status', 'disable') }}"
        >
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="26" height="26" viewBox="0 0 26 26">
                <g>
                    <g>
                        <image width="26" height="26"
                               xlink:href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABoAAAAaCAYAAACpSkzOAAADa0lEQVRIS62WX2gcVRTGv3NnNomJbVWU5EH6IPogBcViIYXQCiFGN7Mme4cuPkhBI/Stmka0hVArUcxDKuZF0FaK7YsE52zWmU2FVkKrUGkeFASh0EILWkpTzR8N3SU7c2Q2f4jJzGxac59253zn+82dO+ecIWxgMX/bBhhtgDwHyHYRIiLcBPALoH6sVP65kMvl/CQriguOj4/Xl8v+WyL0JoCnatzP70Q4VV+vhtPp9FyUNhI0NuZmgoA+A/D4Bja8WnIHkH6tM6fX5q0DMbuHADp+j4A1chnSOnNk9cX/gJiLfYB88v8gK9kfaW0NLP9bAeXzbrsInd8kSNVGhPbbdteZ8HcVNDo6aphm4zSALbVAIvIhQDNEGK6lDeOVSv1DuVzHbBXkOF7/RhObmlIPdnZ2zjN7shEQQCNad71dBTF7twE8lpB4EZA6gFqVomfq6uhGqRTMAnIFULcA2ZuQW0mlZBs5zngrUXApXig/aZ3ZzVzsBmQsCPxng6DxhmmWZ0Rw1LatQWaPAWTjPERkH+XzxQERGYwTGYa/tVwui2k2XgXQ3NCgtoVFufTo5gzDf7q7u/sms3cXQEOMz+fE7BUAvBItkLNaZ9KrNSLoUwp3RLD4NpH8nM1mdjK7J4BqF4la54i5eBmQXVFREbxj29ZxZm8BgBm3a62t0McCxI3RXKZ83psUwfMxoD7btj5l9ioAjBqglwA5G62hyRBUFEE6xoS1tmxmbwLACzGaa1pbTzK7IwAdjNF8H57RBwCOxgj8qamWB1pa/njE941bURql1I6envRvzF7YtSMLXgRfkuMU9xDJhYQ6OKe19WKhUGj2fWMUwJ5FLU0qhd6enq5fmYtfAbI/oUReo4mJCXN6ev5PAFsTYN9obe2LijuOd5IIvUldImxDSy3IPUZE7yeJAZRE8DUg3ymlKkEg7UR4FcDDyXl0SuuuN6qgcJqWSsHfAFI1YPcRTjVr3Xl7ZUwwe+GjCc9g01ZY3GF5VE90tSuz+zFAhzeDJIIvbNs6sOy1bpQ7jjtIRCuT8X6gayHrdrRsms97vUGAESI03SMoAPCe1ta6oRj7ubVYN+a7gLxe+81C2LlPExlD2ezL16NuLha0LC4UClt83+hYGm5PAHh08QNS/hKh60rRDwsLdD6XS08l7f5f9NBf0s8FaBwAAAAASUVORK5CYII="/>
                    </g>
                </g>
            </svg>
        </button>

    <!--a href="{{ route('products.create') }}"
           class="lcPageContentProductsTop__action tooltip" title="Добавить">
            <svg width="26px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <g>
                            <path d="M304.909,390.25l-27.584,27.584V298.666c0-11.776-9.536-21.333-21.333-21.333c-11.797,0-21.333,9.557-21.333,21.333     v119.168l-27.584-27.584c-8.341-8.341-21.824-8.341-30.165,0c-8.341,8.341-8.341,21.824,0,30.165l63.979,63.979     c1.963,1.984,4.331,3.541,6.955,4.629c2.603,1.067,5.376,1.643,8.149,1.643c2.773,0,5.547-0.576,8.149-1.643     c2.624-1.088,4.992-2.645,6.955-4.629l63.979-63.979c8.341-8.341,8.341-21.824,0-30.165     C326.733,381.908,313.25,381.908,304.909,390.25z"/>
                            <path d="M446.784,175.446c-9.749-73.387-76.949-154.112-157.76-154.112c-43.328,0-87.381,21.291-116.8,55.445     c-9.408-3.435-19.371-5.205-29.525-5.205c-45.973,0-83.648,36.224-85.952,81.643C22.784,175.105,0,215.532,0,256.001     c0,25.344,8.405,53.461,23.061,77.12c19.413,31.381,55.019,50.88,92.907,50.88h15.915c3.136-8.875,8.021-17.067,14.869-23.915     c12.075-12.096,28.16-18.752,45.248-18.752v-42.667c0-35.285,28.693-64,64-64c35.285,0,64,28.715,64,64v42.667     c17.067,0,33.152,6.656,45.248,18.752c6.848,6.848,11.712,15.04,14.869,23.915h22.336c55.36,0,103.168-41.216,108.843-93.845     c0.469-4.203,0.704-8.491,0.704-12.821C512,228.353,486.912,190.017,446.784,175.446z"/>
                        </g>
                    </g>
                </g>

            </svg>
        </a>
        <button class="lcPageContentProductsTop__action tooltip" title="Скопировать">
            <svg width="21px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path d="M376.098,0h-300c-24.814,0-45,20.186-45,45v362.001c0,19.53,12.578,36.024,30,42.237V147.422    c0-20.024,7.808-38.862,21.973-53.027l42.422-42.422C139.658,37.808,158.496,30,178.52,30h239.815    C412.122,12.578,395.628,0,376.098,0z"/>
                                            </g>
                                        </g>
                <g>
                    <g>
                        <path d="M436.102,60.199c-132.53,0-93.96,0-225,0v104.8c0,8.29-6.71,15.2-15,15.2h-105V467c0,24.82,20.18,45,45,45h300    c24.81,0,44.8-20.18,44.8-45V104.999C480.902,80.189,460.912,60.199,436.102,60.199z M406.102,422h-240c-8.29,0-15-6.71-15-15    c0-8.29,6.71-15,15-15h240c8.29,0,15,6.71,15,15C421.102,415.29,414.392,422,406.102,422z M406.102,362h-240    c-8.29,0-15-6.71-15-15c0-8.29,6.71-15,15-15h240c8.29,0,15,6.71,15,15C421.102,355.29,414.392,362,406.102,362z M406.102,302    h-240c-8.29,0-15-6.71-15-15c0-8.29,6.71-15,15-15h240c8.29,0,15,6.71,15,15C421.102,295.29,414.392,302,406.102,302z     M406.102,242h-240c-8.29,0-15-6.71-15-15s6.71-15,15-15h240c8.29,0,15,6.71,15,15S414.392,242,406.102,242z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M178.52,60c-12.012,0-23.32,4.688-31.816,13.184l-42.422,42.422c-10.001,10-13.184,21.182-13.184,34.394h90V60H178.52z"/>
                    </g>
                </g>

                                        </svg>
        </button-->
        <button
                id="js_product_delete"
                data-route="{{ route('products.change-delete') }}"
                class="lcPageContentProductsTop__action tooltip" title="Удалить">
            <svg width="22px" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512 512"
                 style="enable-background:new 0 0 512 512;" xml:space="preserve">
                <g>
                    <g>
                        <path d="M62.29,180l26.27,291.07C90.7,494.41,109.95,512,133.39,512H378.6c23.44,0,42.69-17.59,44.83-40.93L449.7,180H62.29z     M178.95,451.99c-0.24,0.01-0.47,0.01-0.68,0.01c-7.97,0-14.62-6.27-14.97-14.31l-9.55-212c-0.38-8.28,6.01-15.29,14.3-15.67    c9.37-0.27,15.29,6.05,15.64,14.29l9.55,212C193.62,444.59,187.24,451.61,178.95,451.99z M271,437c0,8.29-6.71,15-15,15    c-8.29,0-15-6.71-15-15V225c0-8.29,6.71-15,15-15c8.29,0,15,6.71,15,15V437z M348.69,437.69c-0.35,8.04-7,14.31-14.97,14.31    c-0.2,0-0.44,0-0.67-0.01c-8.29-0.38-14.68-7.4-14.3-15.68l9.55-212c0.38-8.24,6.33-14.44,15.65-14.29    c8.29,0.38,14.67,7.39,14.29,15.67L348.69,437.69z"/>
                    </g>
                </g>
                <g>
                    <g>
                        <path d="M406,60h-45V45c0-24.81-20.19-45-45-45H196c-24.82,0-45,20.19-45,45v15h-45c-41.37,0-75,33.65-75,75v15h450v-15    C481,93.65,447.36,60,406,60z M331,60H181V45c0-8.28,6.73-15,15-15h120c8.26,0,15,6.72,15,15V60z"/>
                    </g>
                </g>

            </svg>
        </button>
    </div>
</div>