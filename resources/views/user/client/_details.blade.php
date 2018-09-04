@section('styles')
    <link rel="stylesheet" href="{{ asset('css/all.css') }}" type="text/css">
@stop
<div class="panel panel-primary">
    <div class="panel-body">
        <div class="nav-tabs-custom" id="user_tabs">
            <ul class="nav nav-tabs Set-list">
                <li class="active">
                    <a href="#general"
                       data-toggle="tab" title="{{ trans('broker.info') }}"><i
                                class="material-icons md-24">info</i></a>
                </li>
                <li>
                    <a href="#logins"
                       data-toggle="tab" title="{{ trans('broker.login') }}"><i
                                class="material-icons md-24">lock</i></a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="general">
                    <div class="row">
                        <div class="col-sm-5 col-md-4 col-lg-3 m-t-20">
                            <div class="fileinput fileinput-new">
                                <div class="fileinput-preview thumbnail form_Blade">
                                    @if(isset($broker->avatar))
                                        <img src="{{ $broker->avatar }}" alt="avatar" width="300">
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-md-8 col-lg-9 m-t-20">
                            <div class="form-group">
                                <label class="control-label" for="title">{{trans('broker.full_name')}}</label>
                                : {{ $broker->full_name }}
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="title">{{trans('broker.phone_number')}}</label>
                                : {{ $broker->phone_number }}
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="title">{{trans('broker.email')}}</label>
                                : {{ $broker->email }}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 m-t-10">
                            <div class="panel-content">
                                <h4>{{trans('broker.permissions')}}</h4>
                                <div class="row">
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.sales_teams')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_team.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['sales_team.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_team.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['sales_team.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_team.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['sales_team.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.leads')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="leads.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['leads.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="leads.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['leads.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="leads.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['leads.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.opportunities')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="opportunities.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['opportunities.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="opportunities.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['opportunities.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="opportunities.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['opportunities.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.logged_calls')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="logged_calls.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['logged_calls.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="logged_calls.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['logged_calls.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="logged_calls.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['logged_calls.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.meetings')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="meetings.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['meetings.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="meetings.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['meetings.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="meetings.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['meetings.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.products')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="products.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['products.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="products.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['products.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="products.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['products.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.quotations')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="quotations.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['quotations.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="quotations.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['quotations.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="quotations.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['quotations.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.sales_orders')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_orders.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['sales_orders.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_orders.write"
                                                       disabled
                                                       class='icheckblue'
                                                       @if(isset($broker) && $broker->hasAccess(['sales_orders.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="sales_orders.delete"
                                                       disabled
                                                       class='icheckred'
                                                       @if(isset($broker) && $broker->hasAccess(['sales_orders.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.invoices')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="invoices.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['invoices.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="invoices.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['invoices.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="invoices.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['invoices.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.broker')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="broker.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['broker.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="broker.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['broker.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="broker.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['broker.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-lg-2">
                                        <h5 class="m-t-20">{{trans('broker.companies')}}</h5>
                                        <div class="input-group">
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="contacts.read"
                                                       class='icheckgreen' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['contacts.read'])) checked @endif>
                                                <i class="success"></i> {{trans('broker.read')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="contacts.write"
                                                       class='icheckblue' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['contacts.write'])) checked @endif>
                                                <i class="warning"></i> {{trans('broker.write')}} </label>
                                            <label>
                                                <input type="checkbox" name="permissions[]" value="contacts.delete"
                                                       class='icheckred' disabled
                                                       @if(isset($broker) && $broker->hasAccess(['contacts.delete'])) checked @endif>
                                                <i class="danger"></i> {{trans('broker.delete')}} </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="logins">
                    <div class="m-t-30">
                        <table id="login_details" class="table table-striped table-bordered dataTable no-footer">
                            <thead>
                            <th>{{trans('broker.date_time')}}</th>
                            <th>{{trans('broker.ip_address')}}</th>
                            </thead>
                            <tbody>
                            @foreach($broker->logins as $login )
                                <tr>
                                    <td>{{$login->created_at->format(config('settings.date_format').' '. Settings::get('time_format'))}}</td>
                                    <td>{{$login->ip_address}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 m-t-10">
                <div class="form-group">
                    <div class="controls">
                        @if (@$action == 'show')
                            <a href="{{ url($type) }}" class="btn btn-warning m-t-10"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>
                        @else
                            <button type="submit" class="btn btn-danger m-t-10"><i
                                        class="fa fa-trash"></i> {{trans('table.delete')}}</button>
                            <a href="{{ url($type) }}" class="btn btn-warning m-t-10"><i
                                        class="fa fa-arrow-left"></i> {{trans('table.back')}}</a>

                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@section('scripts')
    <script type="text/javascript" src="{{ asset('js/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function () {
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
            $(".icheckbox_minimal-red.checked,.icheckbox_minimal-green.checked,.icheckbox_minimal-blue.checked").removeClass("disabled")
            $('#login_details').DataTable({
                "pagination": true
            });
        });
    </script>
@stop
