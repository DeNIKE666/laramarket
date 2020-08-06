@extends('layouts.admin')

@section('content')
    <div class="lcPageHelpTop lcPageHelpTop-sm">
        <span class="lcPageHelpTop__text">
            Помощь
        </span>
        <a href="{{ route('tasks.index') }}#chat" class="btn lcPageHelpTop__btn">
            Задать вопрос
        </a>
    </div>
    @include("dashboard.task.block.frequent_question")

    <div id="chat" class="lcPageHelpArch">
        <div class="lcPageHelpArchTop">
            <span class="lcPageHelpArchTop__title">
                Обращения:
            </span>
            <!--div class="lcPageHelpArchTop__search">
                <input type="text" placeholder="Поиск">
                <svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="20px" height="20px">
                    <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                          d="M19.993,18.636 L14.879,13.639 C16.038,12.217 16.739,10.161 16.739,8.187 C16.739,3.621 12.954,0.009 8.369,0.009 C3.784,0.009 -0.000,3.621 -0.000,8.187 C-0.000,12.753 3.784,16.365 8.369,16.365 C10.319,16.365 12.067,15.668 13.484,14.548 L18.599,19.999 L19.993,18.636 ZM8.369,14.548 C4.809,14.548 1.860,11.732 1.860,8.187 C1.860,4.641 4.809,1.826 8.369,1.826 C11.930,1.826 14.879,4.641 14.879,8.187 C14.879,11.732 11.930,14.548 8.369,14.548 Z"/>
                </svg>
            </div>
            <a href="#arch" class="lcPageHelpArchTop__btn btn">
                Архив
            </a-->
        </div>
        <div class="lcPageHelpArchContent">
            <div class="lcPageHelpArchLeft">
                <div class="lcPageHelpArchLeft__title">
                    Архив
                </div>
                @include("dashboard.task.block.list_message")

            </div>
            <div class="lcPageHelpArchRight">

                <div class="lcPageHelpArchChat">
                    <h4>{{ $task->title }}</h4>
                    <hr>
                    @if (count($task->messages))
                        @foreach ($task->messages as $message)
                            <div class="lcPageHelpArchChatMsg">
                                <div class="lcPageHelpArchChatMsg__name {{ $message->getTypeMessage() }}">
                                    {{ $message->user->getName() }}
                                </div>
                                <div class="lcPageHelpArchChatMsg__text">
                                    {{ $message->content }}
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>

                {{ Form::open(['route' =>  ['tasks.update', $task->id], 'method' => 'put', 'class' => 'lcPageHelpArchSend']) }}

                    {{ Form::text('content', '', ['placeholder' => 'Введите текст сообщения', 'required' => 'required']) }}
                    <button class="btn">
                        <svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="14px" height="12px">
                            <path fill-rule="evenodd"  fill="rgb(0, 0, 0)"
                                  d="M13.710,5.580 L0.711,0.042 C0.504,-0.045 0.257,0.007 0.113,0.171 C-0.032,0.335 -0.037,0.569 0.101,0.738 L2.820,5.999 L0.101,11.261 C-0.037,11.430 -0.032,11.665 0.112,11.828 C0.209,11.940 0.354,12.000 0.501,12.000 C0.572,12.000 0.643,11.986 0.710,11.957 L13.709,6.419 C13.887,6.343 14.000,6.180 14.000,5.999 C14.000,5.820 13.887,5.656 13.710,5.580 Z"/>
                        </svg>
                    </button>
                {{ Form::close() }}

            </div>
        </div>
    </div>
    <div id="arch" class="lcPageHelpArch lcPageHelpArch-sm">
        <div class="lcPageHelpArchTop">
            <span class="lcPageHelpArchTop__title">
                Архив Обращений:
            </span>
            <!--svg class="lcPageHelpArchTop__icon"
                 xmlns="http://www.w3.org/2000/svg"
                 xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="20px" height="20px">
                <path fill-rule="evenodd"  fill="rgb(153, 153, 153)"
                      d="M19.993,18.636 L14.879,13.639 C16.038,12.217 16.739,10.161 16.739,8.187 C16.739,3.621 12.954,0.009 8.369,0.009 C3.784,0.009 -0.000,3.621 -0.000,8.187 C-0.000,12.753 3.784,16.365 8.369,16.365 C10.319,16.365 12.067,15.668 13.484,14.548 L18.599,19.999 L19.993,18.636 ZM8.369,14.548 C4.809,14.548 1.860,11.732 1.860,8.187 C1.860,4.641 4.809,1.826 8.369,1.826 C11.930,1.826 14.879,4.641 14.879,8.187 C14.879,11.732 11.930,14.548 8.369,14.548 Z"/>
            </svg>
            <div class="lcPageHelpArchTop__search">
                <input type="text" placeholder="Поиск">
            </div-->
        </div>
        <div class="lcPageHelpArchContent">
            <div class="lcPageHelpArchLeft">
                @include("dashboard.task.block.list_message")
            </div>
        </div>
    </div>

@endsection


