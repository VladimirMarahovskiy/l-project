<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li><a href="{{ backpack_url('dashboard') }}"><i class="fa fa-dashboard"></i>
        <span>{{ trans('backpack::base.dashboard') }}</span></a></li>
<li><a href="{{ backpack_url('user') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.user') }}</span></a>
</li>
<li><a href="{{ backpack_url('category') }}"><i class="fa fa-list"></i>
        <span>{{ trans('backpack::base.category') }}</span></a></li>
<li><a href="{{ backpack_url('post') }}"><i class="fa fa-dashboard"></i> <span>{{ trans('backpack::base.post') }}</span></a>
</li>
<li><a href="{{ backpack_url('comment') }}"><i class="fa fa-dashboard"></i>
        <span>{{ trans('backpack::base.comment') }}</span></a></li>
<li><a href="{{ backpack_url('subscriber') }}"><i class="fa fa-dashboard"></i>
        <span>{{ trans('backpack::base.subscriber') }}</span></a></li>
<li><a href="{{ backpack_url('report/views') }}"><i class="fa fa-file-excel-o"></i>
        <span>{{ trans('backpack::base.reports') }}</span></a></li>
<li><a href="{{ backpack_url('elfinder') }}"><i class="fa fa-files-o"></i>
        <span>{{ trans('backpack::crud.file_manager') }}</span></a></li>
<li><a href='{{ url(config('backpack.base.route_prefix', 'admin').'/backup') }}'><i class='fa fa-hdd-o'></i> <span>Backups</span></a>
</li>
