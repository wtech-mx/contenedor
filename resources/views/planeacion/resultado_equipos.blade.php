
    <div class="col-12 form-group">
        <label for="name">Chasis</label>
        <select class="form-select d-inline-block" id="chasis" name="chasis" value="{{ old('chasis') }}" >
            <option value="">Seleccionar Chasis</option>
            @foreach ($chasisNoAsignados as $item)
                <option value="{{$item->id}}">{{$item->marca}} / {{$item->modelo}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 form-group">
        <label for="name">Camion</label>
        <select class="form-select d-inline-block" id="camion" name="camion" value="{{ old('camion') }}" >
            <option value="">Seleccionar Camion</option>
            @foreach ($camionesNoAsignados as $item)
                <option value="{{$item->id}}">{{$item->marca}} / {{$item->modelo}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 form-group">
        <label for="name">Operador</label>
        <select class="form-select d-inline-block" id="operador" name="operador" value="{{ old('operador') }}" >
            <option value="">Seleccionar Operador</option>
            @foreach ($operadorNoAsignados as $item)
                <option value="{{$item->id}}">{{$item->nombre}} / {{$item->telefono}}</option>
            @endforeach
        </select>
    </div>
