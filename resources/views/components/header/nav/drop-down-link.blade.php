<li class="nav-item dropdown">
    <a class="link nav-item-link dropbtn" href={{$link}}>{{$linkText}}</a>
    @if (!empty($dropedLinks))
    <div class="dropdown-content">
        @foreach ($dropedLinks as $_link => $_linkText)
        <a class="link nav-item-link" href={{$_link}}>{{$_linkText}}</a>
        @endforeach
    </div>
    @endif
</li>