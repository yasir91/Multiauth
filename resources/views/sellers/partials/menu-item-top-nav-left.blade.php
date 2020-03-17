@if(config('seller::partials.layout_topnav') or (isset($item['topnav']) && $item['topnav']))
  @include('seller::partials.menu-item-top-nav', $item)
@endif
