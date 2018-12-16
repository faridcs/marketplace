<li class="nav-item dropdown notifications-menu" style="direction: ltr; float: left; margin-top: 15px">
    <a href="#dropdownshow" class="dropdown-toggle" data-toggle="dropdown">
        <i class="livicon" data-name="bell" data-loop="true" data-color="#e9573f" data-hovercolor="#e9573f" data-size="28"></i>
        <span class="label label-warning" style="-webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        position: absolute;
        top: -4px;
        right: 10px;
        font-size: 10px;
        font-weight: normal;
        width: 15px;
        height: 15px;
        line-height: 1.0em;
        text-align: center;
        padding: 2px;">{{ count($notifications) }}</span>
    </a>
    <ul class="dropdown-menu dropdown-messages" >
        <li class="dropdown-title rtl">شما {{ count($notifications) }} اعلان دارید</li>
        <li>
            <ul class="menu remove_hovereffect rtl" style="padding-right: 10px">
                @foreach($notifications as $notification)
                    <li class="dropdown-item">
                        <a href="{{ route('request.detail', ['id' => $notification->request_products_id]) }}">{{ $notification->description }}</a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</li>