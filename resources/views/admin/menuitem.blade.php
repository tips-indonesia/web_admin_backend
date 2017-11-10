@foreach($items as $item)
  @if (Auth::user()->hasAnyPermission(explode('|',$item->class)))
  <li @if (str_contains(request()->route()->getName(), $item->class)) class="active" @endif>
      <a href="{!! $item->url() !!}"><i class="icon-home4"></i> <span>{!! $item->title !!} </span></a>
      @if($item->hasChildren())
        <ul>
              @include('admin.menuitem', ['items' => $item->children()])
        </ul>
      @endif
  </li>
  @endif
@endforeach
