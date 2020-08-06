@extends('layouts.admin')

@section('content')
    <div class="lcPageHelpTop lcPageHelpTop-sm">
        <span class="lcPageHelpTop__text">
            Помощь
        </span>
        <a href="#chat" class="btn lcPageHelpTop__btn">
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

                <h4 class="card-title">Новое обращение</h4>
                {{ Form::open(['route' =>  'tasks.store', 'files' =>	true, 'method' => 'post', 'class' => 'forms-sample']) }}

                    {{ Form::text('title', '', ['placeholder' => 'Заголовок обращения', 'class' => 'form-control', 'required' => 'required']) }}

                    {{ Form::textarea('content', '', ['placeholder' => 'Текст обращения', 'class' => 'form-control', 'required' => 'required']) }}

                    <button type="submit" class="btn lcPageHelpTop__btn">Отправить</button>

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
