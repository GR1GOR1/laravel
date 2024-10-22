<x-layout.main title="{{ $r_contract['ufCrm4Service']['title'] }} : {{ $r_contract['ufCrm4Service']['value'] }}" h1="{{ $r_contract['ufCrm4Service']['value'] }}">
    <div style="display: flex;">
        <div class="cont-info" style="display: none;width: 50%;">
            <table>
                @foreach($r_contract as $con)
                <tr>
                    <td>{{ $con["title"] }}</td>
                    <td>{{ $con["value"] }}</td>
                </tr>
            @endforeach
            </table>
        </div>
        <style>
            .task-cont {
                margin-bottom: 50px;
                border: 1px solid gray;
                border-radius: 10px;
                display: flex; 
                padding: 10px;
                background: #eef2f4; 
            }
            .task-cont >  div {
                padding: 3px;
            }
            .task-left {
                width: 70%;
            }
            .task-right {
                width: 30%;
                display: flex;
                justify-content: start;
                align-items: center;
                flex-direction: column;
            }
            .task-right > div {
                width: 90%;
                margin-bottom: 10px;
                border-left: 3px solid #3bc8f5;
                padding-left: 15px;  
            }
            .task-description {
                background: white;
                border: 1px solid white;
                border-radius: 10px;
                padding: 10px;
            }
            .task-result {
                background: #f8fbeb;
                padding: 10px;
                border: 1px solid #f8fbeb;
                border-radius: 10px;
                margin-top: 30px;
            }
            .task-cheklist {
                background: #f8fbeb;
                padding: 10px;
                border: 1px solid #f8fbeb;
                border-radius: 10px;
            }
            .task-result-top {
                color: rgba(82,92,105,1);
                font-size: 16px;
            }
            .task-status {
                /* padding: 3px;
                border: 1px solid white;
                border-radius: 10px; */
            }
        </style>
        <div class="task-info">
            @foreach($r_task as $task)
            <div class="task-cont" style="">
                <div class="task-left">
                    <div class="task-top" style="display: flex;">
                        <div>{{ $task['title']["value"] }}</div>
                    </div>
                    <hr>
                    <div class="task-description">{!! $task['description']["value"] !!}</div>
                    @isset ($task['resanswer'])
                    <div class="task-result">
                        <div class="task-result-top">Результат</div><hr>
                        {!! $task['resanswer'] !!}
                    </div>
                    @endisset
                </div>
                <div class="task-right">
                    <div class="task-status">{{ $task['status']["title"] }}: <b><i>{{ $task['status']["value"] }}</i></b></div>
                    <div>
                        <table>
                            <tr><td><b>Дата создания: </b></td><td> {{ $task['createdDate']["value"] }}</td></tr>
                            @isset($task['deadline'])<tr><td><b>Крайний срок: </b></td><td>{{ $task['deadline']["value"] }}</td></tr>@endisset
                            @isset($task['closedDate'])<tr><td><b>Дата закрытия: </b></td><td>{{ $task['closedDate']["value"] }}</td></tr>@endisset
                        </table>
                    </div>
                    @isset ($task["cheklist"])
                        <div class="task-check">
                            @foreach($task["cheklist"] as $title => $lists)
                                <div class="task-cheklist">
                                    <div class="task-cheklist-title">{{ $title }}</div>
                                    <hr>
                                    <div class="task-cheklist-values">
                                        <table>
                                            @foreach($lists as $k => $value)
                                                <tr><td>{{$k}}.</td><td>@php echo ($value["IS_COMPLETE"] == "N" ? "🔘" : "✅") @endphp</td><td>{{ $value["TITLE"] }}</td></tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endisset
                </div>
            </div>
        @endforeach
        </div>
    </div>
</x-layout.main>