<div class="panel panel-primary">
    <div class="panel-body">
        @if (isset($broker))
            {!! Form::model($broker, ['url' => $type . '/' . $broker->id, 'method' => 'put', 'files'=> true,'id'=>'broker']) !!}
        @else
            {!! Form::open(['url' => $type, 'method' => 'post', 'files'=> true,'id'=>'broker']) !!}
        @endif
        <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group {{ $errors->has('user_avatar_file') ? 'has-error' : '' }}">
                    {!! Form::label('user_avatar_file', trans('broker.user_avatar'), ['class' => 'control-label']) !!}
                    <div class="controls row" v-image-preview>
                        <div class="col-sm-6">
                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                <div class="fileinput-preview thumbnail form_Blade" data-trigger="fileinput">
                                    <img id="image-preview" width="300">
                                    @if(isset($broker->avatar) )
                                        <img src="{{ url($broker->avatar) }}" alt="User Image" width="300">
                                    @endif
                                </div>
                                <span class="help-block">{{ $errors->first('user_avatar_file', ':message') }}</span>
                                <div class="m-t-10">
                                    <span class="btn btn-default btn-file"><span
                                    class="fileinput-new">{{trans('dashboard.select_image')}}</span>
                                        <span class="fileinput-exists">{{trans('dashboard.change')}}</span>
                                        <input type="file" name="user_avatar_file">
                                    </span>
                                    <a href="#" class="btn btn-default fileinput-exists"
                                       data-dismiss="fileinput">{{trans('dashboard.remove')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('first_name') ? 'has-error' : '' }}">
                    {!! Form::label('first_name', trans('broker.first_name'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
                        {!! Form::hidden('user_type',3) !!}
                        <span class="help-block">{{ $errors->first('first_name', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('last_name') ? 'has-error' : '' }}">
                    {!! Form::label('last_name', trans('broker.last_name'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
                        <span class="help-block">{{ $errors->first('last_name', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('phone_number') ? 'has-error' : '' }}">
                    {!! Form::label('phone_number', trans('broker.phone_number'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::text('phone_number', null, ['class' => 'form-control','data-fv-integer' => 'true']) !!}
                        <span class="help-block">{{ $errors->first('phone_number', ':message') }}</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                    {!! Form::label('email', trans('broker.email'), ['class' => 'control-label required']) !!}
                    <div class="controls">
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                        <span class="help-block">{{ $errors->first('email', ':message') }}</span>
                    </div>
                </div>
            </div>
        </div>
            @if(!Request::is('broker/*/edit'))
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            {!! Form::label('password', trans('broker.password'), ['class' => 'control-label required']) !!}
                            <div class="controls">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {!! Form::label('password_confirmation', trans('broker.password_confirmation'), ['class' => 'control-label required']) !!}
                            <div class="controls">
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
                                <small class="text-danger" id='message'>Password is not matching.</small>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="row password_fields">
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
                            {!! Form::label('password', trans('broker.password'), ['class' => 'control-label required']) !!}
                            <div class="controls">
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                                <span class="help-block">{{ $errors->first('password', ':message') }}</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
                            {!! Form::label('password_confirmation', trans('broker.password_confirmation'), ['class' => 'control-label required']) !!}
                            <div class="controls">
                                {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                                <span class="help-block">{{ $errors->first('password_confirmation', ':message') }}</span>
                                <small class="text-danger" id='message'>Password is not matching.</small>
                            </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-warning change_password">Change password</button>
            @endif
            <div class="row">
            <div class="col-md-12">
                <hr>
                <div class="panel-content">
                    <h4>{{trans('broker.permissions')}}</h4>
                    <div class="row">
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.sales_teams')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sales_team.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['sales_team.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sales_team.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['sales_team.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sales_team.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['sales_team.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.leads')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="leads.read" class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['leads.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="leads.write" class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['leads.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="leads.delete" class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['leads.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.opportunities')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="opportunities.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['opportunities.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="opportunities.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['opportunities.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="opportunities.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['opportunities.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.logged_calls')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="logged_calls.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['logged_calls.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="logged_calls.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['logged_calls.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="logged_calls.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['logged_calls.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.meetings')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="meetings.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['meetings.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="meetings.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['meetings.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="meetings.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['meetings.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.products')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="products.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['products.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="products.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['products.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="products.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['products.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.quotations')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="quotations.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['quotations.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="quotations.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['quotations.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="quotations.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['quotations.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.sales_orders')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sales_orders.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['sales_orders.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sales_orders.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['sales_orders.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="sales_orders.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['sales_orders.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.invoices')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="invoices.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['invoices.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="invoices.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['invoices.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="invoices.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['invoices.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.broker')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="broker.read" class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['broker.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="broker.write" class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['broker.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="broker.delete" class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['broker.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            <h5 class="m-t-20">{{trans('broker.companies')}}</h5>
                            <div class="input-group">
                                <label>
                                    <input type="checkbox" name="permissions[]" value="contacts.read"
                                           class='icheckgreen'
                                           @if(isset($broker) && $broker->hasAccess(['contacts.read'])) checked @endif>
                                    {{trans('broker.read')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="contacts.write"
                                           class='icheckblue'
                                           @if(isset($broker) && $broker->hasAccess(['contacts.write'])) checked @endif>
                                    {{trans('broker.write')}} </label>
                                <label>
                                    <input type="checkbox" name="permissions[]" value="contacts.delete"
                                           class='icheckred'
                                           @if(isset($broker) && $broker->hasAccess(['contacts.delete'])) checked @endif>
                                    {{trans('broker.delete')}} </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">&nbsp;</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <!-- Form Actions -->
                <div class="form-group">
                    <div class="controls">

                        <button type="submit" class="btn btn-success"><i
                                    class="fa fa-check-square-o"></i> {{trans('table.ok')}}</button>
                        <a href="{{ route($type.'.index') }}" class="btn btn-warning"><i
                                    class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                    </div>
                </div>
                <!-- ./ form actions -->
            </div>
        </div>


        {!! Form::close() !!}
    </div>
</div>


@section('scripts')
    <script>
        $(document).ready(function () {
            $("#message").hide();
            $("#password, #password_confirmation").on("keyup", function () {
                if ($("#password").val() == $("#password_confirmation").val()) {
                    $("#message").hide();
                } else{
                    $("#message").show();
                    $("button[type='submit']").attr("disabled",true)
                }
            });
            $("#broker").bootstrapValidator({
                fields: {
                    first_name: {
                        validators: {
                            notEmpty: {
                                message: 'The first name field is required.'
                            },
                            stringLength: {
                                min: '{{ Settings::get('minimum_characters') }}',
                                message: 'The first name must be minimum {{ Settings::get('minimum_characters') }} characters.'
                            }
                        }
                    },
                    last_name: {
                        validators: {
                            notEmpty: {
                                message: 'The last name field is required.'
                            },
                            stringLength: {
                                min: '{{ Settings::get('minimum_characters') }}',
                                message: 'The last name must be minimum {{ Settings::get('minimum_characters') }} characters.'
                            }
                        }
                    },
                    phone_number: {
                        validators: {
                            notEmpty: {
                                message: 'The phone number is required.'
                            },
                            regexp: {
                                regexp: /^\d{5,15}?$/,
                                message: 'The phone number can only consist of numbers.'
                            }
                        }
                    },
                    email: {
                        validators: {
                            notEmpty: {
                                message: 'The email field is required.'
                            }
                        }
                    },
                    password: {
                        validators: {
                            notEmpty: {
                                message: 'The password field is required.'
                            },
                            stringLength: {
                                min: 3,
                                message: 'The password must be minimum 3 characters.'
                            }
                        }
                    },
                    password_confirmation: {
                        validators: {
                            notEmpty: {
                                message: 'The password confirmation field is required.'
                            }
                        }
                    }

                }
            });
            $(".change_password").on("click",function(){
                $(".password_fields").show();
                $(this).hide();
            });
            $(".password_fields").hide();
            $('.icheckgreen').iCheck({
                checkboxClass: 'icheckbox_minimal-green',
                radioClass: 'iradio_minimal-green'
            });
            $('.icheckblue').iCheck({
                checkboxClass: 'icheckbox_minimal-blue',
                radioClass: 'iradio_minimal-blue'
            });
            $('.icheckred').iCheck({
                checkboxClass: 'icheckbox_minimal-red',
                radioClass: 'iradio_minimal-red'
            });

            $("input[value$='write'],input[value$='delete']").on('ifChecked', function () {
                var item = $(this).val();
                var part = item.split('.');
                $("input[value='" + part[0] + ".read']").iCheck('check').iCheck('disable');
            });
            $("input[value$='write'],input[value$='delete']").on('ifUnchecked', function () {
                var item = $(this).val();
                var part = item.split('.');
                if (!$("input[value='" + part[0] + ".write']").is(":checked") && !$("input[value='" + part[0] + ".delete']").is(":checked")) {
                    $("input[value='" + part[0] + ".read']").iCheck('enable').iCheck('uncheck');
                }
            });
            $(".btn-success").click(function () {
                $("input").iCheck('enable');
            });
            $("input[type='checkbox']:checked").each(function () {
                var item = $(this).val();
                var part = item.split('.');
                if ($("input[value='" + part[0] + ".write']").is(":checked") || $("input[value='" + part[0] + ".delete']").is(":checked")) {
                    $("input[value='" + part[0] + ".read']").iCheck('check').iCheck('disable');
                }
            });
        });
    </script>
@stop
