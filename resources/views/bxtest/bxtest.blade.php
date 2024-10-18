<x-layout.main title="Contracts" h1="Услуги">
    @foreach($r_contract as $con)
        <div class="contract">
            <div class="c-name">{{ $con["title"]["value"] }}</div>
            <div class="c-service">{{ $con["ufCrm4Service"]["title"] }} : {{ $con["ufCrm4Service"]["value"] }}</div>
            <div>
                <a href="{{ route('bx.show', [$con["id"]["value"]]) }}">Подробнее</a>
            </div>
        </div>
        <hr>
    @endforeach
</x-layout.main>