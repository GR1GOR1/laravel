<div class="mb-3">
    <x-form-input name="brand" label="Марка авто"/>
</div>
<div class="mb-3">
    <x-form-input name="model" label="Модель авто"/>
</div>
<div class="mb-3">
    <x-form-input name="vin" label="VIN"/>
</div>
<div class="mb-3">
    <x-form-select name="transmission" label="Коробка передач" placeholder="Не выбрано" :options="$transmissions"/>
</div>