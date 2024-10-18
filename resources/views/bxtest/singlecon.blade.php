<x-layout.main title="{{ $r_contract['ufCrm4Service']['title'] }} : {{ $r_contract['ufCrm4Service']['value'] }}" h1="{{ $r_contract['ufCrm4Service']['value'] }}">
    <div style="display: flex;">
        <div class="cont-info" style="display: none;">
            <table>
                @foreach($r_contract as $con)
                <tr>
                    <td>{{ $con["title"] }}</td>
                    <td>{{ $con["value"] }}</td>
                </tr>
            @endforeach
            </table>
        </div>
        <div class="task-info">
            @php
                echo "<pre>";    
                print_r($tasks);
                echo "<pre>";    
            @endphp
        </div>
    </div>
</x-layout.main>