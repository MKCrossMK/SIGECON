{{-- Items Police --}}

<div class="div_article mb-2 ">
    <div class="row align-items-center">
        <div class="col-1">
            <button type="button" class="btn btn_delete rounded-circle delete"><i class="fa-solid fa-trash-can"></i></button>
        </div>
        <div class="col-3">
            <img class="img-fluid img_article" src="{{ asset('img/mp.png') }}" alt="Imagen Articulo">
            <input type="file" name="image[]" id=image[]" hidden>
        </div>
        <div class="col">
            <textarea name="description[]" id="description" class="form-control w-100 mb-2" rows="1">'+ description + '</textarea>

            <div class="row mb-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Quilate (K)</span>
                        <input type="text" id="carat[]" name="carat[]" class="form-control"
                        value="" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">T. Piedra</span>
                        <input type="text" id="stone_type[]" name="stone_type[]" class="form-control"
                        value="" disabled>
                    </div>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">Peso (grs)</span>
                        <input type="text" id="weight[]" name="weight[]" class="form-control"
                        value="" disabled>
                    </div>
                </div>
                <div class="col">
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon1">P. Valorado</span>
                        <input type="text" id="valued_price[]" name="valued_price[]" class="form-control"
                        value="" disabled>
                    </div>
                </div>
            </div>

            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">P. Préstamo</span>
                <input type="text" id="stone_type[]" name="loan_price[]" class="form-control loan_price"
                value="" >
            </div>
        </div>
    </div>
</div>

{{-- Items Police End --}}


{{-- Table items Rows --}}
<tr class="item-row"><td><button type="button" class="btn btn_delete rounded-circle delete"><i class="fa-solid fa-trash-can"></i></button></td>'
    + '<td style="width: 500px !important; max-width: 500px;"><textarea name="description[]" id="description[]" class="form-control w-100">'+ description + '</textarea></td>' 
    + '<td style="width: 200px"><input type="file" class="form-control w-100" name="imagen[]" id="imagen[]" value="'+ imagen +'" readonly></td>'
    + '<td style="width: 200px"><input type="text" class="form-control w-100" name="carat[]" id="carat[]" value="'+ carat +'" readonly></td>'
    + '<td style="width: 200px"><input type="text" class="form-control w-100" name="stone_type[]" id="stone_type[]" value="'+ stone_type +'" readonly></td>'
    + '<td style="width: 200px"><input type="text" class="form-control w-100" name="weight[]" value="'+ weight +'" readonly></td>'
    + '<td style="width: 200px"><input type="text" class="form-control w-100" name="valued_price[]" id="valued_price[]" value="'+ valued_price +'" readonly></td>'
    + '<td style="width: 200px"><input type="text" class="form-control w-100 loan_price" name="loan_price[]" id="loan_price" value="'+ loan_price +'"></td></tr>
{{-- Table items Rows End --}}