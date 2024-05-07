    <div class="col-12 form-group" id="camionGroup">
        <div class="form-group">
            <label for="name">Camion</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('img/icon/camion.png') }}" alt="" width="35px">
                </span>
                <select class="form-select d-inline-block" id="camion" name="camion" value="{{ old('camion') }}">
                    <option value="">Seleccionar Camion</option>
                    @foreach ($camionesNoAsignados as $item)
                        <option value="{{$item->id}}">{{$item->id_equipo}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-12 form-group" id="operadorGroup">
        <div class="form-group">
            <label for="name">Operador</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('img/icon/chofer.png') }}" alt="" width="35px">
                </span>
                <select class="form-select d-inline-block" id="operador" name="operador" value="{{ old('operador') }}">
                    <option value="">Seleccionar Operador</option>
                    @foreach ($operadorNoAsignados as $item)
                        <option value="{{$item->id}}">{{$item->nombre}} / {{$item->telefono}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-12 form-group" id="chasisGroup">
        <div class="form-group">
            <label for="name">Chasis</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('img/icon/troca.png') }}" alt="" width="35px">
                </span>
                <select class="form-select d-inline-block" id="chasis" name="chasis" value="{{ old('chasis') }}">
                    <option value="">Seleccionar Chasis</option>
                    @foreach ($chasisNoAsignados as $item)
                        <option value="{{$item->id}}">{{$item->id_equipo}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="col-12 form-group" id="chasisAdicional1Group" style="display:none;">
        <label for="name">Chasis 2</label>
        <select class="form-select d-inline-block" id="chasisAdicional1" name="chasisAdicional1" value="{{ old('chasisAdicional1') }}">
            <option value="">Seleccionar Chasis</option>
            @foreach ($chasisNoAsignados as $item)
                <option value="{{$item->id}}">{{$item->id_equipo}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-12 form-group" id="nuevoCampoDolyGroup" style="display:none;">
        <label for="name">Doly</label>
        <select class="form-select d-inline-block" id="nuevoCampoDoly" name="nuevoCampoDoly" value="{{ old('nuevoCampoDoly') }}">
            <option value="">Seleccionar Doly</option>
            @foreach ($dolysNoAsignados as $item)
                <option value="{{$item->id}}">{{$item->id_equipo}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-6 form-group" id="operadorGroup">
        <div class="form-group">
            <label for="name">Sueldo del operador</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('img/icon/depositar.png') }}" alt="" width="35px">
                </span>
                <input name="sueldo_viaje" id="sueldo_viaje" type="text" class="form-control">
            </div>
        </div>

    </div>

    <div class="col-6 form-group" id="operadorGroup">
        <div class="form-group">
            <label for="name">Dinero para el viaje</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <img src="{{ asset('img/icon/billetera.png') }}" alt="" width="35px">
                </span>
                <input name="dinero_viaje" id="dinero_viaje" type="text" class="form-control">
            </div>
        </div>



    </div>
