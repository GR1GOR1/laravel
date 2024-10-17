<div class="mb-3">
    <x-form-select name="brand_id" label="Марка авто" placeholder="Не выбрано" :options="$brands"/>
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
<div class="mb-3">
    <x-form-select name="tags[]" label="Теги" :options="$tags" multiple :size="$tags->count()" many-relation/>
</div>
@error('tags.*')
    <div class="alert alert-danger">{{ message }}</div>
@enderror