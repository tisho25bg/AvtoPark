@extends('admin.admin')
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header" data-background-color="purple">
                            <h4 class="title">Create Vehicle</h4>
                            <p class="category">Тук е форма за създаване на нов превозни средства</p>
                        </div>
                        <div class="card-content">

                            <div class="card-content">
                                <form method="POST">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group label-floating">
                                                <label  class="control-label" for="brand">Марка</label>
                                                <input type="text" class="form-control" name="brand" id="name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group label-floating">
                                                <label class="control-label">Регистрационен номер</label>
                                                <input type="text" class="form-control" name="regNumber" >
                                            </div>
                                        </div>

                                        <select>
                                            <option value="" disabled selected>Тип на двигателя</option>
                                            <option value="benz">Бензин</option>
                                            <option value="dizel">Дизел</option>
                                            <option value="agu">АГУ</option>

                                        </select>
                                    </div>


                                    <br>
                                    <label for="role_id">Роля на потребител</label>
                                    <select  name="role_id" id="role_id" >
                                        <option value="">--Без избор--</option>
                                        @foreach($roles as $role)
                                            <option value="{{ $role->id }}" data-code="{{ $role->code }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>

                                    <div id="DRIVER_only" style="display: none;" class="hiddenfield">
                                        <label for="test1">Показва се само за шофьора</label>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">E-mail</label>
                                                    <input type="email" class="form-control" name="email">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Password</label>
                                                    <input type="password" class="form-control" name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">ЕГН</label>
                                                    <input type="text" class="form-control" name="egn">
                                                </div>
                                            </div>
                                        </div>

                                        <label for="test1">Свидетелство за правоуправление</label>
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group label-floating">
                                                    <label class="control-label">Категория</label>
                                                    <input type="text" class="form-control" name="category">
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-5">
                                                    <div class="form-group label-floating">
                                                        <label class="control-label">Дата на изтичане</label>
                                                        <input type="date" class="form-control" name="expired">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="MANAGER_only"  style="display: none;"  class="hiddenfield">
                                        <label for="test1">Показва се само за мениджър</label>
                                        <input type="text" name="test1" id="test1">
                                    </div>


                                    <div id="CUSTOMER_only"  style="display: none;"  class="hiddenfield">
                                        <label for="test1">Показва се само за клиент</label>
                                        <input type="text" name="test1" id="test1">
                                    </div>

                                    <button type="submit" class="btn btn-primary pull-right">Create Profile</button>
                                    <div class="clearfix"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $('#role_id').on('change', function(){
            $('.hiddenfield').css('display', 'none')
            var code = $(this).find('option:selected').data('code');
            $('#'+code+'_only').css('display', 'block');
        });
    </script>
@endsection