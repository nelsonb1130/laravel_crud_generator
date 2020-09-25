<li class="{{ Request::is('admin/accounts*') ? 'active' : '' }}">
    <a href="{{ route('admin.accounts.index') }}"><i class="fa fa-edit"></i><span>@lang('models/accounts.plural')</span></a>
</li>


