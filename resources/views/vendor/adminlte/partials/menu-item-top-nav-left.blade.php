@if(config('adminlte.layout_topnav') or (isset($item['topnav']) && isset($item['admin']) && $item['topnav']))
  @include('adminlte::partials.menu-item-top-nav', $item)
@endif
