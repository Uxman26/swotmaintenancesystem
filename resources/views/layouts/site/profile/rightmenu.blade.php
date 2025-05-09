<nav class="bp-navs bp-subnavs no-ajax user-subnav" id="subnav" role="navigation" aria-label="Profile menu">
    <ul class="subnav">
        <li id="public-personal-li" class="bp-personal-sub-tab {{ url()->current()== route('profile.view')? 'current selected': '' }}" data-bp-user-scope="public">
            <a href="{{ route('profile.view') }}" id="public">
                View
            </a>
        </li>

        <li id="edit-personal-li" class="bp-personal-sub-tab {{ url()->current()== route('profile.edit')? 'current selected': '' }}" data-bp-user-scope="edit">
            <a href="{{ route('profile.edit') }}" id="edit">
                Edit
            </a>
        </li>

        <li id="change-avatar-personal-li" class="bp-personal-sub-tab {{ url()->current()== route('profile.change_avatar')? 'current selected': '' }}" data-bp-user-scope="change-avatar">
            <a href="{{ route('profile.change_avatar') }}" id="change-avatar">
                Change Profile Photo
            </a>
        </li>
    </ul>
</nav>
<!-- .item-list-tabs -->